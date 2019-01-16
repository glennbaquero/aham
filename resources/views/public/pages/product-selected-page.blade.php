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
				<p class="sp__desc">{{ $product->desciption }}</p>
				<a class="btn btn-blue" href="{{ route('download.manual', $product->id) }}"><p>Download Manual</p></a>
			</div>
		</div
		><div class="sp__col--2">
			<p class="sp__title">Specification</p>
			<ul class="sp__specs">
				<li> {{ $product->specification }} </li>
			</ul>
		</div>
	</div>
</section>
<section class="homepage frame--4 container">
	<img class="img-fit" src="">
	<div class="frame-padding">
		<div class="vertical-parent">
			<products-registration
			:products="{{ $products }}"
			:basicurl="'{{ route('user.basic') }}'"
			:extendedurl="'{{ route('user.extended') }}'"></products-registration>
		</div>
	</div>
</section>

@endsection