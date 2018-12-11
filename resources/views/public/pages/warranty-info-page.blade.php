@extends('master')
@section('pageTitle', 'Warranty Information')

@section('content')

<section class="warrantyinfo frame--1 container">
	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg.jpg') }}');"></div>
	<div class="frame-padding">
		<div class="wi__container">
			<div class="vertical-parent">
				<div class="vertical-align">
					<p class="wi__title">Warranty Infomation</p>
					<p class="wi__desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="warrantyinfo frame--2 container">
	<div class="frame-padding">
		<p class="wi__title">Warranty Policy</p>
		<div class="wi__container">
			<p class="wi__title">Limitations and Exclusions</p>
			<div class="wi__desc">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		<div class="wi__container">
			<p class="wi__title">What is NOT covered by your warranty</p>
			<div class="wi__desc">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
	</div>
</section>
@include('includes.register-warranty-plan')
@endsection