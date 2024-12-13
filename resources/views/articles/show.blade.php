@extends('layout')
@section('content')
@use('App\Models\User', 'User')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Title</th>
      <th scope="col">Shortdesc</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <th scope="row">{{$article->datePublic}}</th>
      <td>{{$article->title}}</td>
      <td>{{$article->shortDesc}}</td>
      <td>{{$article->desc}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection