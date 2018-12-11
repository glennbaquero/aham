@extends('master')
@section('pageTitle', 'Selected Product')

@section('content')
<section class="selected-productpage container breadcrumbs">
	
</section>

<section class="selected-productpage container">
	<div class="sp__container">
		<div class="sp__col--1">
			<div class="sp__img-holder">
				<img class="img-fit" src="https://via.placeholder.com/200x200">
			</div
			><div class="sp__details">
				<p class="sp__code">AWFL-8300B</p>
				<p class="sp__name">10kg Fully Automatic Washing Machine</p>
				<p class="sp__desc">Your favourites look newer for longer with this washing machine that delivers deeper clean and better colour protection even in cold wash.</p>
				<a class="btn btn-blue" href=""><p>Download Manual</p></a>
			</div>
		</div
		><div class="sp__col--2">
			<p class="sp__title">Specification</p>
			<ul class="sp__specs">
				<li>3-layer Porcelain Coated Body</li>
				<li>Detergent and Softener Dispenser</li>
				<li>Stainless steel tub</li>
				<li>Fully Automatic</li>
				<li>Fabric Selector</li>
				<li>Quick wash</li>
				<li>Built-in heater</li>
				<li>Net Dimension 595mm x 565mm x 850mm</li>
				<li>Gross Dimension 595mm x 565mm x 850mm</li>
			</ul>
		</div>
	</div>
</section>
@include('includes.register-warranty-plan')
@endsection