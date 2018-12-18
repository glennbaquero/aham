@extends('master')
@section('pageTitle', 'Contact')

@section('content')

<section  class="contactpage frame--1 container">
	<div class="frame-padding">
		<div class="c__container animate-up">
			<p class="c__title">Let's get in touch.</p>
			<p class="c__desc">Contact us and we will be more than happy to assists you.</p>
			<contact-us
			:url="'{{ route('contactus.message') }}'"></contact-us>
		</div>
	</div>
</section>

<section class="contactpage frame--2 container">
	<div class="c__sc-row animate-up">
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