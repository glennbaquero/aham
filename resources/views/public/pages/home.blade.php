@extends('master')
@section('pageTitle', 'Home')
@section('content')

<section class="homepage frame--1 container">
	<div class="h__banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->banner_image }}');"></div>
	<div class="frame-padding">


		<div class="h__text-holder animate-up">
			<div class="vertical-parent">
				<div class="vertical-align">
					<div class="frame-title h__title">
						<p class="font--3 blah">{{ strip_tags($item->banner_text_header) }}</p>
					</div>
					<div class="frame-title h__desc">
						<p class="font--2">{{ strip_tags($item->banner_sub_text_header) }}</p>
					</div>
					<a href="{{ url('about') }}" class="btn btn-blue">Learn More</a>
				</div>
			</div>
		</div>

	</div>

	<div class="h__prod-category-container">
		<div class="h__prod-category-slider-holder">
			
			@foreach($categories as $category)<a class="h__products" href="">
				<div class="h__products-img-holder">
					<img class="img-fit" src="{{ $category->renderFilePath() }}">
				</div>
				<p>{{ $category->name }}</p>
			</a
			>@endforeach
		</div>
	</div>
</section>

<section class="homepage frame--2 container">
	<div class="h__banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->featured_product_bg }}');"></div>
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="h__f-prod-container row center-align animate-up">
					<p class="h__f-prod-title">Featured Products</p>
					<div class="h__slider-holder">
						<div class="top_slider">
							@foreach($featured_products as $featured)

							<div class="h__slider">
								<div class="h__f-prod-col--1">
									<div class="h__f-prod-img-holder">
										<img class="img-fit" src="{{ $featured->renderFilePath() }}">
									</div>
								</div
								><div class="h__f-prod-col--2">
	
									<div class="h__slider-desc vertical-parent">
										<div class="vertical-align">

											<h2 class="h__f-prod-title">{{ strip_tags($featured->model) }}</h2>
											<p class="h__f-prod-desc">{{ strip_tags($featured->description) }}</p>
											<a class="btn btn-white font--1" href="{{ route('view.product', $featured->id) }}">View Specs</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
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
				<div class="h__contact-container animate-up">
					<p class="h__title">{{ strip_tags($item->bottom_2_text_header) }}</p>
					<p class="h__desc">{{ strip_tags($item->bottom_2_text_sub) }}</p>
					<a class="btn btn-blue" href="{{ url('contact') }}"><p>Contact Us</p></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="homepage frame--4 container">
	<div class="full frame__background size--cover bring--front" style="background-color: #f4f5f7;"></div>
	{{-- <div class="h__banner full frame__background size--cover bring--front" style="background-image: url('{{ $item->featured_product_bg }}');"></div> --}}
	<img class="img-fit" src="{{ $item->product_register }}">
	<div class="frame-padding">
		<div class="vertical-parent">
			<products-registration
			:products="{{ $products }}"
			:basicurl="'{{ route('user.basic') }}'"
			:extendedurl="'{{ route('user.extended') }}'"></products-registration>
		</div>
	</div>
</section>

@endsection
