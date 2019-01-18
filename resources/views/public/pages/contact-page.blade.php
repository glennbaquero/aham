@extends('master')
@section('pageTitle', 'Contact')

@section('content')

<section  class="contactpage frame--1 container">
	<div class="frame-padding">
		<div class="c__container animate-up">
			<p class="c__title">Let's get in touch.</p>
			<p class="c__desc">Contact us and we will be more than happy to assists you.</p>
			<contact-us
			:url="'{{ route('contactus.message') }}'">
			</contact-us>
		</div>
	</div>
</section>

<section class="contactpage frame--2 container">
	<map-selector
	:fetchurl="'{{ route('public.locations.fetch') }}'">
	</map-selector>
</section>
<section class="register container">
	<div class="reg__banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->reg_prod_contact_us }}');"></div>
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