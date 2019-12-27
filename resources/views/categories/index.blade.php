@extends('layouts.admin')
@section('content')
<div class="d-inline-flex">
	<div>
		<p class="menu-label">
			Редактиране
		</p>
		@foreach($categories as $category)
		@if($category->parent==0)
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link text-secondary" href="/categories/{{$category->id}}/edit">{{$category->category_title}}</a>
			</li>
			@foreach($categories as $sub)
			@if($sub->parent==$category->id)
			<li class="nav-item pl-3">
				<ul class="nav flex-column">
					<li class="nav-item border-left">
						<a class="nav-link text-secondary" href="/categories/{{$sub->id}}/edit">{{$sub->category_title}}</a>
					</li>
				</ul>
			</li>
			@endif
			@endforeach
		</ul>
		@endif
		@endforeach
		<a class="btn btn-primary text-white mt-3" href="{{route('category.create')}}">
			Добавяне
		</a>
	</div>
</div>
@endsection