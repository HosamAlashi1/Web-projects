<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// this is model must call this when you need to qeury of database
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all(); // post >> name of modle
        return view('posts.index', ['posts' => $postsFromDB]);
    }

    // public function show($post)
    // { // $post >> can use (any name) this name Indicates for data coming from url 
    //     $singlePost = Post::findOrFail($post);
    //     // find >> only return the $post
    //     //findOrFail >> that if $post in url not exist in database return error
    //     return view('posts.show', ['post' => $singlePost]);
    // }
    public function show(Post $post) // here $post >> must be name as >> {post} in url Route::get('/posts/{post}' ,....
    {
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',['users' => $users]);
    }

    public function store()
    {
        // $data = request()->all();
        // all data form the store page which send from create page by (action="{{ route('post.store') }})
        $title = request()->title;
        $description = request()->description;
        $userId = request()->user_id;
        // note: in frame work laravel must Determine what input can user to fill by (post modle) if not Determine
        // will be throw exception to see that go to >> app >> models >> post
        $post = post::create([ // to insert in data base 
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ]);
        // request()->description  , >> request()->name of input;

        // this way alternative (بديل) to  previous code ,but this way not throw excption
        // $post = new post;
        // $post->title=$title;
        // $post->description=$description;
        // $post->save();

        return redirect(route('posts.index')); // after execute the Previous code we need to moving in main page 
        //return redirect('/posts');
        //return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', ['post' => $post,'users' => $users]);
    }

    public function update($post)
    {
        $singlePost = Post::findOrFail($post);  
        $title = request()->title;
        $description = request()->description;
        $userId = request()->user_id;
        $singlePost->update([ // to upadte in data base 
            'title' => $title,
            'description' => $description,
            'user_id' => $userId
        ]);

        return redirect(route('posts.index'));
    }

    public function destroy($post)
    {
        
        // $singlePost = Post::findOrFail($post);
        // $singlePost->delete();
        Post::where('id', $post)->delete();
        return redirect(route('posts.index'));
    }
}
