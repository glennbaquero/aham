@extends('master')

@section('pageTitle', 'Products')

@section('content')

	<section class="productpage frame--1 container">
		<div class="banner__slider-holder">
			@foreach($product_sliders as $carousel)
				@foreach($carousel->images as $image)
					<div class="bg__slider">
						<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{ $image->renderFilePath() }} ');"></div>
					</div>
				@endforeach
			@endforeach
			
		</div>
		

		<div class="p__container">
			<div class="vertical-parent">
				<div class="vertical-align">
					<p class="p__title">{{ strip_tags($item->slider_text_header) }}</p>
					<p class="p__desc">{{ strip_tags($item->slider_text_sub) }}</p>
				</div>
			</div>
		</div>
	</section>

	<section class="productpage frame--2 container">
		<div class="frame-padding">
			<product-page
			:fetchurl="'{{ route('public.products.fetch') . '?' . $params }}'"
			:filterurl="'{{ route('public.products.filters') }}'">
			</product-page>
		</div>
	</section>

	<section class="register container">
		<div class="reg__banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->register_product }}');"></div>
		<div class="frame-padding">
			<div class="vertical-parent">
				<register-product
				:products="{{ $products }}"
				:basicurl="'{{ route('user.basic') }}'"
				:extendedurl="'{{ route('user.extended') }}'"></register-product>
			</div>
		</div>
	</section>
@endsection