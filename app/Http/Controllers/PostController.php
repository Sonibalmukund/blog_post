<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Models\Bookmark;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search','category','author']))->where('status',1)->
                paginate(6)->withQueryString()
        ]);
    }

    public  function show(Post $post)
    {
      abort_if($post->status==0,404);
        $viewKey = 'view_count_' . $post->id;

        if (!Session::has($viewKey)) {
            $post->incrementReadCount();
            Session::put($viewKey, 1);
        }

        return view('posts.show', [
            'post' => $post,
        ]);
    }
    public function bookmark(Post $post)
    {
        auth()->user()->bookmarks()->toggle($post);

        return back();
    }

}
