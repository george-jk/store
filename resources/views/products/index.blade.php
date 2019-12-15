@extends('layouts.admin')

@section('content')
@foreach($products as $product)
{{$product}}
@endforeach

@endsection