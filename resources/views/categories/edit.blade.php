@extends('layout')
@section('content')

<div class="field">	
	<form method="post" action="/categories/{{$category->id}}">
		{{csrf_field()}}
		@method('PUT')
		<div class="field">
			<label class="label">Category</label>
			<div class="control">
				<input class="input @error('category_title') is-danger @enderror" type="text" name="category_title" value="{{$category->category_title}}" required >
				@error('category_title')
					<p class="help is-danger">{{$errors->first('category_title')}}</p>
				@enderror
			</div>
			<p class="help">Edit category name</p>
		</div>

		<div class="field">
			<label class="label">Description</label>
			<div class="control">
				<input class="input @error('category_description') is-danger @enderror" type="text" name="category_description" value="{{$category->category_description}}" required>
				@error('category_description')
					<p class="help is-danger">{{$errors->first('category_description')}}</p>
				@enderror
			</div>
			<p class="help">Edit description</p>
		</div>

		<div class="field">
			<label class="label">Subcategory</label>
			<div class="control">
				<div class="select">
					<select name="parent">
						<option value="0">Main category</option>
						@foreach($mainCategories as $categories)
						<option value="{{$categories->id}}" 
							{{$categories->id==$category->parent ? 'selected' : ''}}>
							{{$categories->category_title}}
						</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="field">
			<p class="control">
				<button class="button is-success">
					Update
				</button>
			</p>
		</div>
	</form>
</div>
<div class="field">
	<form method="POST" action="/categories/{{$category->id}}">
		{{method_field('DELETE')}}
		{{csrf_field()}}
		<div class="control">
			<div class="field">
				<button type="submit" class="button is-danger">DELETE</button>
			</div>
		</div>
	</form>
</div>

@endsection