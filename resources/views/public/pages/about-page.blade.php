@extends('master')
@section('pageTitle', 'About')

@section('content')
<section class="aboutpage frame--1 container">
	<div class="banner__slider-holder">
		<div class="bg__slider">
			<div class="a__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg.jpg') }}');"></div>
		</div>
		<div class="bg__slider">
			<div class="a__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg.jpg') }}');"></div>
		</div>
		<div class="bg__slider">
			<div class="a__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg.jpg') }}');"></div>
		</div>
	</div>
	
	<div class="a__container">
		<div class="vertical-parent">
			<div class="vertical-align">
				<p class="a__title">Greener Future Together</p>
				<p class="a__desc">Value creation in the field of society and environment.</p>
			</div>
		</div>
	</div>
</section>

<section class="aboutpage frame--2 container">
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="a__container">
					<p class="a__title">Imagine. Inspire. Innovate</p>
					<div class="a__desc">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam

						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="aboutpage frame--3 container">
	<div class="frame-padding">
		<p class="a__title">Frequently Asked Questions</p>
		<div class="a__accordion__list">
			<div class="a__accordion">
				<p class="a__question">What is extended warranty plan?<i class="fa fa-arrow-down"></i></p>
				<div class="a__answer">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			<div class="a__accordion">
				<p class="a__question">What is covered by an extended warranty?<i class="fa fa-arrow-down"></i></p>
				<div class="a__answer">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>				
		</div>
	</div>
</section>

<section class="aboutpage frame--4 container">
	<div class="frame-padding">
		<p class="a__title">Our Strategic Partners</p>
		<div class="a-partners__sliderHolder slider-holder">
			<div class="a-partners__slider">
				<div class="a-partners__item">
					<img class="img-fit" src="https://via.placeholder.com/300x300">
				</div>
				<div class="a-partners__item">
					<img class="img-fit" src="https://via.placeholder.com/300x300">
				</div>
				<div class="a-partners__item">
					<img class="img-fit" src="https://via.placeholder.com/300x300">
				</div>
				<div class="a-partners__item">
					<img class="img-fit" src="https://via.placeholder.com/300x300">
				</div>
				<div class="a-partners__item">
					<img class="img-fit" src="https://via.placeholder.com/300x300">
				</div>
			</div>
			<div class="slider-arrows">
				<div id="next" class="slider-arrow--next"><i class="ion-ios-arrow-right"></i></div>
				<div id="prev" class="slider-arrow--prev"><i class="ion-ios-arrow-left"></i></div>
			</div>
		</div>
	</div>
</section>
@endsection