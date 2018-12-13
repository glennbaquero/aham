@extends('master')
@section('pageTitle', 'Product Category')

@section('content')

<section class="product-category-page frame--1 container">
	<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg5.jpg') }}');"></div>
	<div class="frame-padding">
		<div class="pc__container">
			<p class="pc__title">Washing Aglow!</p>
			<p class="pc__desc">Sustainability Standard for Household Clothes Washing Appliances</p>
		</div>
	</div>
</section>

<section class="product-category-page breadcrumbs container">
	
</section>

<section class="productpage frame--2 container">
	<div class="frame-padding">
		<p class="p__title">{{ $category->name }}</p>
		<div class="p__holder">
			@foreach($category->products as $product)
				<div class="p__col">
					<div class="p__img-holder">
						<img class="img-fit" src="{{ $product->renderFilePath() }}">
					</div>
					<div class="p__details">
						<p class="p__code">{{ $product->model }}</p>
						<p class="p__name">{{ $product->name }}</p>
						<ul class="p__specs">
							<li> {!! $product->specification !!} </li>
						</ul>
					</div>
					<a href="" class="btn outline--blue"><p>View Specs</p></a>
				</div>@endforeach
		</div>
	</div>
</section>

@endsection