@extends('app')

@section('content')

<div class="container">
	<form role="form" method="POST" action="{{ url('login') }}" class="form">
		<h1>Sign In</h1>

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.
				</div>
			@endif

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
				<a href="{{ url('/password/email') }}">Forgot your password?</a>
			</div>
			<div class="form-control">
				<label class="label-cb"><input type="checkbox" name="remember"> Remember Me</label>
			</div>
			<button class="btn btn-large" type="submit">Sign In</button>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>

@endsection
