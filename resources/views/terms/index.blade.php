@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header text-center">
					@switch($label)
						@case('general')
						{{__('Общи условия')}}
						@break
						@case('delivery')
						{{__('Условия за доставка')}}
						@break
						@case('all')
						{{__('Всички')}}
						@break
					@endswitch
				</div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						@foreach($terms as $version)
						<li class="list-group-item list-group-item-action">	
							<a href="{{route('terms.edit',$version->id)}}" class="list-group-item-action">{{$version->id}}<span>/</span>{{$version->created_at}}</a>
						</li>	
						@endforeach
					</ul>
				</div>
				<div class="card-footer">
					<div class="row justify-content-center">
						{{$terms->links()}}	
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
						Добавяне на документ
					</p>
					<a class="btn btn-primary" href="{{route('terms.create')}}">{{ __('Добавяне') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection