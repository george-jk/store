@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<h5 class="card-header text-center">
					{{ __('Промяна') }}
				</h5>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						@foreach($products as $product)
						<li class="list-group-item list-group-item-action">	
							<a href="{{route('products.edit',$product->id)}}" class="list-group-item-action">{{$product->name}}</a>
						</li>	
						@endforeach
					</ul>
				</div>
				<div class="card-footer text-center">
					{{$products->links()}}	
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card mb-2">
				<h5 class="card-header text-center">
					{{ __('Добавяне') }}
				</h5>
				<div class="card-body">
					<h6 class="card-title">
						Добавяне на продукт
					</h6>
					<a class="btn btn-primary" href="{{route('products.create')}}">{{ __('Добавяне') }}</a>
				</div>
			
				<div class="card-body">
					<h6 class="card-title">
						Добавяне на изображение
					</h6>
					<a class="btn btn-primary" href="{{route('image.create')}}">{{ __('Добавяне') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection