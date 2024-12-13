@extends('layout')
@section('content')
<form action="/articles" method="POST">
  @csrf
  <div class="mb-3">
    <label for="datePublic" class="form-label">Date public</label>
    <input type="date" class="form-control" id="datePublic" name="datePublic">
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input name="title" type="text" class="form-control" id="title">
  </div>
  <div class="mb-3">
    <label for="shortDesc" class="form-label">short description</label>
    <input name="shortDesc" type="text" class="form-control" id="shortDesc">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <textarea name="desc" class="form-control" id="desc"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Create article</button>
</form>
@endsection