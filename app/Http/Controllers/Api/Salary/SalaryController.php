<?php

namespace App\Http\Controllers\Api\Salary;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salary = Salary::with('employee')->orderBy('id', 'DESC')->get();
        return Response::json($salary);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $count = count($request->salaries);

        for ($i = 0; $i < $count; $i++){
            $salary = new Salary();
            $salary->employee_id = $request->salaries[$i]['employee_id'];
            $salary->amount = $request->salaries[$i]['amount'];
            $salary->salary_date = date('Y-m-d', strtotime($request->salaries[$i]['salary_date']));
            $salary->salary_month = date('F', strtotime($request->salaries[$i]['salary_date']));
            $salary->salary_year = date('Y', strtotime($request->salaries[$i]['salary_date']));
            $salary->save();
        }

        return Response::json("Salary added successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salary = Salary::find($id);
        return Response::json($salary);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $salary = Salary::find($id);
        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->employee_id;
        $salary->salary_date = date('Y-m-d', strtotime($request->salary_date));
        $salary->salary_month = date('F', strtotime($request->salary_date));
        $salary->salary_year = date('Y', strtotime($request->salary_date));
        $salary->save();
        return Response::json("Salary updated successfully!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $salary = Salary::find($id);
        $salary->delete();
        return Response::json("Salary deleted successfully!");

    }
}
