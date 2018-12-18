@extends('master')
@section('pageTitle', 'My Products')
@section('content')


<section class="user-profile container">
	
	<div class="usr__sidebar">
		@include('includes.sidebar')
	</div

	><div class="usr__main">
		<div class="usr__search inlineBlock-parent">
				<i class="fa fa-search"></i>
				<input class="input-text" placeholder="Search Model No." type="text" name="">
			</div>
			
			<table>
				<tr>
					<th>Appliance</th>
					<th>Model No.</th>
					<th>Serial No.</th>
					<th>Purchase Date</th>
					<th>Registered Date</th>
					<th>Contract No.</th>
					<th>Registered Warranty</th>
					<th>Apply</th>
				</tr>
				<tr>
					<td>
						<div class="tbl__img-holder">
							<img src="https://via.placeholder.com/20x20">
						</div>
						<p>Washing Machine</p>
					</td>
					<td>
						<p>AWFL-8300B</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<a href="">Apply for Extended Warranty</a>
					</td>
				</tr>
				<tr>
					<td>
						<div class="tbl__img-holder">
							<img src="https://via.placeholder.com/20x20">
						</div>
						<p>Washing Machine</p>
					</td>
					<td>
						<p>AWFL-8300B</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<p>jkjkj</p>
					</td>
					<td>
						<div class="tbl__img-holder">
							<img src="{{ asset('images/logo3.png')}}">
						</div>
						<img src="{{ asset('images/green_check.png')}}">
					</td>
				</tr>

			</table>
	</div>
</section>

@endsection