@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="card mb-2">
		<h6 class="card-header text-center">
			{{ __('Поръчка №')}}{{$order->id}} /{{$order->created_at}}
		</h5>
		<div class="card-body p-2">
			<div class="card mb-2">
				<div class="card-header">
					Потребител 
				</div>
				<div class="card-body">
					<div class="flex-row">
						<div class="flex-column">
							{{$order->customer->name}} {{$order->customer->family}}<br>
							{{$order->customer->phone}}<br>
							{{$order->customer->email}}<br>
							{{$order->customer->address}}<br>
							{{$order->customer->province}}; {{$order->customer->village}}<br>	
						</div>
						<div class="flex-column">						
							@if (!is_null($order->customer->company_name))
							{{$order->customer->company_name}}<br>
							{{$order->customer->contact_person}}<br>
							{{$order->customer->company_number}}<br>
							{{$order->customer->vat_number}}<br>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-2">
				<div class="card-header">
					Поръчка 
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Артикул</th>
								<th scope="col">Единична цена</th>
								<th scope="col">Количество</th>
								<th scope="col">Цена</th>
							</tr>
						</thead>
						<tbody>
							<?php $totall=0 ?>
							@foreach ($order->product as $product)
							<tr>
								<th scope="row">{{++$loop->index}}</th>
								<td>{{$product->name}}</td>
								<td>{{$product->price}}</td>
								<td>{{$product->pivot->quantity}}</td>
								<td>{{$sum=$product->pivot->quantity*$product->price}}</td>
							</tr>
							<?php $totall+=$product->pivot->quantity*$product->price ?>
							@endforeach
							<tr>
								<th colspan="4">Общо: {{$totall}}</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="card mb-2">
		<div class="card-header">
			Статус
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Статус</th>
						<th scope="col">Дата</th>
						<th scope="col">Описание</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($order->status as $status)
					<tr>
						<th scope="row">{{$status->status}}</th>
						<td>{{$status->pivot->created_at}}</td>
						<td>{{$status->description}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@if ($errors->any())
			<div class="alert alert-danger" role="alert">
				{{$errors->first('status')}}
			</div>
			@endif
			<form method="POST" action="{{route('orders.status-change',[$order->id])}}">
				{{csrf_field()}}
				<div class="form-inline">
					<select class="form-control" name="status">
						@foreach($statuses as $status)
						<option value="{{$status->id}}">{{$status->status}}</option>
						@endforeach
					</select>
					<div class="form-check form-check-inline ml-3">
						<input class="form-check-input" type="checkbox" name="sendMail" id="mailCheckbox">
						<label class="form-check-label" for="mailCheckbox">Изпрати e-mail</label>
					</div>
					<button type="submit" class="btn btn-primary ml-2">Промени</button>
				</div>
			</form>
		</div>
	</div>
	<div class="flex-row">
		
	</div>
</div>
@endsection