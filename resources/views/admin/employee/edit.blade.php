 @extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $employee->renderName() }} <small>(Update employee information and details)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.employee.index') }}"><i class="fas fa-user-shield"></i> Employee</a>
			</li>
			<li class="active">
				{{ $employee->renderName() }}
			</li>
		</ol>
</section>
<section class="content">
	<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $employee->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'employee ' . $employee->renderName() }}'"
		        :restoreurl="'{{ $employee->renderRestore() }}'"
		        :deleteurl="'{{ $employee->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>

		<div class="row">

			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.employee.update', $employee->id) }}" 
						data-ref="employee-details"
						action="#" method="GET">
  
	                    <employee-details ref="employee-details"
							:fetchurl="'{{ route('admin.employee.fetch', $employee->id) }}'"
							:disable=true>
						</employee-details>

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