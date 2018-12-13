@extends('master')
@section('pageTitle', 'User Profile')
@section('content')

<section class="user-profile container">
	<div class="usr__sidebar">
		@include('includes.sidebar')
	</div

	><div class="usr__main">
		<div class="usr__container">
			<div class="inlineBlock-parent">
				<p class="usr__title">Account Information</p>	
				<div class="icon"><i class="fa fa-pen"></i></div>
			</div>
			
			<form class="usr__form">
				<div class="usr__form-row">
					<label>Email</label>
					<input class="input-text" type="email" placeholder="email@gmail.com" name="">
				</div
				><div class="usr__form-row">
					<label>Contact</label>
					<input class="input-text" type="text" placeholder="09090909090" name="">
				</div
				><div class="usr__form-row">
					<label>Firstname</label>
					<input class="input-text" type="text" placeholder="Firstname" name="">
				</div
				><div class="usr__form-row">
					<label>Birthdate</label>
					<input class="input-text" type="date" placeholder="" name="">
				</div
				><div class="usr__form-row">
					<label>Lastname</label>
					<input class="input-text" type="text" placeholder="Lastname" name="">
				</div>
				<div class="usr__line"></div>
				<div class="password">
					<div class="usr__form-row">
						<label>Old Password</label>
						<input class="input-text" type="password" name="">
					</div>
					<div class="usr__form-row">
						<label>New Password</label>
						<input class="input-text" type="password" name="">
					</div>
					<div class="usr__form-row">
						<label>Repeat Password</label>
						<input class="input-text" type="password" name="">
					</div
					><div class="usr__form-row right-align">
						<button class="btn btn-blue">
							<p>Change Password</p>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@endsection