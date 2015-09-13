<?php

namespace App;

use OpenGraph;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'url', 'storage_path', 'scheduled', 'posted'];

    public function hasNext() {
        return !is_null(Post::posted()->where('id', '>', $this->id)->first());
    }

    public function hasPrev() {
        return !is_null(Post::posted()->where('id', '<', $this->id)->first());
    }

    public function next() {
        return Post::posted()->where('id', '>', $this->id)->first();
    }

    public function prev() {
        return Post::posted()->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public static function random() {
        return Post::posted()->orderByRaw("RAND()")->first();
    }

    public static function posted() {
        return Post::where('scheduled', '>=', new \DateTime('today'));
    }

     public function getHumanTimestampAttribute($column)
     {
         if ($this->attributes[$column])
         {
         return Carbon::parse($this->attributes[$column])->diffForHumans();
         }

         return null;
     }

    public function getGraph() {
        $og = new OpenGraph();

        $og->title(is_null($this->title) ? 'ipster | fotos hilaranates' : $this->title)
           ->type('article')
           ->image($this->url)
           ->url(route('posts.show', $this->id));

        return $og;
    }

    public static function top($amt) {
        $posts = Post::posted()->orderBy('views', 'desc')->take($amt)->get();
        return $posts;
    }


}
