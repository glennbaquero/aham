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
	
	<div class="p__container animate-up">
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
	<div class="frame-padding animate-up">
		<product-list
			:fetchurl="'{{ route('all.products') }}'"
			>
		</product-list>
	</div>
</section>

@include('includes.register-warranty-plan')
@endsection