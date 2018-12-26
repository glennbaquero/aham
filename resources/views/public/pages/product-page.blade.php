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
					<p class="p__title">{{ $item->slider_text_header }}</p>
					<p class="p__desc">{{ $item->slider_text_sub }}</p>
				</div>
			</div>
		</div>
	</section>

	<section class="productpage container breadcrumbs">
		
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
			<div class="vertical-align">
				<div class="rw__container center-align animate-up">
					<p class="rw__title">Not yet registered to a warranty plan?</p>
					<form class="rw__form">
						<div class="rw__form-row">
							<select class="select">
								@foreach($products as $product)
									<option value="{{ $product->id }}"> {{ $product->model }} </option>
								@endforeach
							</select><div class="info"><img src="{{asset('images/info.png') }}"></div>
						</div>
						
						<div class="rw__form-row">
							<div class="button">
								<a class="btn btn-white" href=""><p>Basic Warranty</p></a
								><a class="btn outline--white" href=""><p>Extended Warranty</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection