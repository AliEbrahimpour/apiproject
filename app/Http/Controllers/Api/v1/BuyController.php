<?php

namespace App\Http\Controllers\Api\v1;

use App\Preparing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class BuyController extends Controller
{
    public function send(Request $request, Preparing $preparing){
        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
        $Amount = $request->price; //Amount will be based on Toman - Required
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $Mobile = '09123456789'; // Optional
        $CallbackURL = 'http://www.yoursoteaddress.ir/verify.php'; // Required


        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
        } else {
            echo'ERR: '.$result->Status;
        }
    }

    public function callback(Request $request){
        $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
        $Amount = 1000; //Amount will be based on Toman
        $Authority = $_GET['Authority'];

        if ($_GET['Status'] == 'OK') {

            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {

                Preparing::find($request->id)->update([
                    'paid' => '1',
                ]);

                echo 'Transaction success. RefID:'.$result->RefID;
            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }
}
