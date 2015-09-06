@extends('app')

@section('content')

<div class="container">
	<form role="form" method="POST" action="{{ url('register') }}" class="form">
		<h1>Create an Account</h1>
			<h2>Already have an account? <a href="{{ url('login') }}">Sign in.</a></h2>

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.
				</div>
			@endif

			<div class="form-control @if($errors->has('name')) has-error @endif">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="Optional" value="{{{ Input::old('name') }}}">
	            <p class="error"></p>
	            @if($errors->has('name'))
	            	<p class="error">{{{ $errors->first('name') }}}</p>
	            @endif
			</div>

			<div class="form-control @if($errors->has('email')) has-error @endif">
				<label for="email">Email</label>
				<input type="email" name="email" id="email" value="{{{ Input::old('email') }}}" required>
	            <p class="error"></p>
	            @if($errors->has('email'))
	            	<p class="error">{{{ $errors->first('email') }}}</p>
	            @endif
			</div>

			<div class="form-control @if($errors->has('password')) has-error @endif">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required>
				@if($errors->has('password'))
					<p class="error">{{{ $errors->first('password') }}}</p>
				@endif
			</div>

			<button class="btn btn-large" type="submit">Create</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>

@endsection
