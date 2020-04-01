@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Редактиране на продукт') }}
				</div>

				<div class="card-body">
					<form method="post" action="{{route('products.update',[$product->id])}}">
						{{csrf_field()}}
						@method('PUT')
						<div class="form-row">
							<div class="form-check">
								<input type="hidden" name="visible" value="0">
								<input class="form-check-input" type="checkbox" name="visible" value="1" id="visibleCheck" {{$product->visible==1?'checked':''}}>
								<label class="form-check-label" for="visibleCheck">
									{{__('Видим')}}
								</label>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<label for="name">Продукт</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" name="name" value="{{$product->name}}" required>
								<small id="nameHelp" class="form-text text-muted">Името на продукта се визуализира в index</small>
								@error('name')
								<small id="nameHelp" class="invalid-feedback">{{$errors->first('name')}}</small>
								@enderror
							</div>
							<div class="col">
								<label for="manifacture">Производител</label>
								<input type="text" class="form-control @error('manifacture') is-invalid @enderror" id="manifacture" name="manifacture" value="{{$product->manifacture}}" required>
								@error('manifacture')
								<small id="manifactureHelp" class="invalid-feedback">{{$errors->first('manifacture')}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="description">Описание на продукт</label>
							<textarea class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="descriptionHelp" name="description" required>{{$product->description}}</textarea>
							<small id="descriptionHelp" class="form-text text-muted">Пълно описание на продукта</small>
							@error('description')
							<small id="descriptionHelp" class="invalid-feedback">{{$errors->first('description')}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="exserptDescription">Кратко описание на продукт</label>
							<textarea type="textarea" class="form-control @error('exserpt_description') is-invalid @enderror" id="exserptDescription" aria-describedby="exserptDescriptionHelp" name="exserpt_description">{{$product->exserpt_description}}</textarea>
							<small id="exserptDescription" class="form-text text-muted">Краткото описание се визуализира при hover върху продукта</small>
							@error('exserpt_description')
							<small id="excerptDescriptionHelp" class="invalid-feedback">{{$errors->first('exserpt_description')}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="category">Категория</label>
							<select class="form-control @error('category_id') is-invalid @enderror" id="category" name="category_id">
								@foreach($categories as $category)
								@if($category->parent==0)
								<optgroup label="{{$category->category_title}}">
									@foreach($categories as $subcat)
									@if($subcat->parent==$category->id)
									<option value="{{$subcat->id}}" {{$subcat->id==$product->category_id?'selected':''}}>
										{{$subcat->category_title}}
									</option>
									@endif
									@endforeach
								</optgroup>
								@endif
								@endforeach
							</select>
							@error('category_id')
							<small id="categoryHelp" class="invalid-feedback">{{$errors->first('category_id')}}</small>
							@enderror
						</div>
						<div class="form-row">
							<div class="col">
								<label for="price">Цена</label>
								<input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{$product->price}}"></input>
								@error('price')
								<small id="priceHelp" class="invalid-feedback">{{$errors->first('price')}}</small>
								@enderror
							</div>
							<div class="col">
								<div class="col">
									<label for="currency">Валута</label>
									<input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{$product->currency}}"></input>
									@error('currency')
									<small id="currencyHelp" class="invalid-feedback">{{$errors->first('currency')}}</small>
									@enderror
								</div>
							</div>
							<div class="col">
								<label for="price">Наличност</label>
								<input type="number" step="1" min="0" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{$product->stock}}"></input>
								@error('stock')
								<small id="stockHelp" class="invalid-feedback">{{$errors->first('stock')}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="iamge">Изображение</label>
							<select class="form-control @error('image') is-invalid @enderror" id="image_id" name="image_id">
								@foreach($images as $image)
								<option value="{{$image->id}}" {{$image->id==$product->image_id?'selected':''}}>
									{{$image->path}}
								</option>
								@endforeach
							</select>
							@error('image')
							<small id="imageHelp" class="invalid-feedback">{{$errors->first('image')}}</small>
							@enderror
						</div>
						<div class="d-flex justify-content-between">
							<a class="btn btn-light active" href="{{url()->previous()}}">&lt;</a>
							<button type="submit" class="btn btn-primary">Промени</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection