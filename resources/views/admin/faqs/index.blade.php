@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>FAQ</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.faqs.index') }}"><i class="fas fa-images"></i> FAQs</a>
			</li>
		</ol>
		<br>
		
	    @if ($checker->permission->can(['admin.faqs.create']))
			<a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add FAQ</a>
		@endif

	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>FAQ</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-discounts')" href="#pages-discounts" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <faqs-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.faqs.fetch') }}'"
							></faqs-table>

	                    </div>
	                    <div class="tab-pane" id="pages-faqs">
	                        
							<faqs-table ref="pages-faqs"
								:autofetch="false"
								:fetchurl="'{{ route('admin.faqs.archive') }}'"
							></faqs-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection