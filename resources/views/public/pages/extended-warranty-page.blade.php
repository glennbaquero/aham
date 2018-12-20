@extends('master')
@section('pageTitle', 'Extended Warranty')

@section('content')


<section class="extendedwarranty container">
	<extended-warranty
	:fetchurl="'{{ route('fetch.product') }}'"
	:extendedurl="'{{ route('apply.extended.warranty') }}'">
	</extended-warranty>
</section>

@endsection