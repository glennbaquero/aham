@extends('master')
@section('pageTitle', 'About')

@section('content')
<section class="aboutpage frame--1 container">
	<div class="banner__slider-holder">
		@foreach($carousels_about as $carousel)
			@foreach($carousel->images as $image)
				<div class="bg__slider">
					<div class="a__banner full frame__background size--cover bring--back" style="background-image: url('{{ $image->renderFilePath() }}');"></div>
				</div>
			@endforeach
		@endforeach
	</div>
	
	<div class="a__container animate-up">
		<div class="vertical-parent">
			<div class="vertical-align">
				<p class="a__title">{{ strip_tags($item->banner_slider_text) }}</p>
				<p class="a__desc">{{ strip_tags($item->banner_slider_subtext) }}</p>
			</div>
		</div>
	</div>
</section>

<section class="aboutpage frame--2 container">
	<img class="img-fit" src="{{ $item->about_us_frame2_bg }}">
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="a__container animate-up">
					<p class="a__title">{{ strip_tags($item->about_us_frame2_text) }}</p>
					<div class="a__desc">
						{{ strip_tags($item->about_us_frame2_info) }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="aboutpage frame--3 container">
	<div class="frame-padding animate-up">
		<p class="a__title">Frequently Asked Questions</p>
		<div class="a__accordion__list">
			@foreach($faqs as $faq)
			<div class="a__accordion">
				<p class="a__question">{!! $faq->question !!}<i class="fa fa-arrow-down"></i></p>
				<div class="a__answer">
					{!! $faq->answer !!}
				</div>
			</div>
			@endforeach		
		</div>
	</div>
</section>

<section class="aboutpage frame--4 container">
	<div class="frame-padding animate-up">
		<p class="a__title">Our Strategic Partners</p>
		<div class="a-partners__sliderHolder slider-holder">
			<div class="a-partners__slider">
				@foreach($carousels as $carousel)
					@foreach($carousel->images as $image)
						<div class="a-partners__item">
							<img class="img-fit" src="{{ $image->renderFilePath() }}">
						</div>
					@endforeach
				@endforeach
			</div>
			<div class="slider-arrows">
				<div id="next" class="slider-arrow--next"><i class="ion-ios-arrow-right"></i></div>
				<div id="prev" class="slider-arrow--prev"><i class="ion-ios-arrow-left"></i></div>
			</div>
		</div>
	</div>
</section>
@endsection