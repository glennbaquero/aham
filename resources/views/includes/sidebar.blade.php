<div class="usr__profile">
	<user-image
	:fetchurl = "'{{ route('user.fetch.details') }}'"
	></user-image>
</div>
<a href="{{ route('user.profile') }}">
	<div class="usr__link">
		<div class="usr__logo-holder">
			<i class="icon ion-person"></i>
		</div
		><div class="usr__text">
			<p>My Profile</p>
		</div>
	</div>
</a>
<a href="{{ route('user.products') }}">
	<div class="usr__link">
		<div class="usr__logo-holder">
			<i class="icon ion-ios-barcode"></i>
		</div
		><div class="usr__text">
			<p>My Products</p>
		</div>
	</div>
</a>
<a href="{{ route('user.logout') }}">
	<div class="usr__link">
		<div class="usr__logo-holder">
			<i class="icon ion-log-out"></i>
		</div
		><div class="usr__text">
			<p>Logout</p>
		</div>
	</div>
</a>