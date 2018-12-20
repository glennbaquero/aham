@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Discount</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.discounts') }}"><i class="fas fa-images"></i> Discount</a>
			</li>
		</ol>
		<br>
		<a href="{{ route('admin.discount.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Discount</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Discount</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-discounts')" href="#pages-discounts" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <discounts-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.discounts.fetch') }}'"
							></discounts-table>

	                    </div>
	                    <div class="tab-pane" id="pages-discounts">
	                        
							<discounts-table ref="pages-discounts"
								:autofetch="false"
								:fetchurl="'{{ route('admin.discounts.archive') }}'"
							></discounts-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection