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
							</select><div class="tool-tip register" data-tooltip-title="Content here" data-tooltip-position="right"><i class="color--red fa fa-exclamation-circle"></i></div>
						</div>
						
						<div class="rw__form-row">
							<div class="button">
								<a class="btn btn-white" href="{{ route('user.basic') }}"><p>Basic Warranty</p></a
								><a class="btn outline--white" href="{{ route('user.extended') }}"><p>Extended Warranty</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection