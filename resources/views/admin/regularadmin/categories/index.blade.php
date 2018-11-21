@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Category <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.categories.index') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('regular.categories.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Categories</a>
	</section>
	<section class="content">
		<div class="row">

			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Category</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-category')" href="#pages-category" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
							<categories-table ref="pages"
							:autofetch="true"
							:fetchurl="'{{ route('regular.categories.fetch') }}'"
							></categories-table>

	                    </div>
	                    <div class="tab-pane" id="pages-category">

	                    	<categories-table ref="pages-category"
							:autofetch="false"
							:fetchurl="'{{ route('regular.categories.archive') }}'"
							></categories-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection