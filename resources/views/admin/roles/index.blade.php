@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Roles <small>(Manage roles)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles</a>
			</li>
		</ol>
		<br>
		@if ($checker->permission->can(['admin.roles.create']))
			<a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Roles</a>
		@endif
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Roles</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-carousel')" href="#pages-carousel" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <roles-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.roles.fetch') }}'"
							></roles-table>

	                    </div>
	                    <div class="tab-pane" id="pages-carousel">
	                        
							<roles-table ref="pages-carousel"
								:autofetch="false"
								:fetchurl="'{{ route('admin.roles.archive') }}'"
							></roles-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection