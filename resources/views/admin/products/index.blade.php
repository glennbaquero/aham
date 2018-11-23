@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Products <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.roles') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Product</a>
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
	                        <a @click="runDatatable('pages-product')" href="#pages-product" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <products-table ref="pages"
								:autofetch="true"
								:fetchurl="'{{ route('admin.products.fetch') }}'"
							></products-table>

	                    </div>
	                    <div class="tab-pane" id="pages-product">
	                        
							 <products-table ref="pages-product"
								:autofetch="false"
								:fetchurl="'{{ route('admin.products.archive') }}'"
							></products-table>

	                    </div>                  
	                </div>
        	    </div>

			</div>
		</div>
	</section>
</div>
@endsection