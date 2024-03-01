<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
       //
    public function index()
    {


        $query = Post::orderBy('id', 'DESC')->with('author');

        if(!Auth::user()->can('admin')){
            $query = $query->where('user_id', Auth::user()->id);
        }

        return view('admin.posts.index', [
            'posts' => $query->paginate(50)
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

    public function destroy (Post $post)
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

    public function bookmark()
    {
        $user = auth()->user();
        $Bookmark = $user->bookmarks()->orderBy('id', 'DESC')->with('author')->get();
//        dd($latestBookmark);
        return view('admin.posts.bookmark',compact('Bookmark'));
    }
}
