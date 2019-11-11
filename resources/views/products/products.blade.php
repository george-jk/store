@extends('layout')

@section('content')
@foreach($products as $product)
{{$product}}
@endforeach

@endsection