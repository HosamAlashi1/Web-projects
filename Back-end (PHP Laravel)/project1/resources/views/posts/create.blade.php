@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('posts.store') }}">
    @csrf {{-- if not exist here page not work ,, that for scure   --}}
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <label for="exampleInputPassword1" class="form-label">User</label>
    <select name="user_id" class="mb-3 form-select form-select-sm" aria-label=".form-select-sm example">
      @foreach($users as $user)
      <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    </select>
    <button class="btn btn-success">Create post</button>
@endsection