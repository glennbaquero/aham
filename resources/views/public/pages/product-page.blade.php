@extends('master')
@section('pageTitle', 'Products')
@section('content')

<section class="productpage frame--1 container">
	<div class="banner__slider-holder">
		<div class="bg__slider">
			<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg4.jpg') }}');"></div>
		</div>
		<div class="bg__slider">
			<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg4.jpg') }}');"></div>
		</div>
		<div class="bg__slider">
			<div class="frame-banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg4.jpg') }}');"></div>
		</div>
	</div>
	
	<div class="p__container">
		<div class="vertical-parent">
			<div class="vertical-align">
				<p class="p__title">Have a cool one with this!</p>
				<p class="p__desc">Let your family feel comfortable with your desired temperature.</p>
			</div>
		</div>
	</div>
</section>

<section class="productpage container breadcrumbs">
	
</section>

<section class="productpage frame--2 container">
	<div class="frame-padding">
		<p class="p__title">Refrigerator</p>
		<div class="p__holder">
			<div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div><div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div><div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div><div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div><div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div><div class="p__col">
				<div class="p__img-holder">
					<img class="img-fit" src="https://via.placeholder.com/200x200">
				</div>
				<div class="p__details">
					<p class="p__code">AWF-10KFZ</p>
					<p class="p__name">Fully Auto Washer</p>
					<ul class="p__specs">
						<li>Polypropylene plastic body</li>
						<li>Anti-bacteria and anti-mold</li>
						<li>100% dent and rust free</li>
					</ul>
				</div>
				<a href="" class="btn outline--blue"><p>View Specs</p></a>
			</div>
			
		</div>
		<div class="center-align">
			<a class="btn btn-blue" href=""><p>View all</p></a>
		</div>
	</div>
</section>



@include('includes.register-warranty-plan')
@endsection