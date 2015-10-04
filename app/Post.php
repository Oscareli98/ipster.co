<?php

namespace App;

use OpenGraph;
use Carbon\Carbon;
use Facebook;

use Session;

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
        return Post::where('scheduled', '<=', new \DateTime('today'));
    }

    public function isPosted() {
        $scheduled = Carbon::parse($this->scheduled);
        $now = Carbon::now();
        return $scheduled->lte($now);
        // return $this->scheduled <= new \DateTime('today');
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

    /**
     * [toFacebook description]
     * @return [type] [description]
     */
    public function postToFacebook() {
        Facebook::setDefaultAccessToken(env('FACEBOOK_ACCESS_TOKEN'));

        $photo_url = urlencode($this->url);
        $base = env('FACEBOOK_PAGE_ID');

        $photo_id = json_decode(Facebook::post("$base/photos?no_story=1&url=$photo_url")->getGraphEvent(), true)['id'];
        $url = $base . "/feed?object_attachment=$photo_id";


        if(!$this->isPosted()) {
            $scheduled_time = Post::toUTCTimestamp($this->scheduled);
            $url .= "&published=0&scheduled_publish_time=$scheduled_time";
        }

        Facebook::post($url);
    }

    /**
     * The next date for a post that should be scheduled
     * @return timestamp
     */
    public static function nextDate() {
        $posts = Post::all();
        $dates = [];

        foreach ($posts as $post) {
            $scheduled = Carbon::parse($post->scheduled);
            $now = Carbon::now()->setTime(0,0);
            if($scheduled->gte($now)) {
                $key = Carbon::parse($post->scheduled)->toDateString();
                if(isset($dates[$key])) {
                    $dates[$key]++;
                } else {
                    $dates[$key] = 0;
                }
            }
        }
        if(count($dates) == 0) {
            return Carbon::now();
        } else {
            foreach ($dates as $date => $count) {
                if($count < 5) {
                    return Carbon::parse($date);
                }
            }
            $last_date = key( array_slice( $dates, -1, 1, TRUE ) );
            $next_day = Carbon::parse($last_date)->addDay();
            return $next_day;
        }
    }

    public static function randomTime() {
        $time = Carbon::createFromTime(6,0,0, 'America/Chicago')->addHours(rand(0, 3))->addMinutes(rand(0, 60));
        return $time;
    }

    public static function nextDateTimeString() {
        return Post::nextDate()->setTime(Post::randomTime()->hour, Post::randomTime()->minute)->toDateTimeString();
    }

    public static function toUTCTimestamp($timestamp) {
        return Carbon::parse($timestamp, 'America/Chicago')->setTimezone('UTC')->timestamp;
    }

}
