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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request)
    {
        $validated=$request->validated();
        if ($request->user_id==null) {
            if ($customer=Customer::where('email',$validated['email'])) {
                if ($customer->phone==$validated['phone']) {
                    dd($customer);
                } else {
                    dd('phone difference');
                }
            } else {
                dd('new customer');
                $customer=Customer::create($validated);
            }
            
            $order=Order::create(['customer_id'=>$customer->id]);
        } else {
            $user=User::findOrFail($request->user_id);
            $order=Order::create(['customer_id'=>$user->customer->id]);
        }
        foreach ($validated['order'] as $item) {
            $order->product()->attach($item['product_id'],[
                'quantity'=>$item['quantity'],
                'dimension_id'=>$item['dimension_id'],
            ]);
        }
        $order->status()->attach($order->id,['status_id'=>1]);
        Mail::to($user->email)->send(new OrderCreated(Order::find($order->id), $user->name));
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
