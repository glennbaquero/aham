@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Type <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.types.index') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('regular.types.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Types</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Slider</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-type')" href="#pages-type" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <types-table ref="pages"
								:fetchurl="'{{ route('regular.types.fetch') }}'"
								:autofetch="true"
							></types-table>

	                    </div>
	                    <div class="tab-pane" id="pages-type">
	                        
							<types-table ref="pages-type"
								:autofetch="false"
								:fetchurl="'{{ route('regular.types.archive') }}'"
							></types-table>

	                    </div>                  
	                </div>
        	    </div>

			</div>
		</div>
	</section>
</div>
@endsection