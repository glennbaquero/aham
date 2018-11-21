@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Slider <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('carousel.index') }}"><i class="fas fa-user-shield"></i> Slider</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('carousel.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Slider</a>
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
	                        <a @click="runDatatable('pages-carousel')" href="#pages-carousel" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <carousels-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('regular.carousels.fetch') }}'"
							></carousels-table>

	                    </div>
	                    <div class="tab-pane" id="pages-carousel">
	                        
							<carousels-table ref="pages-carousel"
								:autofetch="false"
								:fetchurl="'{{ route('regular.carousels.archive') }}'"
							></carousels-table>

	                    </div>                  
	                </div>
        	    </div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection