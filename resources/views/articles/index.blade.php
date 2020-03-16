@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header text-center">
					{{ __('публикация @Автор') }}
				</div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						@foreach($articles as $article)
						<li class="list-group-item list-group-item-action">	
							<a href="{{route('articles.edit',$article->id)}}" class="list-group-item-action {{$article->visible==0?'mark':''}}">{{$article->article_title}} <span>@</span>{{$article->user->name}}</a>
						</li>	
						@endforeach
					</ul>
				</div>
				<div class="card-footer">
					<div class="row justify-content-center">
						{{$articles->links()}}	
					</div>
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
						Добавяне на публикация
					</p>
					<a class="btn btn-primary" href="{{route('articles.create')}}">{{ __('Добавяне') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection