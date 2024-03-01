<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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
        $user = auth()->user();
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }
    public function bookmark(Post $post)
    {
        $user = auth()->user();

        $user->bookmarks()->toggle($post);

        if (!empty($user->bookmarks)) $isBookmarked = $user->bookmarks->contains($post);

        if ($isBookmarked) {
            $message = 'Bookmark Successfully!';
        } else {
            $message = 'Bookmark Remove!';
        }

        return back()->with('success', $message);
    }

    public function follow(Post $post)
    {
        $author = $post->author;

        if (!$author) {
            // Handle the case where the post does not have an associated author
            return back()->with('error', 'This post does not have an associated author.');
        }
        $user = auth()->user();
//dd($author);
        if (!$user->isFollowing($author)) {
            $user->follow($author);
            $message = 'You are now following ' . $author->name;
        } else {
            if ($user->isFollowing($author)) {
                $user->unfollow($author);
            $message = 'You have unfollowed ' . $author->name;
        }
        }

        return back()->with('success', $message);
    }

    public function unfollow(Post $post)
    {
        $author = $post->author;

        if (!$author) {
            return back()->with('error', 'This post does not have an associated author.');
        }

        $authUser = auth()->user();

        // Debugging
//        dd($authUser->isFollowing($author));

        if ($authUser->isFollowing($author)) {
            $authUser->unfollow($author);
            $message = 'You have unfollowed ' . $author->name;
        } else {
            if (!$authUser->isFollowing($author)) {
                $authUser->follow($author);
                $message = 'You are now following ' . $author->name;
            }
        }

        return back()->with('success', $message);
    }


}
