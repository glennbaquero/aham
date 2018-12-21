@extends('master')
@section('pageTitle', 'Basic Warranty')

@section('content')


<section class="basicwarranty container">
	<div class="bw__container animate-up">
		<p class="bw__title">Register your new product</p>

		<basic-warranty
			:fetchproducturl="'{{ route('fetch.product') }}'"
			:oneyearwarranty="'{{ route('apply.oneyear.warranty') }}'"
			:extendedurl="'{{ route('apply.extended.warranty') }}'"
		></basic-warranty>
		
	</div>
</section>
@endsection