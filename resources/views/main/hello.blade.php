@extends('layout')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Name</th>
      <th scope="col">Shortdesc</th>
      <th scope="col">Description</th>
      <th scope="col">Preview image</th>
    </tr>
  </thead>
  <tbody>
    @foreach($articles as $article)
    <tr>
      <th scope="row">{{$article->date}}</th>
      <td>{{$article->name}}</td>
      <td>{{$article->shortDesc}}</td>
      <td>{{$article->desc}}</td>
      <td>{{$article->preview_image}}</td>
      <td><a href="/galery/{{$article->full_image}}"><img src="{{URL::asset('/images/'.$article->preview_image)}}" alt="" height="100" width="100"></a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection