@extends('master')
@section('pageTitle', 'Extended Warranty')

@section('content')


<section class="extendedwarranty container">
	<div class="ew__container animate-up">

		<div class="ew__title">
			<div class="vertical-parent">
				<div class="vertical-align">
					<img class="img-logo" src="{{asset('images/logo3.png') }}">
					<p class="">Register for Extended Warranty</p>
				</div>
			</div>
		</div>
		<form class="ew__form">
			<div class="ew__form-row">
				<label>Model Number</label>
				<div class="input-text">
				    <select name="item">
				    	<option value=""></option>
				    </select>
				    <div class="selected">
			    		<i class="ion-arrow-down-b"></i>
			    		<div>Select your product</div>
			    	</div>
			    	<div class="select-dropdown">
			    		<div class="item-holder">
			    			<div class="items">
			    				<div class="img-holder">
			    					<img class="img-fit" src="//via.placeholder.com/40x40">
			    				</div
			    				><div class="dropdown-content">
			    					<div><b>ASD-72B</b></div>
			    				</div>
			    			</div>
			    			<div class="items">
			    				<div class="img-holder">
			    					<img class="img-fit" src="//via.placeholder.com/40x40">
			    				</div
			    				><div class="dropdown-content">
			    					<div><b>AWF-M8016</b></div>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
				</div>
			</div>
			<div class="ew__form-row">
				<label>Serial Number</label>
				<input class="input-text" type="text" name="">
				<i class="info fa fa-question-circle"></i>
			</div>
			<div class="ew__form-row">
				<label>Purchased Date</label>
				<input class="input-text" type="date" name="">
			</div>
			<div class="ew__form-row">
				<label>Proof of Purchased</label>
				<input type="file" name="">
			</div>
			<label class="span">*Please upload scanned copy of the bill or invoice</label>
			<button type="submit" class="btn btn-white">
				<p class="font--2">Register</p>
			</button
			><a class="btn outline--white" href=""><p class="font--2">Close</p></a>
		</form>

	</div>
</section>

@endsection