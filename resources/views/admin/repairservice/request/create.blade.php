@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Service Request</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.request') }}"><i class="fas fa-user-shield"></i> Service Request</a>
			</li>
			<li class="active">
				Add
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.request.store') }}" 
						data-ref="repair-request-details"
						action="#" method="GET">

						<repair-request-details ref="repair-request-details"
						:fetchurl="'{{ route('admin.request.fetch') }}'"
						:fetchinvoiceurl="'{{ route('admin.request.invoice') }}'"
						:hide="true">
						</repair-request-details>

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