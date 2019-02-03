<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function orderby(Request $request){

        // Validation Data
        $validData = $this->validate($request, [
            'tables' => 'required|string',
            'order' => 'required|string',
            'column' =>'required|string',
        ]);

        $tables = $validData['tables'];
        $order = $validData['order'];  // acs or desc
        $column = $validData['column'];

        if(DB::table($tables)->exists()){
            return DB::table($tables)->orderBy($column,$order)->get();
        }
        else{
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ],403);
        }

    }
}
