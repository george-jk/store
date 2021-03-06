<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGeneral($id)
    {
        return (DB::table('general_terms')->select('*')->where('id',$id)->get());     
    }
    public function lastGeneral()
    {
        return (DB::table('general_terms')->select('*')->orderByDesc('id')->limit(1)->get());
    }

    public function showDelivery($id)
    {
        return (DB::table('terms_of_delivery')->select('*')->where('id',$id)->get());     
    }
    public function lastDelivery()
    {
        return (DB::table('terms_of_delivery')->select('*')->orderByDesc('id')->limit(1)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
