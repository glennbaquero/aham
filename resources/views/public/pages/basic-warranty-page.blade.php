@extends('master')
@section('pageTitle', 'Basic Warranty')

@section('content')


<section class="basicwarranty container">
	<div class="bw__container animate-up">
		<p class="bw__title">Register your new product</p>
		<form class="bw__form">
			<div class="bw__form-row">
				<label>Model Number</label>
				<select class="input-text select">
					<option>AWFL-8300B</option>
					<option class="inlineBlock-parent by-2">
						<div class="left-align">
							<img src="http://via.placeholder.com/30x30">
						</div
						><div class="right-align">
							<p>AWFL-8300B</p>
						</div>
					</option>
				</select>
			</div>
			<div class="bw__form-row">
				<label>Serial Number</label>
				<input class="input-text" type="text" name="">
				<i class="info fa fa-question-circle"></i>
			</div>
			<div class="bw__form-row">
				<label>Purchased Date</label>
				<input class="input-text" type="date" name="">
			</div>
			<div class="bw__form-row">
				<label>Proof of Purchased</label>
				<input type="file" name="">
			</div>
			<label class="span">*Please upload scanned copy of the bill or invoice</label>
			<button type="submit" class="btn btn-blue">
				<span>I want</span>
				<p>1 Year Free Warranty</p>
			</button
			><button type="submit" class="margin btn btn-gray">
				<span>I want</span>
				<p>Extended Warranty</p>
			</button>
			<a href="">Cancel</a>
		</form>

	</div>
</section>
@endsection