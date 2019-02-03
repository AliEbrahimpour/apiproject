<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\v1\SellerCollection;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Seller as SellerResource;

class SellerController extends Controller
{
    public function buy(Request $request,Seller $seller){
        $seller = Seller::findOrFail($seller->income);
        $seller->update([
            'income' => $request->incomde
        ]);
    }

    public function index(Request $request){
        $sellers = Seller::paginate(5);
        return new SellerCollection($sellers);
    }

    public function single(Seller $seller){
        return new SellerResource($seller);
    }

    public function register(Request $request)
    {
        // Validation Data
        $validData = $this->validate($request, [
            'user_id' => 'required|integer|unique:sellers',
            'certificate' => 'required|mimes:jpeg,bmp,png|max:20480',
            'meli_cart' => 'required|string',
            'meli_num' => 'required|integer',
            'bank_id' => 'required|integer',
            'bank_cart_num' => 'required|integer',
            'shaba_num' => 'required|integer',
            'shop_name' => 'required|string',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
        ]);

        $seller = Seller::create([
            'user_id' => $validData['user_id'],
            'certificate' => $validData['certificate'],
            'meli_cart' => $validData['meli_cart'],
            'meli_num' => $validData['meli_num'],
            'bank_id' => $validData['bank_id'],
            'bank_cart_num' => $validData['bank_cart_num'],
            'shaba_num' => $validData['shaba_num'],
            'shop_name' => $validData['shop_name'],
            'state_id' => $validData['state_id'],
            'city_id' => $validData['city_id'],
            'income' => $validData['income'],
        ]);


        User::find($validData['user_id'])->update([
            'api_token' => str_random(100),
            'Is_seller' => '1',
        ]);

        return new SellerResource($seller);
    }
}
