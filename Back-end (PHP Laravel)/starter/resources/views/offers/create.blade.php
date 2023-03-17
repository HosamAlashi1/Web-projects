@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
          </div>
          @endif
          <br>
            <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                  @error('name') {{-- name >> name of input   --}}
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="mb-3">
                  <input placeholder="price" name="price" type="text" class="form-control" id="exampleInputPassword1">
                  @error('price') {{-- email >> name of input   --}}
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="mb-3">
                    <input placeholder="details" name="details" type="text" class="form-control" id="exampleInputPassword1">
                    @error('details') 
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                  </div>
                  <div class="mb-3">
                    <input name="photo" type="file" class="form-control" id="exampleInputPassword1">
                    @error('photo') 
                  <small class="form-text text-danger">{{$message}}</small>
                  @enderror
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
@endsection