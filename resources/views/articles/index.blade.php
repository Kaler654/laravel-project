@extends('layout')
@section('content')
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
      <td><a href="/articles/{{$article->id}}">{{$article->title}}</a></td>
      <td>{{$article->shortDesc}}</td>
      <td>{{$article->desc}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="pagintaion__container">
    {{ $articles->links() }}
</div>

@endsection