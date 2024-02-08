<?php

namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;

    public $expert;

    public $date;

    public $body;

    public $slug;

    public function __construct($title,$expert,$date,$body,$slug)
    {
        $this->title = $title;
        $this->expert = $expert;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }
    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
            ->map(fn($file)=>YamlFrontMatter::parseFile($file))
            ->map(fn($doucment)=> new Post($doucment->title,
                $doucment->expert,
                $doucment->date,
                $doucment->body(),
                $doucment->slug
            ))->sortByDesc('date');
        });
    }
    public static function find($slug)
    {
        return static::all()->firstWhere('slug',$slug);

    }
}
