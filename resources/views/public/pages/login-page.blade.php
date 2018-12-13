@extends('master')
@section('pageTitle', 'Login')
@section('content')

<section class="login breadcrumbs container">s</section>
<section class="login container">
	<div class="frame-padding">
		<div class="ls__container">
			<p class="ls__title">Log in to your account</p>
			<p class="ls__desc">Log in to register new product</p>
			<form method="POST" action="{{ route('login') }}" class="ls__form">
				<div class="ls__form-row">
					<label>Email</label>
					<input class="input-text" type="email" name="email">
					<label class="error-label"><i>Email Address is required*</i></label>
				</div>
				<div class="ls__form-row">
					<label>Password</label>
					<input class="input-text" type="password" name="password">
				</div>
				<button class="btn btn-blue font--2">Login</button>
				<p class="signup">Don't have an account? <a href="{{ url('signup') }}">Sign up</a></p>
			</form>
		</div>
	</div>
</section>

@endsection