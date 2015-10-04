@extends('app')

@section('title')
ipster | admin
@endsection

@section('class')
"page-admin-dashboard"
@endsection

@section('content')

<div class="container">

  <section class="new-post">


    <section class="scheduled-posts">
      <span class="inline"><h1 class="red">Scheduled <strong>Posts</strong></h1> <a href="{{ route('posts.create') }}" class="btn btn-large red">New Post</a></span>
      <ul class="post-list">
        @foreach($scheduled as $post)
          <li>
            <img src="{{ $post->url }}" alt="">
            <div class="content">
              <p class="title">{{ $post->title }}</p>
              <p class="schedule">scheduled for <strong>{{ $post->getHumanTimestampAttribute('scheduled') }}</strong></p>

            </div>
          </li>
        @endforeach
      </ul>
    </section>

  </section>


</div>

@endsection