@extends('master')
@section('pageTitle', 'Warranty Information')

@section('content')

<section class="warrantyinfo frame--1 container">
	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->warranty_banner }}');"></div>
	<div class="frame-padding">
		<div class="wi__container animate-up">
			<div class="vertical-parent">
				<div class="vertical-align">
					<p class="wi__title">{{ strip_tags($item->banner_header_text) }}</p>
					<p class="wi__desc">{{ strip_tags($item->banner_sub_text) }}</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="warrantyinfo frame--2 container">
	<div class="frame-padding">
		<p class="wi__title animate-up">Warranty Policy</p>
		<div class="wi__container animate-up">
			<div class="wi__desc">
				{!! $item->policy !!}
			</div>
		</div>
	</div>
</section>

<section class="homepage frame--4 container">
	<img class="img-fit" src="{{ $item->warranty_product_register }}">
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