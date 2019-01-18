@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Employee <small>(Make a new employee)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.employee.index') }}"><i class="fas fa-user-shield"></i> Employee</a>
			</li>
			<li class="active">
				New Employee
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.employee.store') }}" 
						data-ref="employee-details"
						action="#" method="GET">

						<employee-details ref="employee-details"
							:fetchurl="'{{ route('admin.employee.fetch') }}'">
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