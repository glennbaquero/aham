@extends('master')
@section('pageTitle', 'Home')
@section('content')

<section class="homepage frame--1 container">
	<div class="h__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg.jpg') }}');"></div>
	<div class="frame-padding">
		<div class="h__text-holder">
			<div class="vertical-parent">
				<div class="vertical-align">
					<div class="frame-title h__title">
						<p class="font--3 blah">The Voice of the Appliance Industry</p>
					</div>
					<div class="frame-title h__desc">
						<p class="font--2">Leading the way.</p>
					</div>
					<a href="{{ url('about') }}" class="btn btn-blue">Learn More</a>
				</div>
			</div>
		</div>
		
	</div>

	<div class="h__prod-category-container">
		<div class="h__prod-category-slider-holder">
			<a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Refrigerators</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Microwaves</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Washing Machines</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Air Conditions</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Televisions</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Kitchen</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Televisions</p>
			</a
			><a href="{{ url('category') }}" class="h__products">
				<div class="h__products-img-holder">
					<img class="img-fit" src="//via.placeholder.com/60x60">
				</div>
				<p>Kitchen</p>
			</a>

		</div>
	</div>
</section>

<section class="homepage frame--2 container">
	<div class="h__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg2.png') }}');"></div>
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="h__f-prod-container row center-align">
					<p class="h__f-prod-title">Featured Products</p>
					<div class="h__slider-holder">
						<div class="top_slider">
							<div class="h__slider">
								<div class="h__f-prod-col--1">
									<div class="h__f-prod-img-holder">
										<img class="img-fit" src="//via.placeholder.com/60x60">
									</div>
								</div
								><div class="h__f-prod-col--2">
									<div class="h__slider-desc vertical-parent">
										<div class="vertical-align">
											<p class="h__f-prod-title">AWFL-8300B</p>
											<p class="h__f-prod-desc">Your favourites look newer for longer with this washing machine that delivers deeper clean and better color protection even in cold wash.</p>
											<a class="btn btn-white font--1" href="{{ url('selected') }}"><p>View Specs</p></a>
										</div>
									</div>
								</div>
							</div>
							<div class="h__slider">
								<div class="h__f-prod-col--1">
									<div class="h__f-prod-img-holder">
										<img class="img-fit" src="//via.placeholder.com/60x60">
									</div>
								</div
								><div class="h__f-prod-col--2">
									<div class="h__slider-desc vertical-parent">
										<div class="vertical-align">
											<p class="h__f-prod-title">AWdFL-8300B</p>
											<p class="h__f-prod-desc">Your favourites look newer for longer with this washing machine that delivers deeper clean and better color protection even in cold wash.</p>
											<a class="btn btn-white font--1" href="{{ url('selected') }}"><p>View Specs</p></a>
										</div>
									</div>
								</div>
							</div>
							<div class="h__slider">
								<div class="h__f-prod-col--1">
									<div class="h__f-prod-img-holder">
										<img class="img-fit" src="//via.placeholder.com/60x60">
									</div>
								</div
								><div class="h__f-prod-col--2">
									<div class="h__slider-desc vertical-parent">
										<div class="vertical-align">
											<p class="h__f-prod-title">AaWFL-8300B</p>
											<p class="h__f-prod-desc">Your favourites look newer for longer with this washing machine that delivers deeper clean and better color protection even in cold wash.</p>
											<a class="btn btn-white font--1" href="{{ url('selected') }}"><p>View Specs</p></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="homepage frame--3 container">
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="h__contact-container">
					<p class="h__title">We'd like to hear from you!</p>
					<p class="h__desc">Got a question about our warranty plans? We offer user guides and service manuals for the operation and care of your American Home Appliances products.</p>
					<a class="btn btn-blue" href="{{ url('contact') }}"><p>Contact Us</p></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="homepage frame--4 container">
	<img class="img-fit" src="{{asset('images/1.jpg') }}">
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="h__reg-container">
					<p class="h__title">Register your product now!</p>
					<p class="h__desc">Register your product to 1 year free basic warranty or try our extended warranty plan! We've got you covered!</p>
					<select class="select">
						<option>Model Number</option>
					</select>
					<img class="info" src="{{asset('images/info.png') }}">
					<div class="button">
						<a class="btn btn-blue" href=""><p>Basic Warranty</p></a>
						<a class="btn outline--blue" href=""><p>Extended Warranty</p></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
