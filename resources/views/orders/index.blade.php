@extends('layouts.admin')

@section('content')
<div class="d-inline-flex">
	<ul class="list-group list-group-flush">
		@foreach($orders as $order)
		<li class="list-group-item list-group-item-action">	
			<a href="{{route('orders.show',$order->id)}}" class="list-group-item-action">{{$order->created_at}} ~ {{$order->status()->orderby('created_at','desc')->firstOrFail()->status}}{{-- {{$order->status()->latest()->first()->ststus}} --}}</a>
		</li>	
		@endforeach
	</ul>
</div>
@endsection