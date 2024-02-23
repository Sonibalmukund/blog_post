<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $with=['category','author'];


    public function scopeFilter($query ,array $filtters)
    {
        $query->when($filtters['search'] ?? false,fn($query, $search)=>
        $query->where(fn($query)=>
        $query->where('title','like','%'. $search.'%')
                ->orwhere('body','like','%'. $search.'%')
        ));

        $query->when($filtters['category'] ?? false,fn($query, $category)=>
        $query->whereHas('category',fn($query)=>
        $query->where('slug',$category)
        )
        );

        $query->when($filtters['author'] ?? false,fn($query, $author)=>
        $query->whereHas('author',fn($query)=>
        $query->where('username',$author)
        )
        );
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function incrementReadCount()
    {
        $this->view_count++;
        $this->save();
    }
}
