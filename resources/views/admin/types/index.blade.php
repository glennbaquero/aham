@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Product Types <small>(Manage product types)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.types.index') }}"><i class="fas fa-th-large"></i> Product Types</a>
			</li>
		</ol>
		<br>
		@if ($checker->permission->can(['admin.types.create']))
			<a href="{{ route('admin.types.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Type</a>
			<a href="{{ route('admin.type.upload') }}" class="btn btn-primary"><i class="fas fa-file-upload"></i> Upload Types</a>
		@endif
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Product Types</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-type')" href="#pages-type" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <types-table ref="pages"
								:fetchurl="'{{ route('admin.types.fetch') }}'"
								:autofetch="true"
							></types-table>

	                    </div>
	                    <div class="tab-pane" id="pages-type">
	                        
							<types-table ref="pages-type"
								:autofetch="false"
								:fetchurl="'{{ route('admin.types.archive') }}'"
							></types-table>

	                    </div>                  
	                </div>
        	    </div>

			</div>
		</div>
	</section>
</div>
@endsection