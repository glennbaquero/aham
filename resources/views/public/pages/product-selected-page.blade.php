@extends('master')
@section('pageTitle', 'Selected Product')

@section('content')
<section class="selected-productpage container breadcrumbs">
	
</section>

<section class="selected-productpage container">
	<div class="sp__container animate-up">
		<div class="sp__col--1">
			<div class="sp__img-holder">
				@foreach($product->images as $image)
					<img class="img-fit" src=" {{ $image->renderFilePath() }} ">
				@endforeach
			</div
			><div class="sp__details">
				<p class="sp__code">{{ $product->model }}</p>
				<p class="sp__name">{{ $product->name }}</p>
				<p class="sp__desc">{{ $product->description }}</p>
				<a class="btn btn-blue" href="{{ route('download.manual', $product->id) }}"><p>Download Manual</p></a>
			</div>
		</div
		><div class="sp__col--2">
			<p class="sp__title">Specification</p>
			<ul class="sp__specs">
				<li> {!! $product->specification !!} </li>
			</ul>
		</div>
	</div>
</section>

<section class="register container">
	<div class="reg__banner full frame__background size--cover bring--back" style="background-image: url('{{ asset('images/bg3.jpg') }}');"></div>
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
								<a class="btn btn-white" href=""><p>Basic Warranty</p></a
								><a class="rw__btn btn outline--white inlineBlock-parent relative" href="">
									<div><img class="img-fit" src="{{ asset('images/logo-white.png')}}"></div><p>Extended Warranty</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection