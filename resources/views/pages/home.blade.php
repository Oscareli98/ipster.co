@extends('app')

@section('title')
ipster | fotos hilarantes
@endsection

@section('content')

<section class="photo-section hot">
  <h1>Fotos <strong>Caliente</strong></h1>
  <ul class="posts">



    @foreach($posts as $post)

      <li>
      <a href="{{ route('posts.show', $post->id) }}">
        @if($post->title)
          <h2>{{ $post->title }}</h2>
        @endif
        <div class="image-wrap">
          <img class="zoom" src="{{ $post->url }}" alt="">
          <div class="overlay"><i class="fa fa-search-plus"></i></div>
        </div>
      </a>

    @endforeach

    <li class="more">
    <a href="#">Ver Más</a>

  </ul>
</section>


<section class="photo-section sponsored">
<div id="ayboll-w-5715"></div><script type="text/javascript">window._aybollw=window._aybollw||[];_aybollw.push(["id", "5715"]);</script>
</section>

</div>

<footer>

</footer>

@endsection