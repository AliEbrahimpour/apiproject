<?php

namespace App\Http\Controllers\Api\v1;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Transaction as TransactionResource;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transaction = Transaction::paginate(5);
        return new TransactionResource($transaction);
    }

    public function single(Transaction $transaction){
        return new TransactionResource($transaction);
    }


}
