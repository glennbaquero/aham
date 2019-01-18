@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Employee <small>(Manage employee)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.employee.index') }}"><i class="fas fa-user-shield"></i> Employee</a>
			</li>
		</ol>
		<br>
		@if ($checker->permission->can(['admin.administrator.create']))
			<a href="{{ route('admin.employee.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Employee</a>
		@endif
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Employees</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('page-employees')" href="#page-employees" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <employees-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.employees.fetch') }}'"
							></employees-table>

	                    </div>
	                    <div class="tab-pane" id="page-employees">
	                        
							<employees-table ref="page-employees"
								:autofetch="false"
								:fetchurl="'{{ route('admin.employees.archive') }}'"
							></employees-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection