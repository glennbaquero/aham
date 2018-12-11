@extends('master')
@section('pageTitle', 'Contact')

@section('content')

<section  class="contactpage frame--1 container">
	<div class="frame-padding">
		<div class="c__container">
			<p class="c__title">Let's get in touch.</p>
			<p class="c__desc">Contact us and we will be more than happy to assists you.</p>
			<form class="c__form">
				<div class="c__form-row">
					<label>Firstname</label>
					<input class="input-text" type="text" name="fname">
				</div
				><div class="c__form-row">
					<label>Lastname</label>
					<input class="input-text" type="text" name="lname">
				</div
				><div class="c__form-row">
					<label>Email</label>
					<input class="input-text" type="email" name="email">
				</div
				><div class="c__form-row">
					<label>Phone Number</label>
					<input class="input-text" type="text" name="num">
				</div>
				<div class="c__form-row textarea">
					<textarea class="textarea" placeholder="Message"></textarea>
				</div>
				<button class="btn btn-blue">Send</button>
			</form>
		</div>
	</div>
</section>

<section class="contactpage frame--2 container">
	<div class="c__sc-row">
		<div class="c__sc-col">
			<p class="c__title">Authorized Service Centers</p>
			
			<div class="c__sc-container">
				<select class="select">
					<option>Chef's Magic Trade Center Inc.</option>
				</select>
				<div class="c__sc-holder">
					<p class="c__sc-name">Chef's Magic Trade Center Inc.</p>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-map-marker-alt"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Address</p>
							<p class="c__desc">1st. Floor, CYA Building #34 Morato St., SFDM</p>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-phone"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Contact Details</p>
							<p class="c__desc">(02) 376-2287 to 90</p>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-envelope"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Email Address</p>
							<p class="c__desc">Jocelyn.mosquite@ahamcorp.com</p>
						</div>
					</div>
					<p class="c__sc-name">Chef's Magic Trade Center Inc.</p>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-map-marker-alt"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Address</p>
							<p class="c__desc">1st. Floor, CYA Building #34 Morato St., SFDM</p>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-phone"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Contact Details</p>
							<p class="c__desc">(02) 376-2287 to 90</p>
						</div>
					</div>
					<div class="c__sc-details">
						<div class="icon">
							<i class="fa fa-envelope"></i>
						</div
						><div class="c__sc-contact">
							<p class="c__title">Email Address</p>
							<p class="c__desc">Jocelyn.mosquite@ahamcorp.com</p>
						</div>
					</div>
				</div>
			</div>
		</div
		><div class="c__sc-col">
			
		</div>
	</div>
</section>

@include('includes.register-warranty-plan')
@endsection