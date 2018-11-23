@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Service Request <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('repair.request') }}"><i class="fas fa-user-shield"></i> Service Request</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('repair.request.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Request</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Service Request</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-request')" href="#pages-request" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <repair-request-table ref="pages"
								:fetchurl="'{{ route('repair.requests.fetch') }}'"
								:autofetch="true"
							></repair-request-table>

	                    </div>
	                    <div class="tab-pane" id="pages-request">
	                        
							<repair-request-table ref="pages-request"
								:autofetch="false"
								:fetchurl="'{{ route('repair.requests.archive') }}'"
							></repair-request-table>

	                    </div>                  
	                </div>
        	    </div>

			</div>
		</div>
	</section>
</div>
@endsection