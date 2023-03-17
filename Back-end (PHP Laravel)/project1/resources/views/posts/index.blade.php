@extends('layouts.app')
@section('content')
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-2">Create Post</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">/Tilte</th>
                <th scope="col">Posted By</th>
                <th scope="col">Creaed At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post['id'] }}</th>
                    <td>{{ $post['title'] }}</td>
                    {{-- to show the name of users must call form user table ,so must create relation between post and user
                    table by modle. go to post modle to see that   --}}
                    <td>{{ $post->user ? $post->user->name:'user not found' }}</td>
                    {{-- {{ $post->user ? $post->user->name:'user not found' }} >> this line meaning 
                    if $post-> user exist return $post->user->name , if not return 'user not found'
                    ,, must do it if not do it will throw exception --}}
                    <td>{{ $post['created_at']->format('y-m-d') }}</td>
                    <td>
                        {{-- <a href="/project1/public/posts/{{$post->id}}" class="btn btn-success">view</a> --}}
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">view</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        {{-- msut do this for deleted --}}
                        <form style="display: inline" action="post" action="{{ route('posts.destroy', $post->id)}}">                            
                            @method('DELETE')
                            @csrf {{-- if not exist here page not work ,, that for scure   --}}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
