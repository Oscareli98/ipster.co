<?php

namespace App;

use OpenGraph;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'url', 'storage_path'];

    public function hasNext() {
        return !is_null(Post::where('id', '>', $this->id)->first());
    }

    public function hasPrev() {
        return !is_null(Post::where('id', '<', $this->id)->first());
    }

    public function next() {
        return Post::where('id', '>', $this->id)->first();
    }

    public function prev() {
        return Post::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public static function random() {
        return Post::orderByRaw("RAND()")->first();
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
        $posts = Post::orderBy('views', 'desc')->take($amt)->get();
        return $posts;
    }
}
