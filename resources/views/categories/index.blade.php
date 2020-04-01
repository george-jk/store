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
					<div class="d-inline-flex">
						<div>
							@foreach($categories as $category)
							@if($category->parent==0)
							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link text-secondary {{$category->visible==0?'mark':''}}" href="{{route('categories.edit',[$category->id])}}">{{$category->category_title}}</a>
								</li>
								@foreach($categories as $sub)
								@if($sub->parent==$category->id)
								<li class="nav-item pl-3">
									<ul class="nav flex-column">
										<li class="nav-item border-left">
											<a class="nav-link text-secondary {{$sub->visible==0?'mark':''}}" href="{{route('categories.edit',[$sub->id])}}">
												{{$sub->category_title}}
											</a>
										</li>
									</ul>
								</li>
								@endif
								@endforeach
							</ul>
							@endif
							@endforeach
						</div>
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
						Добавяне на (под)категория
					</p>
					<a class="btn btn-primary" href="{{route('categories.create')}}">{{ __('Добавяне') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection