@section('content')
<div class="col">
	<aside class="menu">
		<p class="menu-label">
			Редактиране
		</p>
		@foreach($categories as $category)
		@if($category->parent==0)
		<ul class="menu-list ">
			<li><a href="/categories/{{$category->id}}/edit">{{$category->category_title}}</a></li>
			@foreach($categories as $sub)
			@if($sub->parent==$category->id)
			<li>
				<ul>
					<li><a href="/categories/{{$sub->id}}/edit">{{$sub->category_title}}</a></li>
				</ul>
			</li>
			@endif
			@endforeach
		</ul>
		@endif
		@endforeach
	</aside>
	<a class="menu-label" href="/categories/create">
		Добавяне
	</a>
</div>
@endsection