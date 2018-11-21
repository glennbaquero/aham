@extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>Product</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.products.index') }}"><i class="fas fa-user-shield"></i> Product</a>
			</li>
			<li class="active">
				Add
			</li>
		</ol>
</section>
<section class="content">
	<div class="row mb-4">
		<div class="col-md-12">
			
			<std-button
			:size="'btn-sm pull-right'"
			:label="'Delete'"
	        :action="'{{ $product->trashed() ? 'restore' : 'delete' }}'"
	        :message="'{{ 'product ' . $product->renderName() }}'"
	        :restoreurl="'{{ $product->renderRestore() }}'"
	        :deleteurl="'{{ $product->renderDelete() }}'"
	        ></std-button>

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<!-- /.box-header -->
				<form @submit.prevent="formSubmit" 
					data-action="{{ route('regular.product.update', $product->id) }}" 
					data-ref="product-details"
					action="#" method="GET">

					<product-details ref="product-details"
					:fetchurl="'{{ route('regular.product.fetch', $product->id) }}'"
					:categories="{{ $categories }}"
					:types="{{ $types }}">
					</product-details>

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