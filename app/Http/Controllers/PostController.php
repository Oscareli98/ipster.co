<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

use Storage;
// use Chencha\Share\ShareFacade;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['show', 'share']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        // return strtotime($request->get('time'));
        // return $request->all();
        $this->validate($request, [
            'image' => 'required|image',
            'time'  => 'date'
        ]);

        $image = $request->file('image');

        $title = $request->get('title') == "" ? NULL : $request->get('title');
        $caption = $request->get('caption') == "" ? NULL : $request->get('caption');

        $time = $request->get('time') == "" ? date('Y-m-d H:i:s') : $request->get('time');

        $url = "/uploads/posts/images/";
        $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
        $filepath = $url . $filename;

        Storage::disk('s3')->put($filepath, file_get_contents($image));

        $post = Post::create([
            'title'         => $title,
            'caption'       => $caption,
            'scheduled'     => $time,
            'url'           => 'https://s3.amazonaws.com/ipster.co-uploads' . $filepath,
            'storage_path'  => $filepath
        ]);

        return redirect()->route('admin-dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $post->views += rand(1, 25);
        $post->save();

        $rand = Post::random();
        while ($rand->id == $post->id) {
            $rand = Post::random();
        }

        return view('posts.show')
                ->with('post', $post)
                ->with('rand', $rand)
                ->with('og', $post->getGraph())
                ->with('top_left', Post::top(3))
                ->with('photos_hot', Post::top(12));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function share($id, $type) {
        $loaded = \Chencha\Share\ShareFacade::load(route('posts.show', $id));

        $post = Post::findOrFail($id);
        $post->shares += rand(5, 15);
        $post->save();

        switch($type) {
            case 'facebook':
                $url = $loaded->facebook();
            break;
            case 'twitter':
                $url = $loaded->twitter();
            break;
            case 'gplus':
                $url = $loaded->gplus();
            break;
        }

        return redirect($url);
    }
}
