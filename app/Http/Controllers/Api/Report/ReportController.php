<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{

    public function customerCount(){

        $data = Customer::count();
        return Response::json($data);

    }

    public function employeeCount(){

        $data = Employee::count();
        return Response::json($data);

    }


    public function supplierCount(){

        $data = Supplier::count();
        return Response::json($data);

    }

    public function productCount(){

        $data = Product::count();
        return Response::json($data);

    }


}
