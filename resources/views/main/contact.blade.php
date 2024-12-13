@extends('layout')
@section('content')
    <h3>Контакты</h3>
    <p>{{$data['name']}}</p>
    <p>{{$data['address']}}</p>
    <p>{{$data['email']}}</p>
@endsection
