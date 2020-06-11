@extends('master')
@section('pageTitle', 'Selected Product')

@section('content')
<section class="selected-productpage container breadcrumbs">
	
</section>

<section class="selected-productpage container">

	<ul id="breadcrumb" class="bc-border" style="margin-top: 0px; margin-left: 0px; list-style: none">
        <li><a href="/"><i class="icon ion-ios-home"> </i></a></li>
        <li><a href="warranty_info"><span class="icon icon-beaker"> </span> Products</a></li>
        <li><a href="{{ route('category.all.product', $product->category) }}"><span class="icon icon-double-angle-right"></span> {{ $product->category->name }}</a></li>
        <li><a href="{{ route('view.product', $product->id) }}" class="active"><span class="icon icon-double-angle-right"></span> {{ $product->model }}</a></li>
    </ul>

	<div class="sp__container animate-up">
		<div class="sp__col--1">

			<div class="sp__slider-holder">
				@foreach($product->images as $image)
					<div class="sp__img-holder">
						<img style="width: 100%" src=" {{ $image->renderFilePath() }} ">
					</div>
				@endforeach
			</div
			><div class="sp__details">
				<p class="sp__code">{{ $product->model }}</p>
				<p class="sp__name">{{ $product->name }}</p>
				<p class="sp__desc">{!! $product->description !!}</p>
				@if($product->manual_path) 
					<a class="btn btn-blue" href="{{ route('download.manual', $product->id) }}"><p>Download Manual</p></a>
				@endif
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
	<div class="reg__banner full frame__background size--cover bring--back" style="background-image: url('{{  asset('storage/'.$item->content) }}');"></div>
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