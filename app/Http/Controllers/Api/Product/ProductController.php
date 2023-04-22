<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('supplier', 'category')->orderBy('id', 'DESC')->get();
        return Response::json($product);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'buying_date' => 'required',
        ]);

        if ($file = $request->photo){

            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-supplier'.'.'.$extension;
            $directory = 'uploads/product/';

            Image::make($request->photo)->resize(300, 300)->save(public_path($directory.$photo));

            $product = new Product();
            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->quantity = $request->quantity;
            $product->buying_date = $request->buying_date;
            $product->photo = $directory.$photo;
            $product->save();

            return Response::json('Product added successfully');

        }else{

            $product = new Product();
            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->quantity = $request->quantity;
            $product->buying_date = $request->buying_date;
            $product->save();

            return Response::json('Product added successfully');

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return Response::json($product);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::find($id);

        $this->validate($request, [
            'supplier_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code,'.$product->id,
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'buying_date' => 'required',
        ]);

        if ($file = $request->new_photo){

            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-supplier'.'.'.$extension;
            $directory = 'uploads/product/';

            Image::make($request->new_photo)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($product->photo !== null){
                if (file_exists(public_path($product->photo))){
                    unlink(public_path($product->photo));
                }

            } // end if


            $product->photo = $directory.$photo;

            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->quantity = $request->quantity;
            $product->buying_date = $request->buying_date;

            $product->save();

            return Response::json('Product updated successfully');

        }else{

            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->quantity = $request->quantity;
            $product->buying_date = $request->buying_date;
            $product->save();

            return Response::json('Product updated successfully');

        } // end else

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product->photo !== null){
            if (file_exists(public_path($product->photo))){
                unlink(public_path($product->photo));
                $product->delete();

            }else{
                $product->delete();
            }
        }

        $product->delete();
        return Response::json('Product deleted successfully');
    }
}
