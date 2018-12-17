@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Applications</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href=""><i class="fas fa-user-shield"></i> Application</a>
			</li>
		</ol>
		<br>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#invoices" data-toggle="tab"><h5><b>Admins</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('invoices-admin')" href="#invoices-admin" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="invoices">
	                        
	                        <applications-table ref="invoices"
								:autofetch="true"
								:fetchurl="'{{ route('admin.applications.fetch') }}'"
							></applications-table>

	                    </div>
	                    <div class="tab-pane" id="invoices-admin">
	                        
							<applications-table ref="invoices-admin"
								:autofetch="false"
								:fetchurl="'{{ route('admin.applications.archive') }}'"
							></applications-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
	</section>
</div>
@endsection