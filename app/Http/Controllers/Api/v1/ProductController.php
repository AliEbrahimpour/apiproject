<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Resources\v1\ProductCollection;
use App\Http\Resources\v1\Product as ProductResource;
use App\Preparing;
use App\PrivilegeAndComment;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{


    public function index(Request $request){
        $product = Product::paginate(5);
        return new ProductCollection($product);
    }


    public function single(Product $product){
        return new ProductResource($product);
    }


    public function setimage(Product $product,Request $request){

        $validData = $this->validate($request, [
            'image_src' => 'required|mimes:jpeg,bmp,png|max:20480',
        ]);

        $file = $request->file('image_src');

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $imagePath = "/upload/images/product/{$year}/{$month}/{$day}";
        $filename = $file->getClientOriginalName();

        $file->move(public_path($imagePath) , $filename);


        $productimage = ProductImage::create([
            'product_id' => $product->id,
            'image_src' => $imagePath.'/'.$filename,
        ]);

//        return response([
        return response([
            'data' => [
                'image_src' => url("{$imagePath}/{$filename}"),
                'product_id' => $product->id ,
            ],
            'status' => 'success'
        ]);
    }


    public function removeimage(Product $product,Request $request,Filesystem $Filesystem){

        $imagePath = $request->image_src;


        if($Filesystem->exists(public_path("{$imagePath}"))) {

            $product = ProductImage::where('product_id',$product->id)->delete();

            File::delete(public_path($imagePath));

            return response([
                'data' => [
                    'image_src' => public_path($request->image_src),
                    'product_id' => $product->id ,
                ],
                'status' => 'success'
            ]);
        }
        else{
            return response([
                'data' => [
                    'message' => 'عکس مورد نظر یافت نشد',
                ],
                'status' => 'fail'
            ],404);

        }

    }


    public function showproduct(Request $request){

        return $preparing = DB::table('preparings')
            ->where('paid','=','1' )
            ->where('posted','=','0')
            ->get();
    }



}
