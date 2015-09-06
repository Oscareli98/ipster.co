@extends('app')

@section('content')

<div class="container">
	<form class="form" role="form" method="POST" action="{{ url('/password/email') }}">
		<h1>Reset Password</h1>
		<fieldset>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.
				</div>
			@endif

			<div class="input-group @if($errors->has('email')) has-error @endif">
				<label>Email Address</label>
				<input type="email" name="email" value="{{ old('email') }}">
				@if($errors->has('email'))
					<p class="error">{{{ $errors->first('email') }}}</p>
				@endif
			</div>

			<button class="button" type="submit">Send Reset Email</button>
		</fieldset>
	</form>
</div>

@endsection
