@extends('master')
@section('pageTitle', 'Basic Warranty')

@section('content')


<section class="basicwarranty container">
	<ul id="breadcrumb" class="bc-border">
        <li><a href="/"><i class="icon ion-ios-home"> </i></a></li>
        <li><a href="warranty_info"><span class="icon icon-beaker"> </span> Warranty</a></li>
        <li><a href="{{ route('user.basic') }}" class="active"><span class="icon icon-double-angle-right"></span> Basic Warranty</a></li>
    </ul>
	<div class="bw__container animate-up">
		<p class="bw__title" style="margin-top:0px">Register your new product</p>

		<basic-warranty
			:fetchproducturl="'{{ route('fetch.product') }}'"
			:oneyearwarranty="'{{ route('apply.oneyear.warranty') }}'"
			:extendedurl="'{{ route('apply.extended.warranty') }}'"
		></basic-warranty>
		
	</div>
</section>
@endsection