{{-- @extends('master')
@section('pageTitle', 'User Profile')
@section('content')

<section class="user-profile container">
	<div class="usr__sidebar">
		@include('includes.sidebar')
	</div

	><div class="usr__main">
		<div class="usr__container">
			<user-profile
					:fetchurl = "'{{ route('user.fetch.details') }}'"
					:updateurl = "'{{ route('user.update', auth()->user()->id) }}'"
					:updatepasswordurl = "' {{ route('user.update.password', auth()->user()->id) }} '"
			></user-profile>
			
		</div>
	</div>
</section>

@endsection --}}

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
					<input class="input-text" type="email" name="email">
				</div>
				<div class="ch__form-row">
					<label>Payment</label>
					<input class="input-text" type="email" name="email">
				</div>
				<div class="ch__form-row">
					<label>Bank</label>
					<input class="input-text" type="email" name="email">
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
					<input class="input-text" type="email" name="email">
				</div>
				<div class="ch__form-row">
					<label>Serial Number</label>
					<input class="input-text" type="email" name="email">
				</div>
				<div class="ch__form-row">
					<label>Contact Number</label>
					<input class="input-text" type="email" name="email">
				</div>
				<div class="ch__form-row">
					<label>Discount Code</label>
					<input class="input-text" type="email" name="email">
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
				<label class="checkbox-lbl font--2">iPay88
					<input type="checkbox" name="agree">
					<span class="checkmark"></span>
				</label>
			</div>
		</div>		
	</div>
</section>
@endsection