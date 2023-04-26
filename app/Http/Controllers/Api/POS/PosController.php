<?php

namespace App\Http\Controllers\Api\POS;

use App\Http\Controllers\Controller;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PosController extends Controller
{

    public function getCategoryIDbyProducts($id){
        $products = Product::with('category')->where('category_id', $id)->where('quantity', '>', '0')->orderBy('id', 'DESC')->get();
        return Response::json($products);
    }

    public function AllProducts(){
        $products = Product::with('category')->where('quantity', '>', '0')->orderBy('id', 'DESC')->get();
        return Response::json($products);
    }

    public function addToCart($id){

        $product = Product::where('id', $id)->first();

        $checkCart = Pos::where('product_id', $product->id)->first();

        if (!$checkCart){

            $cart = new Pos();
            $cart->product_id  = $product->id;
            $cart->product_name  = $product->product_name;
            $cart->quantity  = 1;
            $cart->product_price  = $product->selling_price;
            $cart->sub_total  = $product->selling_price;
            $cart->save();


        }else{

            $cart = Pos::where('product_id', $product->id)->first();
            $totalQty = $cart->quantity + 1;
            $totalSub = $product->selling_price * $totalQty;

            $cart->product_id  = $product->id;
            $cart->product_name  = $product->product_name;
            $cart->quantity  = $totalQty;
            $cart->product_price  = $product->selling_price;
            $cart->sub_total  = $totalSub;
            $cart->save();


        }


        return Response::json('Product added to cart!');

    }

    public function getCarts(){
        $carts = Pos::orderBy('id', 'ASC')->get();
        return Response::json($carts);
    }


}
