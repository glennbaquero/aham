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
				Edit
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $request->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'request ' . $request->renderName() }}'"
		        :restoreurl="'{{ $request->renderRestore() }}'"
		        :deleteurl="'{{ $request->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.request.update', $request->id) }}" 
						data-ref="repair-request-details"
						action="#" method="GET">

						<repair-request-details ref="repair-request-details"
						:fetchurl="'{{ route('admin.request.fetch', $request->id) }}'"
						:hide="false">
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