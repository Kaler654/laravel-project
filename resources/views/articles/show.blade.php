@extends('layout')
@section('content')
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">{{ $article->title }}</h5>
    <h6 class="card-subtitle mb-2 text-muted">{{ $article->shortDesc }}</h6>
    <p class="card-text">{{ $article->desc }}</p>

    <div class="btn-group" role="group">
      <a href="/articles/{{$article->id}}/edit" class="card-link btn btn-link">Edit</a>
      <form action="/articles/{{ $article->id }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-link">Delete article</button>
      </form>
    </div>
    
  </div>
</div>
@endsection