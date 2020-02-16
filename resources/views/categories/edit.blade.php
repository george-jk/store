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
					<form method="post" action="{{route('categories.update',[$category->id])}}">
						{{csrf_field()}}
						@method('PUT')
						<div class="form-row">
							<div class="form-check">
								<input type="hidden" name="visible" value="0">
								<input class="form-check-input" type="checkbox" name="visible" value="1" id="visibleCheck" {{$category->visible==1?'checked':''}}>
								<label class="form-check-label" for="visibleCheck">
									{{__('Видим')}}
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="category_title">Категория</label>
							<input type="text" class="form-control @error('category_title') is-invalid @enderror" id="category_title" aria-describedby="nameHelp" name="category_title" value="{{$category->category_title}}" required>
							<small id="nameHelp" class="form-text text-muted">Името на категорията се визуализира в менюто</small>
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
								<option value="0">Главна категория</option>
								@foreach($mainCategories as $categories)
								<option value="{{$categories->id}}" 
									{{$categories->id==$category->parent ? 'selected' : ''}}{{$categories->id==$category->id?' disabled':''}}>
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
						Изтриване на (под)категория
					</p>
					<form method="POST" action="{{route('categories.destroy',[$category->id])}}">
						{{method_field('DELETE')}}
						{{csrf_field()}}
						<div class="control mt-3">
							<div class="field">
								<button type="submit" class="btn btn-danger">{{ __('Изтриване') }}</button>
							</div>
						</div>
					</form>
					<p class="text-danger">Не изисква потвърждение!</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection