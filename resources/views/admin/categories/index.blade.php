@extends('admin-master')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Category <small>(Manage categories)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.categories.index') }}"><i class="fas fa-archive"></i> Categories</a>
			</li>
		</ol>
		<br>
		@if ($checker->permission->can(['admin.categories.create']))
			<a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
			{{-- <a href="{{ route('admin.category.upload') }}" class="btn btn-primary"><i class="fas fa-file-upload"></i> Upload Categories</a> --}}
		@endif

	</section>
	<section class="content">
		<div class="row">

			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Categories</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-category')" href="#pages-category" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
							<categories-table ref="pages"
							:autofetch="true"
							:fetchurl="'{{ route('admin.categories.fetch') }}'"
							></categories-table>

	                    </div>
	                    <div class="tab-pane" id="pages-category">

	                    	<categories-table ref="pages-category"
							:autofetch="false"
							:fetchurl="'{{ route('admin.categories.archive') }}'"
							></categories-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection