@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header text-center">
					{{ __('Промяна') }}
				</div>
				<div class="card-body">
					{{-- Filter dropdown --}}
					<div class="dropdown show">
						<a class="btn btn-secondary dropdown-toggle btn-block btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{request()->product?$categories[request()->product]['category_title']:'Категория'}}
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="{{route('products.index')}}">Всички</a>
							@foreach($categories as $category)
								@if($category->parent==0)
									<h6 class="dropdown-header">{{$category->category_title}}</h6>
									@foreach($categories as $subcat)
										@if($subcat->parent==$category->id)
										<a class="dropdown-item {{request()->product==$subcat->id?'active':''}}" href="{{route('products.show',[$subcat->id])}}">{{$subcat->category_title}}</a>
										@endif
									@endforeach
								@endif
							@endforeach
						</div>
					</div>
					<hr>
					{{-- List products --}}
					<ul class="list-group list-group-flush">
						@if($products->isEmpty())
						<span>{{__('Липсват продукти в тази категория')}}</span>
						@endif
						@foreach($products as $product)
						<li class="list-group-item list-group-item-action">	
							<a href="{{route('products.edit',$product->id)}}" class="list-group-item-action {{$product->visible==0?'mark':''}}">{{$product->name}}</a>
						</li>	
						@endforeach
					</ul>
				</div>
				<div class="card-footer">
					<div class="row justify-content-center">
						{{$products->links()}}	
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card mb-2">
				<div class="card-header text-center">
					{{ __('Добавяне') }}
				</div>
				<div class="card-body">
					<p class="card-title">
						Добавяне на продукт
					</p>
					<a class="btn btn-primary" href="{{route('products.create')}}">{{ __('Добавяне') }}</a>
				</div>
				
				<div class="card-body">
					<p class="card-title">
						Добавяне на изображение
					</p>
					<a class="btn btn-primary" href="{{route('image.create')}}">{{ __('Добавяне') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection