<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $attributes = \request()->validate([
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'required|image',
            'slug' => 'required|unique:posts,slug',
            'expert' => 'required',
            'category_id' => 'required|exists:categories,id',
            'published_at' => now(),
            'status'=>'nullable'
        ]);
        $attributes['user_id'] = auth()->id();

        $thumbnail = \request()->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $thumbnail->getClientOriginalName());
        $attributes['thumbnail'] = str_replace('public/', '', $thumbnailPath);

        Post::create($attributes);

        return redirect('/')->with('success', 'Post Inserted!');
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
            'updated_at'=>now(),
            'user_id'=>'required|exists:users,id'

        ]);
        if(isset($attributes['thumbnail'])){
        $thumbnail = \request()->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $thumbnail->getClientOriginalName());
        $attributes['thumbnail'] = str_replace('public/', '', $thumbnailPath);
        }

        $categories=Category::all();
//                dd($attributes);
        $post->update($attributes);
        return back()->with('success', 'Post Updated!');

    }

    public function delete(Post $post)
    {
        $post->delete();

        return back()->with('success','Post Deleted!');

    }
    public function status(Request $request, $status, $id)
    {
        $post = Post::find($id);
        $post->status = $status;
        $post->save();

        return redirect()->back()->with('success', 'Post Status Updated');
    }
}
