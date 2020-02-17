@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="card mb-2">
			<div class="card-header text-center">
				{{ __('Поръчки') }}
			</div>
			<div class="card-body">
				<div class="d-inline-flex">
					<ul class="list-group list-group-flush">
						@foreach($orders as $order)
						<li class="list-group-item list-group-item-action">	
							<a href="{{route('orders.show',$order->id)}}" class="list-group-item-action">{{$order->created_at}} ~ {{$order->status()->orderby('created_at','desc')->firstOrFail()->status}}{{-- {{$order->status()->latest()->first()->ststus}} --}}</a>
						</li>	
						@endforeach
					</ul>
				</div>
			</div>
			<div class="card-footer">
				<div class="row justify-content-center">
					{{$orders->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection