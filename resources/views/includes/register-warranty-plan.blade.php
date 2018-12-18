<section class="register container">
	<div class="reg__banner full frame__background size--cover bring--back" style="background-image: url('{{asset('images/bg3.jpg') }}');"></div>
	<div class="frame-padding">
		<div class="vertical-parent">
			<div class="vertical-align">
				<div class="rw__container center-align animate-up">
					<p class="rw__title">Not yet registered to a warranty plan?</p>
					<form class="rw__form">
						<div class="rw__form-row">
							<select class="select">
								@foreach($products as $product)
									<option value="{{ $product->id }}"> {{ $product->model }} </option>
								@endforeach
							</select><div class="info"><img src="{{asset('images/info.png') }}"></div>
						</div>
						
						<div class="rw__form-row">
							<div class="button">
								<a class="btn btn-white" href=""><p>Basic Warranty</p></a
								><a class="btn outline--white" href=""><p>Extended Warranty</p></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>