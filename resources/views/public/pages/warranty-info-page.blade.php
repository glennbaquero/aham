@extends('master')
@section('pageTitle', 'Warranty Information')

@section('content')

<section class="warrantyinfo frame--1 container">
	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{ $item->warranty_banner }}');"></div>
	<div class="frame-padding">
		<div class="wi__container animate-up">
			<div class="vertical-parent">
				<div class="vertical-align">
					<p class="wi__title">{{ $item->banner_header_text }}</p>
					<p class="wi__desc">{!! $item->banner_sub_text !!}</p>
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