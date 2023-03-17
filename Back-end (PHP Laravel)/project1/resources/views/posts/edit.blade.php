@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('posts.update',$post->id) }}">
    @csrf {{-- if not exist here page not work ,, that for scure   --}}
    @method('PUT')
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
      value="{{ $post['title'] }}">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Description</label>
      <textarea name="description" class="form-control">{{$post['description']}}</textarea>
    </div>
    <select name="user_id" class="mb-3 form-select form-select-sm" aria-label=".form-select-sm example">
      @foreach($users as $user)
      <option value="{{$user->id}}" @if($user->id == $post->user_id) selected @endif>{{$user->name}}</option>
      @endforeach
    </select>
    <button class="btn btn-primary">update post</button>
@endsection
