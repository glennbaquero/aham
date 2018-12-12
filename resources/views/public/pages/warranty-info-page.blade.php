@extends('master')
@section('pageTitle', 'Warranty Information')

@section('content')

<section class="warrantyinfo frame--1 container">
	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->warranty_banner }}');"></div>
	<div class="frame-padding">
		<div class="wi__container">
			<div class="vertical-parent">
				<div class="vertical-align">
					<p class="wi__title">{{ $item->banner_header_text }}</p>
					<p class="wi__desc">{{ $item->banner_sub_text }}</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="warrantyinfo frame--2 container">
	<div class="frame-padding">
		<p class="wi__title">Warranty Policy</p>
		<div class="wi__container">
			
			<div class="wi__desc">
				{!! $item->policy !!}
			</div>
		</div>
	</div>
</section>
@include('includes.register-warranty-plan')
@endsection