@extends('layouts.admin')

@section('content')
@if(session()->get('success')||session()->get('fail'))
<div class="alert alert-{{session()->get('success')?'success':'danger'}} alert-dismissible fade show">
	{{ session()->get('success') }}
	{{ session()->get('fail') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">x</span>
	</button>
</div>
@endif

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Добавяне на изображение') }}
				</div>
				<div class="card-body">
					<form method="post" action="{{route('image.store')}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group">
							<div class="custom-file">
								<input type="file" name="imageFile" class="custom-file-input @error('file') is-invalid @enderror" id="imageFile" required>
								<label class="custom-file-label" for="imageFile">{{__('Избор на файл...')}}</label>
								@error('name')
								<small id="fileHelp" class="invalid-feedback">{{$errors->first('image')}}</small>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<label for="path">Path</label>
							<input type="text" class="form-control @error('path') is-invalid @enderror" id="path" name="path" required value="Brand/type/MODEL">
							@error('path')
							<small id="pathHelp" class="invalid-feedback">{{$errors->first('path')}}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="category">Продукт</label>
							<select class="form-control @error('product_id') is-invalid @enderror" id="category" name="product_id">
								@foreach($products as $product)
									<option value="{{$product->id}}">
										{{$product->name}}
									</option>
								@endforeach
							</select>
							@error('product_id')
							<small id="categoryHelp" class="invalid-feedback">{{$errors->first('product_id')}}</small>
							@enderror
						</div>
						<button type="submit" class="btn btn-primary">Добави</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

