@extends('master')
@section('pageTitle', 'Checkout')

@section('content')


<section class="checkout container">
	<checkout
	:fetchurl="'{{ route('checkout.fetch', $invoice_item->id) }}'"
	:checkouturl="'{{ route('checkout.process') }}'">
	</checkout>
</section>
@endsection