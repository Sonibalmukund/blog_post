<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
       //
    public function index()
    {
        return view('admin.posts.index',[
            'posts'=>Post::paginate(50)
        ]);

    }
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $post=new Post();
        $attributes = \request()->validate([
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required','image'],
            'slug' => 'required|unique:posts,slug',
            'expert' => 'required',
            'category_id' => 'required|exists:categories,id',
            'published_at'=>'required',
        ]);

        $attributes['user_id'] = auth()->id();

        $thumbnail = \request()->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $thumbnail->getClientOriginalName());
        $attributes['thumbnail'] = str_replace('public/', '', $thumbnailPath);

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',['post'=>$post]);
    }

    public function update(Post $post)
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required','image'],
            'slug' => 'required',
            'expert' => 'required',
            'category_id' => 'required|exists:categories,id',
            'published_at'=>'required',

        ]);
        if(isset($attributes['thumbnail'])){
        $thumbnail = \request()->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $thumbnail->getClientOriginalName());
        $attributes['thumbnail'] = str_replace('public/', '', $thumbnailPath);
        }
        //        dd($attributes);
        $post->update($attributes);
        return back()->with('success','Post Updated!');
    }

    public function delete(Post $post)
    {
        $post->delete();

        return back()->with('success','Post Deleted!');

    }
}
