@extends('layout')
@section('content')

<aside class="menu">
	<p class="menu-label">
		Categories
	</p>
	@foreach($categories as $category)
	@if($category->parent==0)
	<ul class="menu-list ">
		<li><a href="#">{{$category->category_title}}</a></li>
		@foreach($categories as $sub)
		@if($sub->parent==$category->id)
		<li>
			<ul>
				<li><a href="#">{{$sub->category_title}}</a></li>
			</ul>
		</li>
		@endif
		@endforeach
	</ul>
	@endif
	@endforeach
</aside>

@endsection