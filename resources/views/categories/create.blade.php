@extends('layouts.admin')
@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header text-center">
					{{ __('Създаване') }}
				</div>
				<div class="card-body">	
					<form method="POST" action={{route('categories.store')}}>
						{{csrf_field()}}
						<div class="form-row">
							<div class="form-check">
								<input type="hidden" name="visible" value="0">
								<input class="form-check-input" type="checkbox" name="visible" value="1" id="visibleCheck">
								<label class="form-check-label" for="visibleCheck">
									{{__('Видим')}}
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="category_title">Категория</label>
							<input type="text" class="form-control @error('category_title') is-invalid @enderror" id="category_title" aria-describedby="nameHelp" name="category_title" value="{{old('category_title')}}" required>
							<small id="nameHelp" class="form-text text-muted">Името на категорията се визуализира в менюто</small>
							@error('category_title')
							<small id="nameHelp" class="invalid-feedback">{{$errors->first('category_title')}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="category_description">Описание</label>
							<input type="text" class="form-control @error('category_description') is-invalid @enderror" id="category_description" aria-describedby="nameHelp" name="category_description" value="{{old('category_description')}}" required>
							@error('category_description')
							<small id="nameHelp" class="invalid-feedback">{{$errors->first('category_description')}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="category">Подкатегория на:</label>
							<select class="form-control @error('parent') is-invalid @enderror" id="category" name="parent">
								<option value="0">Главна категория</option>
								@foreach($categories as $category)
								<option value="{{$category->id}}" {{old('parent')==$category->id?'selected':''}}>
									{{$category->category_title}}
								</option>
								@endforeach
							</select>
							@error('parent')
							<small id="parentHelp" class="invalid-feedback">{{$errors->first('parent')}}</small>
							@enderror
						</div>

						<button type="submit" class="btn btn-success">Добавяне</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection