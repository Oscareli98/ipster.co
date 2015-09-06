@extends('app')

@section('title')
new post | ipster
@endsection

@section('content')

    <div class="container">
        <form class="form" action="{{ route('posts.store') }}" method='POST' enctype="multipart/form-data">
            <h1>Create a Post</h1>

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
                <input type="text" id="title" name="title">
            </label>


            <div class="form-control">
            <label for="file">Image</label>
            {{-- <label class="file form-control"> --}}
              <input type="file" id="file" name="image" accept="image/*" aria-label="Image Select">
              {{-- <span class="file-custom"></span> --}}
            {{-- </label> --}}
            </div>

            <button type="submit" class="btn">Save</button>
        </form>
    </div>

@endsection