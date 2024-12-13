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
<h3 class="text-center">Add Comment</h3>

<form action="/comment" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <input type="text" class="form-control" id="desc" name="desc">
  </div>
  <input type="hidden" name="article_id" value="{{$article->id}}">
  <button type="submit" class="btn btn-primary">Save comment</button>
</form>

  <h3 class="text-center">Comments</h3>
  <div class="row">
  @foreach($comments as $comment) 
  <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{$comment->name}}</h5>
        <p class="card-text">{{$comment->desc}}</p>
        <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary">Edit comment</a>
        <a href="/comment/{{$comment->id}}/delete" class="btn btn-warning">Delete comment</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection