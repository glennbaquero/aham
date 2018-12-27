@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Contact Information</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.contacts.index') }}"><i class="fas fa-images"></i> Contact Us</a>
			</li>
		</ol>
		<br>
	    @if ($checker->permission->can(['admin.contacts.create']))
			<a href="{{ route('admin.contacts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Contact</a>
		@endif
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Contact</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-contacts')" href="#pages-contacts" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <contact-us-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.contacts.fetch') }}'"
							></contact-us-table>

	                    </div>
	                    <div class="tab-pane" id="pages-contacts">
	                        
							<contact-us-table ref="pages-contacts"
								:autofetch="false"
								:fetchurl="'{{ route('admin.contacts.archive') }}'"
							></contact-us-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection