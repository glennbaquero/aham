@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Product Type <small>(Make a new product type)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.types.index') }}"><i class="fas fa-th-large"></i> Product Types</a>
			</li>
			<li class="active">
				New Product Type
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.types.store') }}" 
						data-ref="type-details"
						action="#" method="GET">

						<type-details ref="type-details"
						:fetchurl="'{{ route('admin.types.fetch') }}'">
						</type-details>

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