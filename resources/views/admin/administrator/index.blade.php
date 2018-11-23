@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Administrator <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('admin.administrator.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Admin</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Admins</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-admin')" href="#pages-admin" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <admins-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.administrators.fetch') }}'"
							></admins-table>

	                    </div>
	                    <div class="tab-pane" id="pages-admin">
	                        
							<admins-table ref="pages-admin"
								:autofetch="false"
								:fetchurl="'{{ route('admin.administrators.archive') }}'"
							></admins-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection