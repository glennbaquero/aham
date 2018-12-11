@extends('master')
@section('pageTitle', 'Sign Up')
@section('content')

<section class="login login-breadcrumbs container">
</section>
<section class="login container">
	<div class="frame-padding">
		<div class="ls__container">
			<p class="ls__title">Register your account</p>
			<p class="ls__desc">Create your account to register your product</p>
			<form class="ls__form">
				<div class="ls__form-row">
					<label>Email</label>
					<input class="input-text" type="email" name="email" required>
					<label class="error-label"><i>Email Address is required*</i></label>
				</div>
				<div class="ls__form-row">
					<label>Password</label>
					<input class="input-text" type="password" name="password">
				</div>
				<div class="ls__form-row">
					<label>Confirm Password</label>
					<input class="input-text" type="password" name="password2">
				</div>
				<div class="ls__form-row">
					<label>Firstname</label>
					<input class="input-text" type="text" name="fname">
				</div>
				<div class="ls__form-row">
					<label>Lastname</label>
					<input class="input-text" type="text" name="lname">
				</div>
				<div class="ls__form-row">
					<label>Birthdate</label>
					<input class="input-text" type="date" name="bday">
				</div>
				<label>Tap the links below and read them carefully. By checking the boxes, you have acknowledge that you read and agree to the following terms.</label>
				<div class="links">
					<label class="checkbox-lbl font--2">I Agree to all
						  <input type="checkbox" name="agree" checked="">
						  <span class="checkmark"></span>
					</label>
					<label class="checkbox-lbl"><a href="">Terms & Conditions</a>
						  <input type="checkbox" name="terms">
						  <span class="checkmark"></span>
					</label>
					<label class="checkbox-lbl">I Agree to <a href="">Ahamcorp Privacy Policy</a>
						  <input type="checkbox" name="remember" oldinputs>
						  <span class="checkmark"></span>
					</label>
					<label class="checkbox-lbl"><a href="">Receive marketing information</a>(optional)
						  <input type="checkbox" name="remember" oldinputs>
						  <span class="checkmark"></span>
					</label>
				</div>
				<button class="btn btn-blue font--2">Sign up</button>
				<p class="signup">Already have an account? <a href="{{ url('login') }}">Log In</a></p>
			</form>
		</div>
	</div>
</section>

@endsection