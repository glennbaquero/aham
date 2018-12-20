@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $discount->renderName() }} <small>(Update Discount)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.discounts') }}"><i class="fas fa-images"></i> Discount</a>
			</li>
			<li class="active">
				{{ $discount->renderName() }}
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $discount->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'discount ' . $discount->renderName() }}'"
		        :restoreurl="'{{ $discount->renderRestore() }}'"
		        :deleteurl="'{{ $discount->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.discount.update', $discount->id) }}" 
						data-ref="discount-details"
						action="#" method="GET">

						<discount-details ref="discount-details"
						:fetchurl="'{{ route('admin.discount.fetch', $discount->id) }}'"
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