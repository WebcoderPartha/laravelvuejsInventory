<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::orderBy('id', 'DESC')->get();
        return Response::json($customer);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($file = $request->photo){

            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-customer'.'.'.$extension;
            $directory = 'uploads/customer/';

            Image::make($request->photo)->resize(300, 300)->save(public_path($directory.$photo));

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->photo = $directory.$photo;
            $customer->save();

            return Response::json('Customer added successfully');

        }else{

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            return Response::json('Customer added successfully');

        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        return Response::json($customer);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);


        $customer = Customer::find($id);

        if ($file = $request->new_photo){

            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-customer'.'.'.$extension;
            $directory = 'uploads/customer/';

            Image::make($request->new_photo)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($customer->photo !== null){
                if (file_exists(public_path($customer->photo))){
                    unlink(public_path($customer->photo));
                }

            } // end if


            $customer->photo = $directory.$photo;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            return Response::json('Customer updated successfully');

        }else{

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();

            return Response::json('Customer updated successfully');

        } // end else

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if ($customer->photo !== null){
            if (file_exists(public_path($customer->photo))){
                unlink(public_path($customer->photo));
                $customer->delete();

            }else{
                $customer->delete();
            }
        }

        $customer->delete();
        return Response::json('Customer deleted successfully');
    }
}
