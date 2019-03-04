@extends('master')
@section('pageTitle', 'Product Category')

@section('content')

<section class="product-category-page frame--1 container">

	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('storage/{{ $banner[0]->content }}');"></div>
	<div class="frame-padding">
		<div class="pc__container animate-up">
			<p class="pc__title">{{ $header[0]->content }} </p>
			<p class="pc__desc">{{ $sub_text[0]->content }}</p>
		</div>
	</div>
</section>

<section class="product-category-page breadcrumbs container">
	
</section>

<section class="productpage frame--2 container">
	<div class="frame-padding animate-up">
		<div>
			<ul id="breadcrumb" class="bc-border" style="margin-top: 0px; margin-left: 0px; list-style: none">
		        <li><a href="/"><i class="icon ion-ios-home"> </i></a></li>
		        <li><a href="/products"><span class="icon icon-double-angle-right"></span> Products</a></li>
		        <li><a href="/" class="active"><span class="icon icon-double-angle-right"></span>{{ $category->name }}</a></li>
		    </ul>
		</div>
		<p class="p__title">{{ $category->name }}</p>
		<div class="p__holder">
			@foreach($category->products as $product)<div class="p__col">
					<div class="p__img-holder">
						<img class="p__product-img" src="{{ $product->renderFilePath() }}">
					</div>
					<div class="p__details">
						<p class="p__code">{{ $product->model }}</p>
						<p class="p__name">{{ $product->name }}</p>
						<ul class="p__specs">
							<li> {!! $product->specification !!} </li>
						</ul>
					</div>
					<a href="{{ route('view.product', $product->id) }}" class="btn outline--blue"><p>View Specs</p></a>
				</div>@endforeach
		</div>
	</div>
</section>

@endsection