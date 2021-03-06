@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header text-center">
					{{ __('Редактиране на публикация') }}
				</div>
				<div class="card-body">	
					<form method="POST" action={{route('articles.update',$article->id)}}>
						{{csrf_field()}}
						@method('PUT')
						<div class="form-row">
							<div class="form-check">
								<input type="hidden" name="visible" value="0">
								<input class="form-check-input" type="checkbox" name="visible" value="1" id="visibleCheck" {{$article->visible==1?'checked':''}}>
								<label class="form-check-label" for="visibleCheck">
									{{__('Видим')}}
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="article_title">Заглавие</label>
							<input type="text" class="form-control @error('article_title') is-invalid @enderror" id="article_title" aria-describedby="titleHelp" name="article_title" value="{{$errors->any()?old('article_title'):$article->article_title}}" required>
							@error('article_title')
							<small id="titleHelp" class="invalid-feedback">{{$errors->first('article_title')}}</small>
							@enderror
						</div>
					<format-field field_name="article_content" content="{{$errors->any()?old('article_content'):$article->article_content}}"></format-field>
						{{-- <div class="form-group">
							<label for="article_content">Текст на публикацията</label>
							<textarea class="form-control @error('article_content') is-invalid @enderror" id="article_content" aria-describedby="contentHelp" name="article_content2" required>{{$errors->any()?old('article_content'):$article->article_content}}</textarea>
							@error('article_content')
							<small id="contentHelp" class="invalid-feedback">{{$errors->first('article_content')}}</small>
							@enderror
						</div> --}}
						<button type="submit" class="btn btn-success">Запис</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection