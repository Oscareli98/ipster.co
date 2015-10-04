<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Carbon;
use DB;

class AdminController extends Controller
{

    /**
     * returns dashboard view
     * @return [type] [description]
     */
    public function index() {

        $posts = Post::all();
        // $scheduled = Post::where('scheduled', '>', 'Date()')->get();
        $scheduled = Post::where('scheduled', '>=', new \DateTime('today'))->orWhere('scheduled', NULL)->get();

        return view('admin.dashboard')
                ->with('posts', $posts)
                ->with('scheduled', $scheduled);
    }

}
