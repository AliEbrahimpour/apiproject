<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function setcomment(Request $request){

        $validData = $this->validate($request, [
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'privilege'=>'required|integer',
            'comment'=>'required|string'
        ]);

        $product = Product::findOrFail($validData['product_id'])->update([
            'buying_count' => DB::raw('buying_count+1'),
        ]);

        $users = PrivilegeAndComment::create([
            'user_id'=>$validData['user_id'],
            'product_id' => $validData['product_id'],
            'privilege' => $validData['privilege'],
            'comment' => $validData['comment'],
        ]);


        return response([
            'data' => [
                'message' => 'نظر شما با موفقیت ثبت گردید',
                $users
            ],
            'status' => 'success'
        ]);
    }

    public function setting(Request $request){

        $validData = $this->validate($request, [
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'privilege'=>'integer',
            'comment'=>'string'
        ]);

        $product_id = $validData['product_id'];
        $user_id =$validData['user_id'];


        $users = DB::table('privilege_and_comments')
            ->select('privilege','comment')
            ->where('user_id','=',$user_id )
            ->where('product_id','=',$product_id)
            ->get();

        if($users != '[]')
            return $users;
        else
            return response([
                'data' => [
                    'message' => 'نظر مورد نظر شما یافت نشد',
                ],
                'status' => 'fail'
            ],404);
    }


}
