@extends('layouts.app')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
</div>
@endif

    <a href="{{ route('offers.create') }}" class="btn btn-success mb-2">Create Post</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">/Name</th>
                <th scope="col">Price</th>
                <th scope="col">Details</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
                <tr>
                    <th scope="row">{{ $offer['id'] }}</th>
                    <td>{{ $offer['name'] }}</td>
                    <td>{{ $offer['price'] }}</td>
                    <td>{{ $offer['details'] }}</td>
                    <td><img style="width: 70px ; height:70px" src="{{asset('images/offers/'.$offer->photo)}}"/></td>
                    <td>
                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('offers.destroy', $offer->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   <div class="d-flex justify-content-center">
    {!! $offers -> links() !!}
   </div>
@endsection
