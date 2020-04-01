<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;

class RouteListController extends Controller
{
	public function index()
	{
		$routes=Route::getRoutes('');
		return view('routelist.index',['routes'=>$routes,'colors'=>['GET' => 'badge-success', 'HEAD' => 'badge-secondary', 'OPTIONS' => 'badge-secondary', 'POST' => 'badge-primary', 'PUT' => 'badge-warning', 'PATCH' => 'badge-info', 'DELETE' => 'badge-danger']]);
	}

}
