<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStore;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (Order::all());
    }
    public function test()
    {
        echo "string";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request)
    {
        echo "string";
        $validated=$request->validated();
        $customer=Customer::create($validated);
        $order=Order::create(['customer_id'=>$customer->id]);
        foreach ($validated['order'] as $item) {
            $order->product()->attach($item['product_id'],[
                'quantity'=>$item['quantity'],
                'dimension_id'=>$item['dimension_id'],
            ]);
        }
        $order->status()->attach($order->id,['status_id'=>1]);
        // Mail::to($user->email)->send(new OrderCreated(Order::find($order->id), $user->name));
        return response()->json([
            'success'=>'true',
            'order_id'=>$order->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order->product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
