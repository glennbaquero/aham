@extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $invoice->renderName() }} <small>(Update application information and details)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.application') }}"><i class="fas fa-boxes"></i> application</a>
			</li>
			<li class="active">
				{{ $invoice->renderName() }}
			</li>
		</ol>
</section>
<section class="content">
	<div class="row mb-4">
		<div class="col-md-12">

			@if ($checker->permission->can(['admin.application.destroy', 'admin.application.restore']))
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $invoice->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'invoice ' . $invoice->renderName() }}'"
		        :restoreurl="'{{ $invoice->renderRestore() }}'"
		        :deleteurl="'{{ $invoice->renderDelete() }}'"
		        ></std-button>
			
			@endif

		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<!-- /.box-header -->
				<form @submit.prevent="formSubmit" 
					data-action="{{ route('admin.application.update', $invoice->id) }}" 
					data-ref="application-details"
					action="#" method="GET">

					<application-details ref="application-details"
					:fetchurl="'{{ route('admin.application.fetch', $invoice->id) }}'">
					</application-details>
					
				  	@if ($checker->permission->can(['admin.application.approve']))
						@if($invoice->status === 0 || $invoice->status === 2)
							<div class="row">
								<div class="col col-xs-12">
									<button type="submit" class="btn btn-success pull-right"><span class="fa fa-times"></span>Approved</button>
								</div>
							</div>
						@endif
					@endif
				</form>
			<!-- /.box-body -->
			</div>
		</div>
	</section>
</div>
@endsection