<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense = Expense::orderBy('id', 'DESC')->get();
        return Response::json($expense);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = $request->expenses;

        for ($i = 0; $i < $count; $i++){
            $expense = new Expense();
            $expense->details = $request->expenses[$i]['expenses'];
            $expense->amount = $request->expenses[$i]['amount'];
            $expense->date = date('Y-m-d', strtotime($request->expenses[$i]['date']));
            $expense->save();
        }

        return Response::json('Expense added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::find($id);
        return Response::json($expense);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $expense = Expense::find($id);
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->date = date('Y-m-d', strtotime($request->date));
        $expense->save();

        return Response::json('Expense added successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        return Response::json('Expense deleted successfully!');
    }
}
