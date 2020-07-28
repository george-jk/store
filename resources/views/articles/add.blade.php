<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name','ProfitStore').'~Admin Pannel/'.Route::currentRouteName() }}</title>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="/js/test/test.js" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container" id="app">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		<form method="POST" action="{{route('articles.store')}}" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
			{{csrf_field()}}
			<div class="form-group">
				<div class="form-check">
					<input type="hidden" name="visible" value="0" v-model="form.visible">
					<input type="checkbox" class="form-check-input" id="visibility" name="visible" value="1" v-model="form.visible">
					<label class="form-check-label" for="visibility">Видима/Скрита статия</label>
				</div>
			</div>
			<div class="form-group mb-3">
				<label for="title">Заглавие на статията</label>
				<input type="input" class="form-control" id="title" name="article_title" aria-describedby="titleHelper" placeholder="Заглавие на статията" v-model="form.article_title">
				<div class="alert alert-danger" role="alert" v-if="form.errors.has('article_title')" v-text="form.errors.get('article_title')">
				</div>
			</div>

			<div class="form-group mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-book" aria-hidden="true"></i></span>
					</div>
					<textarea class="form-control" name="article_content" rows="7" placeholder="Текст на статията" aria-label="article_content" v-model="form.article_content">
					</textarea>
				</div>
				<div class="alert alert-danger" role="alert" v-text="form.errors.get('article_content')" v-if="form.errors.has('article_content')"></div>
			</div>

			<button type="submit" class="btn btn-primary" :disabled="form.errors.any()">
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="false"></span>
				Submit
			</button>
		</form>
	</div>
	{{-- @endsection --}}
</body>