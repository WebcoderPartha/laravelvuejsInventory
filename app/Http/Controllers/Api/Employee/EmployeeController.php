<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return Response::json($employee);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'nid' => 'required',
            'joining_date' => 'required'
        ]);

        if ($file = $request->photo){

            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-employee'.'.'.$extension;
            $directory = 'uploads/employee/';

            Image::make($request->photo)->resize(300, 300)->save(public_path($directory.$photo));

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employee->photo = $directory.$photo;
            $employee->save();

            return Response::json('Employee added successfully');

        }else{

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employee->save();

            return Response::json('Employee added successfully');

        }




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return Response::json($employee);

    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,'.$employee->id,
            'phone' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'nid' => 'required',
            'joining_date' => 'required'
        ]);

        if ($file = $request->new_photo){

            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-employee'.'.'.$extension;
            $directory = 'uploads/employee/';

            Image::make($request->new_photo)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($employee->photo !== null){
                if (file_exists(public_path($employee->photo))){
                    unlink(public_path($employee->photo));
                }

            }


            $employee->photo = $directory.$photo;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employee->save();

            return Response::json('Employee updated successfully');

        }else{

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = date('Y-m-d', strtotime($request->joining_date));
            $employee->save();

            return Response::json('Employee updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if ($employee->photo !== null){
            if (file_exists(public_path($employee->photo))){
                unlink(public_path($employee->photo));
                $employee->delete();

            }else{
                $employee->delete();
            }
        }

        $employee->delete();
        return Response::json('Employee deleted successfully');

    }

//    public function searchEmployee(Request $request){
//        $keyword = $request->search_keyword;
//
//
//    }
}
