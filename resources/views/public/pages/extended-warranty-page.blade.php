@extends('master')
@section('pageTitle', 'Extended Warranty')

@section('content')


<section class="extendedwarranty container">
		<ul id="breadcrumb" class="bc-border">
        <li><a href="/"><i class="icon ion-ios-home"> </i></a></li>
        <li><a href="warranty_info"><span class="icon icon-beaker"> </span> Warranty</a></li>
        <li><a href="{{ route('user.extended') }}" class="active"><span class="icon icon-double-angle-right"></span> Extended Warranty</a></li>
    </ul>
	<extended-warranty
	:fetchurl="'{{ route('fetch.product') }}'"
	:extendedurl="'{{ route('apply.extended.warranty') }}'">
	</extended-warranty>
</section>

@endsection