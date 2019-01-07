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
						<p class="font--3 blah">{!! $item->banner_text_header !!}</p>
					</div>
					<div class="frame-title h__desc">
						<p class="font--2">{!! $item->banner_sub_text_header !!}</p>
					</div>
					<a href="{{ url('about') }}" class="btn btn-blue">Learn More</a>
				</div>
			</div>
		</div>

	</div>

	<div class="h__prod-category-container">
		<div class="h__prod-category-slider-holder">
			@foreach($categories as $category)
			<a href="{{ url('category') }}" class="h__products">
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
											<p class="h__f-prod-title">{{ $featured->model }}</p>
											<p class="h__f-prod-desc">{!! $featured->description !!}</p>
											<a class="btn btn-white font--1" href="{{ route('view.product', $featured->id) }}"><p>View Specs</p></a>
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
					<p class="h__title">{!! $item->bottom_2_text_header !!}</p>
					<p class="h__desc">{!! $item->bottom_2_text_sub !!}</p>
					<a class="btn btn-blue" href="{{ url('contact') }}"><p>Contact Us</p></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="homepage frame--4 container">
	<img class="img-fit" src="{{ $item->product_register }}">
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="h__reg-container animate-up">
					<p class="h__title">Register your product now!</p>
					<p class="h__desc">Register your product to 1 year free basic warranty or try our extended warranty plan! We've got you covered!</p>
					<select class="select">
						<option>Model Number</option>
						@foreach($products as $product)
							<option value="{{ $product->id }}">{{ $product->model }}</option>
						@endforeach
					</select>
					<img class="info" src="">
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
