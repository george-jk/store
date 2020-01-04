@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="flex-row">
		Поръчка №{{$order->id}} /{{$order->created_at}}
	</div>
	<div class="flex-row">
		Потребител {{$order->user->name}}
	</div>
	<div class="flex-row">
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
				@foreach ($order->product as $product)
				<tr>
					<th scope="row">{{++$loop->index}}</th>
					<td>{{$product->name}}</td>
					<td>{{$product->price}}</td>
					<td>{{$product->pivot->quantity}}</td>
					<td>{{$sum=$product->pivot->quantity*$product->price}}</td>
					{{$sum+=$sum}}
				</tr>
				@endforeach
				<tr>
					<th colspan="4">Невярно Общо: {{$sum}}</th>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="flex-row">
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
	</div>
	<div class="flex-row">
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
@endsection