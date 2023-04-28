<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'advance_pay' => $request->advance_pay,
            'due_pay' => $request->due,
            'pay_by' => $request->pay_by,
            'total_qty' => $request->total_qty,
            'subtotal' => $request->subtotal,
            'vat' => $request->vat,
            'total' => $request->total,
            'order_date' => date('d-m-Y'),
            'order_month' => date('F'),
            'order_year' => date('Y')
        ]);

        $carts = Pos::all();

        foreach ($carts as $cart){

            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->product_name = $cart->product_name;
            $orderDetail->qty = $cart->quantity;
            $orderDetail->price = $cart->product_price;
            $orderDetail->sub_price = $cart->sub_total;
            $orderDetail->save();
            $pos = Pos::where('product_id', $cart->product_id)->first();
            $pos->delete();

        }


        return Response::json('Order Done!');
    }

    public function todayOrder(){
        $todayOrder = Order::with('customer')->where('order_date', date('d-m-Y'))->orderBy('id', 'DESC')->get();
        return Response::json($todayOrder);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
