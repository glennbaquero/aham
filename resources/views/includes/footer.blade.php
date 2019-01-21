<footer class="footer">
	<div class="footer--top">
		<div class="footer__col--1">
			<div class="footer__logo-holder">
				<a href=""><img class="img-fit" src="{{ $footerLogo->aham_logo }}"></a>
			</div>
			<div class="inlineBlock-parent top-align address">
				<i class="fa fa-map-marker-alt"></i
					><p>34, Aham Bldg, Morato Ave., San Francisco del Monte, Quezon City, Metro Manila</p>
			</div>
		</div
		><div class="footer__col--2">
			<p class="menu-title">Contact Us</p>
			<div class="contact-col">
				<p class="menu-title">Service</p>
				@foreach($contacts->where('type', 1) as  $contact)
					<p class="menu-item">{{ $contact->contact }}</p>
				@endforeach
			</div
			><div class="contact-col">
				<p class="menu-title">Sales</p>
				@foreach($contacts->where('type', 0) as  $contact)
					<p class="menu-item">{{ $contact->contact }}</p>
				@endforeach
			</div>
		</div
		><div class="footer__col--3">
			<p class="menu-title">About AHAM</p>
			<a class="menu-item" href="{{ route('home') }}"><p>Home</p></a>
			<a class="menu-item" href="{{ url('products') }}"><p>Products</p></a>
			<a class="menu-item" href="{{ url('warranty_info') }}"><p>Warranties</p></a>
			<a class="menu-item" href="{{ url('about') }}"><p>About Us</p></a>
			<a class="menu-item" href="{{ url('contact') }}"><p>Contact Us</p></a>
		</div
		><div class="footer__col--4">
			<p class="menu-title">Customer Information</p>
			<a class="menu-item" href="{{ url('warranty_info') }}"><p>Warranty Information</p></a>
			<a class="menu-item" href="{{ url('contact') }}"><p>Service Centre</p></a>
			<a class="menu-item" href="{{ url('warranty_info') }}"><p>Terms & Conditions</p></a>
			<a class="menu-item" href="{{ url('warranty_info') }}"><p>Privacy Policy</p></a>
		</div>
	</div>
	<div class="footer--bottom">
		<p>© 2018 AHAM Corp. All rights reserved.</p>
	</div>
</footer>

<footer class="mbl-footer">
	<div class="footer--top">
		<div class="footer__logo-holder">
			<a href=""><img class="img-fit" src="{{ $footerLogo->aham_logo }}"></a>
		</div>
		<div class="inlineBlock-parent top-align address">
			<i class="fa fa-map-marker-alt"></i
			><p>34, Aham Bldg, Morato Ave., San Francisco del Monte, Quezon City, Metro Manila</p>
		</div>
		<div class="mbl-footer__accordion-list">
			<div class="mbl-footer__accordion">
				<p class="mbl-footer__acc-menu">Contact US</p>
			</div>
			<div class="mbl-footer__accordion">
				<p class="mbl-footer__acc-menu">About AHAM<i class="fa fa-sort-down"></i></p>
				<div class="mbl-footer__acc-item">
					<p>Home</p>
					<p>Products</p>
				</div>
			</div>
			<div class="mbl-footer__accordion">
				<p class="mbl-footer__acc-menu">Customer Information<i class="fa fa-sort-down"></i></p>
				<div class="mbl-footer__acc-item">
					<p>Refrigerator</p>
					<p>Washing Machine</p>
				</div>
			</div>			
		</div>
	</div>
	
	<div class="footer--bottom">
		<p>© 2018 AHAM Corp. All rights reserved.</p>
	</div>
</footer>