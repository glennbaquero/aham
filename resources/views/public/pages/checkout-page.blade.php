@extends('master')
@section('pageTitle', 'Checkout')

@section('content')


<section class="checkout container">
	<div class="ch__container animate-up">
		<div class="ch__col--1">
			<p class="ch__title">Checkout</p>
			<form>
				<div class="ch__form-row">
					<label>Application Number</label>
					<input class="input-text" type="text" name="">
					<img src="{{ asset('images/valid.png')}}">
				</div>
				<div class="ch__form-row">
					<label>Payment</label>
					<input class="input-text" type="text" name="">
				</div>
				<div class="ch__form-row">
					<label>Bank</label>
					<input class="input-text" type="text" name="">
					<img src="{{ asset('images/valid.png')}}">
				</div>
			</form>
			<p class="ch__sub-title">Payment Method</p>
			<div class="check-box">
				<label class="checkbox-lbl font--2">iPay88
					<input type="checkbox" name="agree">
					<span class="checkmark"></span>
				</label>
			</div>
		</div
		><div class="ch__col--2">
			<form class="ch__form">
				<p class="ch__title">Your Product</p>
				<div class="ch__form-row">
					<label>Model Number</label>
					<input class="input-text" type="text" name="">
				</div>
				<div class="ch__form-row">
					<label>Serial Number</label>
					<input class="input-text" type="text" name="">
				</div>
				<div class="ch__form-row">
					<label>Contact Number</label>
					<input class="input-text" type="text" name="">
				</div>
				<div class="ch__form-row">
					<label>Discount Code</label>
					<input class="input-text error" type="text" name=""><img src="{{ asset('images/invalid.png')}}">
				</div>
				<div class="ch__form-row inlineBlock-parent by-2">
					<div>
						<p class="ch__title">Total:</p>	
					</div
					><div class="right-align">
						<p class="ch__title">P 1,200.00</p>
					</div>
				</div>
			</form>
			<div class="check-box">
				<label class="checkbox-lbl font--2"><b>Agree to</b> Terms & Conditions & AHAMCorp Privacy Policy
					<input type="checkbox" name="agree">
					<span class="checkmark"></span>
				</label>
			</div>
			<div class="center-align">
				<button class="btn btn-blue"><p>Submit</p></button>
				<a href="" class="btn outline--blue"><p>Back</p></a>
			</div>
		</div>		
	</div>
</section>
@endsection