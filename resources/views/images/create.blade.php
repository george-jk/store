@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ __('Добавяне на изображение') }}
				</div>
				<div class="card-body">
					<form method="post" action="{{route('image.store')}}">
						{{csrf_field()}}
						<div class="form-row">
							<div class="custom-file">
								<input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile" required>
								<label class="custom-file-label" for="customFile">{{__('Избор на файл...')}}</label>
								{{-- <small id="fileHelp" class="form-text text-muted">Името на продукта се визуализира в index</small> --}}
								@error('name')
								<small id="nameHelp" class="invalid-feedback">{{$errors->first('name')}}</small>
								@enderror
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Добави</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

