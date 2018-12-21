<header class="desktop-header header">
	<div class="header--top">
		<div class="inlineBlock-parent">
			<div class="header__contact inlineBlock-parent">
				<div class="header__cntct-details inlineBlock-parent middle-align color--white">
					<i class="icon fa fa-phone"></i>
					<p>374-4567</p>
				</div>
				<div class="header__cntct-details inlineBlock-parent middle-align color--white">
					<i class="icon fa fa-envelope"></i>
					<p>info@aham.org</p>
				</div>
			</div
			><form method="GET" action="{{ url('/products') }}" class="header__search right-align inlineBlock-parent">
				<div class="input-txt color--white">
					<input type="search" name="search" placeholder="Search products..">
					<i class="fa fa-search color--white"></i>
				</div>
				
				<a href="" class="search-btn">
					<button class="" type="submit">Extended Warranty</button>
				</a>
			</form>
		</div>
	</div>
	<div class="header--bottom inlineBlock-parent">
		<div class="header__logo-holder">
			<a href=""><img class="header__logo" src="{{asset('images/logo2.png') }}"></a>
		</div
		><div class="navigation__set inlineBlock-parent right-align">
			<div class="navigation__link">
				<a class="navigation__text" href="{{ route('home') }}">Home</a>
			</div>
			<div class="navigation__link">
				<a class="navigation__text" href="{{ url('products') }}">Products</a>
				<i class="dropdown-icon icon fa fa-angle-down" data-dropdown-id="dropdown-2"></i>
				<div id="dropdown-2" class="navigation__drop-down">
					<p class="tip"></p>
					<div class="navigation__link" id="1">
						<a href="#" class="navigation__text">
							Refrigerators
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="#" class="navigation__text">
							Kitchen
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="#" class="navigation__text">
							Aircons
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="#" class="navigation__text">
							Small Appliances
						</a>
					</div>	
				</div>
			</div>
			<div class="navigation__link inlineBlock-parent">
				<p data-dropdown-id="dropdown-1" class="dropdown-icon navigation__text">Warranties <i class="icon fa fa-angle-down"></i></p>
					
				<div id="dropdown-1" class="navigation__drop-down">
					<p class="tip"></p>
					<div class="navigation__link" id="1">
						<a href="{{ route('user.basic') }}" class="navigation__text">
							Basic Warranty
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="{{ route('user.extended') }}" class="navigation__text">
							Extended Warranty
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="{{ url('warranty_info') }}" class="navigation__text">
							Warranty Information
						</a>
					</div>	
				</div>
			</div>
			<div class="navigation__link">
				<a class="navigation__text" href="{{ url('about') }}">About</a>
			</div>
			<div class="navigation__link">
				<a class="navigation__text" href="{{ url('contact') }}">Contact</a>
			</div>
			<div class="header__user">
				@if(!Auth::check())
					<a href="{{ route('signup') }}" class="navigation__text"><i class="icon fa fa-user"></i>Sign Up</a>
				@else
					<p  data-dropdown-id="dropdown-3" class="dropdown-icon navigation__text">
						<i class="icon fa fa-user"></i>
						{{ Auth::user()->firstname. ' '. Auth::user()->lastname}}
					</p>
					{{-- Dropdown --}}
					<div id="dropdown-3" class="navigation__drop-down">
					<p class="tip"></p>
					<div class="navigation__link" id="1">
						<a href="{{ route('user.profile') }}" class="navigation__text">
							<div class="usr__logo-holder">
								<i class="icon ion-person"></i>
							</div
							><div class="usr__text">
								<p>My Profile</p>
							</div>
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="{{route('user.products')}}" class="navigation__text">
							<div class="usr__logo-holder">
								<i class="icon ion-ios-barcode"></i>
							</div
							><div class="usr__text">
								<p>My Products</p>
							</div>
						</a>
					</div>	
					<div class="navigation__link" id="1">
						<a href="{{ route('user.logout') }}" class="navigation__text">
							<div class="usr__logo-holder">
								<i class="icon ion-log-out"></i>
							</div
							><div class="usr__text">
								<p>Logout</p>
							</div>
						</a>
					</div>	
				</div>
				@endif
			</div>
		</div>
	</div>
</header>

<header class="mbl-header header">
	<div class="header--bottom inlineBlock-parent">
		<div class="header__logo-holder">
			<a href=""><img class="img-fit" src="{{asset('images/logo2.png') }}"></a>
		</div>
		<div class="header__logo-holder2">
			<img class="img-fit" src="{{asset('images/logo-white.png') }}">
		</div>
		<div class="mbl-menu__btn">
			<i class="mbl-menu__search ion-android-search"></i>
		</div>
		<div class="mbl-menu__btn">
			<i name="close" class="mbl-menu ion-android-menu" role="img" aria-label="close"></i>
		</div>
	</div>

	<div class="mbl-menu__link-holder">
		<div class="mbl-menu__btn">
			<i name="close" class="mbl-menu-close ion-android-close" role="img" aria-label="close"></i>
		</div>
		<div class="mbl-menu__user inlineBlock-parent">
			<div class="mbl-menu__user-icon">
				<img class="img-fit" src="https://via.placeholder.com/50x50">
			</div>
			<p class="mbl-menu__username">John Doe</p>
		</div>
		<div class="mbl-menu__links">
			<a href="{{ route('home') }}"><p class="mbl-menu__text">Home</p></a>
		</div>
		<div class="mbl-menu__accordion-list">
			<div class="mbl-menu__accordion">
				<p class="mbl-menu__acc-menu"><a href="{{ url('products') }}">Products</a><i class="fa fa-angle-right"></i></p>
				<div class="mbl-menu__acc-item">
					<p>Refrigerator</p>
					<p>Washing Machine</p>
				</div>
			</div>
			<div class="mbl-menu__accordion">
				<p class="mbl-menu__acc-menu">Warranties<i class="fa fa-angle-right"></i></p>
				<div class="mbl-menu__acc-item">
					<p>Basic Warranty</p>
					<p>Extended Warranty</p>
					<p>Warranty Information</p>
				</div>
			</div>				
		</div>
		<div class="mbl-menu__links">
			<a href="{{ url('about') }}"><p class="mbl-menu__text">About</p></a>
		</div>
		<div class="mbl-menu__links">
			<a href="{{ url('contact') }}"><p class="mbl-menu__text">Contact</p></a>
		</div>
		<div class="mbl-menu__contact-details">
			<div class="mbl-menu__contact inlineBlock-parent">
				<i class="fa fa-phone"></i><p>374-4567</p>
			</div>
			<div class="mbl-menu__contact inlineBlock-parent">
				<i class="fa fa-envelope"></i><p>info@aham.org</p>
			</div>
		</div>
		<div class="mbl-menu__btn">
			<a href="{{ url('extended') }}" class="btn btn-white"><p>Extended Warranty</p></a>
		</div>
	</div>	
</header>