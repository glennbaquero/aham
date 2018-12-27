@extends('master')
@section('pageTitle', 'Sign Up')
@section('content')

<section class="login login-breadcrumbs container">
</section>
<section class="login container">
	<div class="frame-padding">
		<div class="ls__container animate-up">
			<p class="ls__title">Register your account</p>
			<p class="ls__desc">Create your account to register your product</p>

			<form method="POST" action="{{ route('register') }}" class="ls__form">
				@csrf

				<div class="ls__form-row">
					<label>Email</label>
					<input class="input-text" type="email" name="email" value="{{ old('email') }}">
					<label class="error-label"><i>{{ $errors->first('email') }}</i></label>

				</div>
				<div class="ls__form-row">
					<label>Password</label>
					<input class="input-text" type="password" name="password">
					<label class="error-label"><i>{{ $errors->first('password') }}</i></label>
				</div>
				<div class="ls__form-row">
					<label>Confirm Password</label>
					<input class="input-text" type="password" name="password_confirmation">
				</div>
				<div class="ls__form-row">
					<label>Firstname</label>
					<input class="input-text" type="text" value="{{ old('firstname') }}" name="firstname">
					<label class="error-label"><i>{{ $errors->first('firstname') }}</i></label>
				</div>
				<div class="ls__form-row">
					<label>Lastname</label>
					<input class="input-text" type="text" value="{{ old('lastname') }}" name="lastname">
					<label class="error-label"><i>{{ $errors->first('lastname') }}</i></label>
				</div>
				<div class="ls__form-row">
					<label>Contact Number</label>
					<input class="input-text" type="text" value="{{ old('contact') }}" name="contact">
					<label class="error-label"><i>{{ $errors->first('contact') }}</i></label>
				</div>
				<div class="ls__form-row">
					<label>Birthdate</label>
					<input class="input-text flatPickr" type="text" name="birthday" value="{{ old('birthday') }}" placeholder="2017-12-26 (Y-M-D)">
					<label class="error-label"><i>{{ $errors->first('birthday') }}</i></label>
				</div>
				<label>Tap the links below and read them carefully. By checking the boxes, you have acknowledge that you read and agree to the following terms.</label>
				<div class="links">
					<label class="checkbox-lbl font--2">I Agree to all  <label class="error-label"><i>{{ $errors->has('agree') ? 'You need to agree to all is required*' : ''}}</i></label>
						  <input type="checkbox" class="agree_all" name="agree">
						  <span class="checkmark all"></span>
					</label>
					<label class="checkbox-lbl"><a href="">Terms & Conditions</a> <label class="error-label"><i>{{ $errors->has('terms') ? 'Terms and Condition is required*' : ''}}</i></label>
						  <input type="checkbox" class="tac" name="terms">
						  <span class="checkmark"></span>
					</label>
					<label class="checkbox-lbl">I Agree to <a href="">Ahamcorp Privacy Policy</a> <label class="error-label"><i>{{ $errors->has('privacy_policy') ? 'Privacy Policy is required*' : ''}}</i></label>
						  <input type="checkbox" class="privacy" name="privacy_policy" oldinputs>
						  <span class="checkmark"></span>
					</label>
					<label class="checkbox-lbl"><a href="">Receive marketing information</a>(optional)
						  <input type="checkbox" class="market_info" name="remember" oldinputs>
						  <span class="checkmark"></span>
					</label>
				</div>
				<button type="submit" class="btn btn-blue font--2">Sign up</button>
				<p class="signup">Already have an account? <a href="{{ route('login') }}">Log In</a></p>
			</form>
		</div>
	</div>
</section>

@endsection

@section('js')
	<script type="text/javascript">
		$(function(){

			$('.all').click(function(){
				if($('.agree_all').is(':checked')) {
					$('.tac').attr( 'checked', false );
					$('.privacy').attr( 'checked', false );
					$('.market_info').attr( 'checked', false );
				} else {
					$('.tac').attr( 'checked', true );
					$('.privacy').attr( 'checked', true );
					$('.market_info').attr( 'checked', true );
				}
			})

			$('.flatPickr').focus(function(){
				var year = (new Date()).getUTCFullYear();

	            $(document).ready(function(){
	                $('.flatPickr').flatpickr({
	                    dateFormat:'Y-m-d', 
	                    allowInput:true,
	                    maxDate: '01-01-'+year,
	                });
	            });
				
			})
		})
	</script>
@endsection