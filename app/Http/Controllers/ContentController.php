<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Carbon;
use DB;

class ContentController extends Controller
{
    public function getTop() {
        $posts = Post::orderBy('views', 'desc')->paginate();
        return  view('posts.category')
                ->with('category', 'principales')
                ->with('posts', $posts);
    }

    public function getHot() {

        // Last week
        $fromDate = Carbon\Carbon::now()->subDays(7)->format('Y-m-d');
        $tillDate = Carbon\Carbon::now()->addDay()->format('Y-m-d');

        $posts = Post::whereBetween('created_at', [$fromDate, $tillDate] )->orderBy('shares', 'desc')->paginate();
        return  view('posts.category')
                ->with('category', 'populares')
                ->with('posts', $posts);
    }

    public function getNew() {
        $posts = Post::orderBy('created_at', 'desc')->paginate();
        return  view('posts.category')
                ->with('category', 'nuevos')
                ->with('posts', $posts);
    }

    public function getRandom() {
        return redirect()->route('posts.show', Post::random()->id);
    }
}
