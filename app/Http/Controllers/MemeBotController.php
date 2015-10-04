<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

use Carbon\Carbon;
use Storage;
use Goutte;
use finfo;
use Facebook;

class MemeBotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function scrapeMemes()
    {
        // return Post::nextDateTimeString();
        // return Facebook::getPageTabHelper()->getAccessToken();

        $client = new Goutte();

        $crawler = $client->request('GET', 'http://loquillo.cheezburger.com/tag/Memes');

        $crawler->filter('.most-voted .panel-body div a')->each(function ($node) {
            $url = $node->filter('img')->attr('src');
            $url = preg_replace("/fill.[^\/]*/", "full", $url);


            // Upload Image
            $image = file_get_contents($url);
            $file_info = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $file_info->buffer($image);

            $storage_path = "/uploads/posts/images/";
            $filename = time() . uniqid() . '.' . $this->extension($mime_type);
            $filepath = $storage_path . $filename;
            Storage::disk('s3')->put($filepath, $image);

            $curmeme = [
                'url' => 'https://s3.amazonaws.com/ipster.co-uploads' . $filepath,
                'storage_path' => $filepath,
                'scheduled' => Post::nextDateTimeString(),
                'views' => rand(540,1070),
                'shares' => rand(135, 318),
            ];

            $post = Post::create($curmeme);
            $post->postToFacebook();

        });



    }

    public function extension($contentType)
    {
        $map = array(
            'application/pdf'   => 'pdf',
            'application/zip'   => 'zip',
            'image/gif'         => 'gif',
            'image/jpeg'        => 'jpg',
            'image/png'         => 'png',
            'text/css'          => 'css',
            'text/html'         => 'html',
            'text/javascript'   => 'js',
            'text/plain'        => 'txt',
            'text/xml'          => 'xml',
        );
        if (isset($map[$contentType]))
        {
            return $map[$contentType];
        }

        // HACKISH CATCH ALL (WHICH IN MY CASE IS
        // PREFERRED OVER THROWING AN EXCEPTION)
        $pieces = explode('/', $contentType);
        return '.' . array_pop($pieces);
    }
}
