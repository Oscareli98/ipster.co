@extends('app')

@section('title')
new post | ipster
@endsection

@section('js')
<script src="{{ asset('js/lib/dropzone.js') }}"></script>
@endsection

@section('content')

    <div class="container">
        <form class="form" action="{{ route('posts.store') }}" method='POST' enctype="multipart/form-data">
           <h1 class="red">New <strong>Post</strong></h1>

               @if (count($errors) > 0)
                   <div class="alert alert-danger">
                       <strong>Whoops!</strong> There were some problems with your input.

                       <ul>
                           @foreach($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif

               {!! csrf_field() !!}

               <label class="form-control">Title
                   <input type="text" placeholder="for website only" id="title" name="title">
               </label>

               <label class="form-control">Caption
                   <input type="text" placeholder="for facebook only" id="caption" name="caption">
               </label>

               <label class="form-control">Time
                   <input type="datetime-local" placeholder="for website only" id="time" name="time">
               </label>

               <div class="form-control">
                 <label for="file">Image</label>
                 <input type="file" id="file" name="image" accept="image/*" aria-label="Image Select">
               </div>

               <button type="submit" class="btn">Save</button>
           </form>

    </div>

@endsection