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
              <p class="time pull-left">{{ $post->views }} view{{ $post->views == 1 ? '' : 's' }}</p>
              <p class="shares pull-right">{{ $post->shares }} share{{ $post->shares == 1 ? '' : 's' }}</p>
            </div>
          </div>
        </a>
      </div>
    @endforeach

  </div>
</section>




<section class="photo-section sponsored">
{{-- <div id="ayboll-w-5715"></div><script type="text/javascript">window._aybollw=window._aybollw||[];_aybollw.push(["id", "5715"]);</script> --}}

</section>

</div>

<footer>

</footer>

@endsection