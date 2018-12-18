@extends('master')
@section('pageTitle', 'My Products')
@section('content')


<section class="user-profile container">
	
	<div class="usr__sidebar">
		@include('includes.sidebar')
	</div

	><div class="usr__main">
		<user-products-table
		:fetchurl="'{{ route('user.products.fetch') }}'">
		</user-products-table>
	</div>
</section>

@endsection