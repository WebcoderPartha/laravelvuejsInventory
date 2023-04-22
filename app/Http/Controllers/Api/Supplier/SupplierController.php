<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return Response::json($supplier);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($file = $request->photo){

            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-supplier'.'.'.$extension;
            $directory = 'uploads/supplier/';

            Image::make($request->photo)->resize(300, 300)->save(public_path($directory.$photo));

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shop_name = $request->shop_name;
            $supplier->photo = $directory.$photo;
            $supplier->save();

            return Response::json('Supplier added successfully');

        }else{

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shop_name = $request->shop_name;
            $supplier->save();

            return Response::json('Supplier added successfully');

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return Response::json($supplier);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required',
            'address' => 'required',

        ]);

        if ($file = $request->new_photo){

            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-supplier'.'.'.$extension;
            $directory = 'uploads/supplier/';

            Image::make($request->new_photo)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($supplier->photo !== null){
                if (file_exists(public_path($supplier->photo))){
                    unlink(public_path($supplier->photo));
                }

            } // end if


            $supplier->photo = $directory.$photo;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shop_name = $request->shop_name;
            $supplier->save();

            return Response::json('Supplier updated successfully');

        }else{

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shop_name = $request->shop_name;
            $supplier->save();

            return Response::json('Supplier updated successfully');

        } // end else
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if ($supplier->photo !== null){
            if (file_exists(public_path($supplier->photo))){
                unlink(public_path($supplier->photo));
                $supplier->delete();

            }else{
                $supplier->delete();
            }
        }

        $supplier->delete();
        return Response::json('Supplier deleted successfully');
    }
}
