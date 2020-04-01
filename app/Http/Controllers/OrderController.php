<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use App\Mail\OrderStatus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (view('orders.index',['orders'=>Order::paginate(6)]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $statuses=Status::all();
        $order->product;
        $order->user;
        $order->status;
        return (view('orders.show',['order'=>$order,'statuses'=>$statuses]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
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
        $order->delete();
        return('deleted');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate(['status'=>'unique:order_status,status_id,NULL,id,order_id,'.$order->id]);
        $order->status()->attach($order->id,['status_id'=>$request->status]);
        Mail::to($order->customer->email)->send(new OrderStatus($order));
        return(redirect(route('orders.show',[$order->id])));
    }
}
