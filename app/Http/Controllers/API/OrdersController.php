<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>['nullable','exists:users,id'],
            'name'=>['required','min:3','max:255'],
            'family'=>['required','min:3','max:255'],
            'phone'=>['required','min:6','max:12'],
            'email'=>['email:rfc'],
            'address'=>['required','min:3','max:255'],
            'province'=>['required','min:3','max:255'],
            'village'=>['required','min:3','max:255'],
            'subscribe'=>['boolean'],
            'order.*.product_id'=>['required','exists:products,id'],
            'order.*.quantity'=>['required'],
            'order.*.dimension_id'=>['required','exists:dimensions,id'],
        ]);
        if ($request->user_id==null) {
            $customer=Customer::create([
                'name'=>$request->name,
                'family'=>$request->family,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'province'=>$request->province,
                'village'=>$request->village,
                'subscribe'=>$request->subscribe]);
            $order=Order::create(['customer_id'=>$customer->id]);
        } else {
            $user=User::findOrFail($request->user_id);
            $order=Order::create(['customer_id'=>$user->customer->id]);
        }
        foreach ($request->order as $item) {
            $order->product()->attach($item['product_id'],[
                'quantity'=>$item['quantity'],
                'dimension_id'=>$item['dimension_id'],
            ]);
        }
        // $user=User::findOrFail($request->user_id);
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
