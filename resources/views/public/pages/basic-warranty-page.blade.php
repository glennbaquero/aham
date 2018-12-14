@extends('master')
@section('pageTitle', 'Basic Warranty')

@section('content')


<section class="basicwarranty container">
	<div class="bw__container">
		<p class="bw__title">Register your new product</p>
		<basic-warranty
			:fetchproducturl="'{{ route('fetch.product') }}'"
			:oneyearwarranty="'{{ route('apply.oneyear.warranty') }}'"
		></basic-warranty>
	</div>
</section>
@endsection