@extends('master')
@section('pageTitle', 'User Profile')
@section('content')

<section class="user-profile container">
	<div class="usr__sidebar">
		@include('includes.sidebar')
	</div

	><div class="usr__main">
		<div class="usr__container">
			<user-profile
					:fetchurl = "'{{ route('user.fetch.details') }}'"
					:updateurl = "'{{ route('user.update', auth()->user()->id) }}'"
					:updatepasswordurl = "' {{ route('user.update.password', auth()->user()->id) }} '"
			></user-profile>
			
		</div>
	</div>
</section>

@endsection