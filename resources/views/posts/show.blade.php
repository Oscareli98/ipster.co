@extends('app')

@section('title')
ipster | fotos hilarantes
@endsection

@section('class')
"page-view"
@endsection

@section('og')
{!! $og->renderTags() !!}
@endsection

@section('js')
<script src="{{ asset('bower_components/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/postGrid.js') }}"></script>
@endsection

@section('content')

<div class="content">
  <div class="left">
    <div class="posts">
      <h3>Fotos Calientes</h3>
      @foreach($top_left as $topPost)
        <a href="{{ route('posts.show', $topPost->id) }}" class="post">
          <img src="{{ $topPost->url }}" alt="">
          <div class="post-content">
            <div class="stats">
              <p class="time pull-left">{{ $topPost->views }} view{{ $topPost->views == 1 ? '' : 's' }}</p>
              <p class="shares pull-right">{{ $topPost->shares }} share{{ $topPost->shares == 1 ? '' : 's' }}</p>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>

  <div class="center">

    <div class="post-wrap">
      <div class="buttons">

        @if($post->hasPrev())
          <a href="{{ route('posts.show', $post->prev()->id) }}" class="prev"><i class="fa fa-arrow-left"></i></a>
        @else
          <a href="#" class="prev disabled"><i class="fa fa-arrow-left"></i></a>
        @endif

        <a href="{{ route('posts.show', $rand->id) }}" class="random"><i class="fa fa-random"></i></a>

        @if($post->hasNext())
          <a href="{{ route('posts.show', $post->next()->id) }}" class="next"><i class="fa fa-arrow-right"></i></a>
        @else
          <a href="#" class="next disabled"><i class="fa fa-arrow-right"></i></a>
        @endif

      </div>

      <div class="share">
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'facebook']) }}" class="facebook"><i class="fa fa-facebook"></i><span class="text"> Compartir</span></a>
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'twitter']) }}" class="twitter"><i class="fa fa-twitter"></i><span class="text"> Compartir</span></a>
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'gplus']) }}" class="gplus"><i class="fa fa-google-plus"></i></i><span class="text"> Compartir</span></a>
      </div>
      <div class="post">
        <img src="{{ $post->url }}" alt="">
        <div class="post-content">
          @if($post->title)
            <p class="title">{{ $post->title }}</p>
          @endif
          <div class="stats">
            <p class="time pull-left">{{ $post->views }} view{{ $post->views == 1 ? '' : 's' }}</p>
            <p class="shares pull-right">{{ $post->shares }} share{{ $post->shares == 1 ? '' : 's' }}</p>
          </div>
        </div>
      </div>

      <div class="share">
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'facebook']) }}" class="facebook"><i class="fa fa-facebook"></i><span class="text"> Compartir</span></a>
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'twitter']) }}" class="twitter"><i class="fa fa-twitter"></i><span class="text"> Compartir</span></a>
        <a target="_blank" href="{{ route('posts.share', [$post->id, 'gplus']) }}" class="gplus"><i class="fa fa-google-plus"></i></i><span class="text"> Compartir</span></a>
      </div>
    </div>



  </div>

  <div class="right">
    {{-- <div id="ayboll-w-5961"></div><script type="text/javascript">window._aybollw=window._aybollw||[];_aybollw.push(["id", "5961"]);</script> --}}
    &nbsp;
  </div>

</div>

<section class="posts-wrap hot">
  <h1>Fotos <strong>Caliente</strong></h1>
  <div class="posts masonry">
    @foreach($photos_hot as $post)
      <div class="post-outer">
        <a href="{{ route('posts.show', $post->id) }}" class="post">
          <img src="{{ $post->url }}" alt="">
          <div class="post-content">
            <div class="stats">
              <p class="time pull-left">{{ $post->views }} view{{ $post->views == 1 ? '' : 's' }}</p>
              <p class="shares pull-right">{{ $post->shares }} share{{ $post->shares == 1 ? '' : 's' }}</p>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</section>

</div>

@endsection