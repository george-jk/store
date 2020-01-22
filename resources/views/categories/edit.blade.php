@extends('layouts.admin')
@section('content')

<form method="post" action="{{route('categories.update',[$category->id])}}">
	{{csrf_field()}}
	@method('PUT')
	<div class="form-group">
		<label for="category_title">Категория</label>
		<input type="text" class="form-control @error('category_title') is-invalid @enderror" id="category_title" aria-describedby="nameHelp" name="category_title" value="{{$category->category_title}}" required>
		<small id="nameHelp" class="form-text text-muted">Името на продукта се визуализира в менюто</small>
		@error('category_title')
		<small id="nameHelp" class="invalid-feedback">{{$errors->first('category_title')}}</small>
		@enderror

	</div>
	<div class="form-group">
		<label for="category_description">Описание</label>
		<input type="text" class="form-control @error('category_description') is-invalid @enderror" id="category_description" aria-describedby="nameHelp" name="category_description" value="{{$category->category_description}}" required>
		@error('category_description')
		<small id="nameHelp" class="invalid-feedback">{{$errors->first('category_description')}}</small>
		@enderror

	</div>


	<div class="form-group">
		<label for="category">Подкатегория на:</label>
		<select class="form-control @error('parent') is-invalid @enderror" id="category" name="parent">
			<option value="0">Main category</option>
			@foreach($mainCategories as $categories)
			<option value="{{$categories->id}}" 
				{{$categories->id==$category->parent ? 'selected' : ''}}>
				{{$categories->category_title}}
			</option>
			@endforeach
		</select>
		@error('parent')
		<small id="parentHelp" class="invalid-feedback">{{$errors->first('parent')}}</small>
		@enderror
	</div>
	<button type="submit" class="btn btn-primary">Промени</button>
</form>

<form method="POST" action="{{route('categories.destroy',[$category->id])}}">
	{{method_field('DELETE')}}
	{{csrf_field()}}
	<div class="control mt-3">
		<div class="field">
			<button type="submit" class="btn btn-danger">Изтрий</button>
		</div>
	</div>
</form>


@endsection