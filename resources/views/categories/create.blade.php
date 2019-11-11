@extends('layout')
@section('content')

<div class="field">	
	<form method="post" action="/categories">
		{{csrf_field()}}
		<div class="field">
			<label class="label">Category</label>
			<div class="control">
				<input class="input" type="text" name="category_title" placeholder="Category name" value="{{old('category_title')}}" required>
			</div>
			<p class="help">Type category name</p>
		</div>

		<div class="field">
			<label class="label">Description</label>
			<div class="control">
				<input class="input" type="text" name="category_description" placeholder="Describe category" value="{{old('category_description')}}" required>
			</div>
			<p class="help">Type some short description</p>
		</div>

		<div class="field">
			<label class="label">Subcategory</label>
			<div class="control">
				<div class="select">
					<select name="parent">
						<option value="0">Main category</option>
						@foreach($categories as $category)
						<option value="{{$category->id}}" {{old('parent')==$category->id?'selected':''}}>{{$category->category_title}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="field">
			<p class="control">
				<button class="button is-success">
					Create
				</button>
			</p>
		</div>
	</form>
</div>
@if ($errors->any())
<div class="notification is-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif

@endsection