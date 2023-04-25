<?php

namespace App\Http\Controllers\Api\POS;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PosController extends Controller
{

    public function getCategoryIDbyProducts($id){
        $products = Product::with('category')->where('category_id', $id)->orderBy('id', 'DESC')->get();
        return Response::json($products);
    }

}
