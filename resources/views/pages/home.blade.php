@extends('app')

@section('title')
ipster | fotos hilarantes
@endsection

@section('js')
<script src="{{ asset('bower_components/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/postGrid.js') }}"></script>
@endsection

@section('content')

<section class="posts-wrap hot">
  <h1>Fotos <strong>Calientes</strong></h1> <a class="btn btn-large more" href="{{ route('hot') }}" class="more">Ver Màs</a>
  <div class="posts masonry">
    @foreach($posts as $post)
      <div class="post-outer">
        <a href="{{ route('posts.show', $post->id) }}" class="post">
          <img src="{{ $post->url }}" alt="">
          <div class="post-content">
            <div class="stats">
              <p class="time pull-left">{{ $post->views }} visualizacione{{ $post->views == 1 ? '' : 's' }}</p>
              <p class="shares pull-right">compartida {{ $post->shares }} veces</p>
            </div>
          </div>
        </a>
      </div>
    @endforeach

  </div>
</section>




<section class="photo-section sponsored">
{{-- <div id="ayboll-w-5715"></div><script type="text/javascript">window._aybollw=window._aybollw||[];_aybollw.push(["id", "5715"]);</script> --}}
<style type="text/css" id="ac_80672_css">
/*  #ac_80672 {
    width: 16.666666%;
  }*/
</style>

<div id="contentad80672"></div>
<script type="text/javascript">
    (function(d) {
        var params =
        {
            id: "e87d58dd-5e27-43f6-9f7a-807fd0fe94b3",
            d:  "aXBzdGVyLmNv",
            wid: "80672",
            cb: (new Date()).getTime()
        };

        var qs=[];
        for(var key in params) qs.push(key+'='+encodeURIComponent(params[key]));
        var s = d.createElement('script');s.type='text/javascript';s.async=true;
        var p = 'https:' == document.location.protocol ? 'https' : 'http';
        s.src = p + "://api.content.ad/Scripts/widget2.aspx?" + qs.join('&');
        d.getElementById("contentad80672").appendChild(s);
    })(document);
</script>
</section>

</div>

<footer>

</footer>

@endsection