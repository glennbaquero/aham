@extends('master')
@section('pageTitle', 'Checkout')

@section('content')


<section class="checkout container">
	<checkout
	:fetchurl="'{{ route('checkout.fetch', $invoice_item->id) }}'"></checkout>
</section>
@endsection