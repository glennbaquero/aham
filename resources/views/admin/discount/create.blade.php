@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Discount</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.discounts') }}"><i class="fas fa-images"></i> Discount</a>
			</li>
			<li class="active">
				New Discount
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.discount.store') }}" 
						data-ref="discount-details"
						action="#" method="GET">

						<discount-details ref="discount-details"
						:fetchurl="'{{ route('admin.discount.fetch') }}'"
						:users="{{ $users }}"
						:categories="{{ $categories }}">
						</discount-details>

						<div class="row">
							<div class="col col-xs-12">
								<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
							</div>
						</div>
					</form>
				<!-- /.box-body -->
			</div>
		</div>
	</section>
</div>
@endsection