@extends('layouts.admin')

@section('content')
<div class="d-inline-flex">
	<ul class="list-group list-group-flush">
		@foreach($products as $product)
		<li class="list-group-item list-group-item-action">	
			<a href="{{route('products.edit',$product->id)}}" class="list-group-item-action">{{$product->name}}</a>
		</li>	
		@endforeach
	</ul>
</div>
@endsection