@extends('layouts.app')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <form method="post" action="{{ route('offers.update', $offer->id) }}">
        @csrf {{-- if not exist here page not work ,, that for scure --}}
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $offer['name'] }}">
        </div>
        @error('name')
            {{-- name >> name of input --}}
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">price</label>
            <input name="price" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $offer['price'] }}">
        </div>
        @error('price')
            {{-- name >> name of input --}}
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">details</label>
            <input name="details" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                value="{{ $offer['details'] }}">
        </div>
        @error('details')
            {{-- name >> name of input --}}
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
        <button class="btn btn-primary">update</button>
    @endsection
