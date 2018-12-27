@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Products <small>(Manage products)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.roles') }}"><i class="fas fa-boxes"></i> Products</a>
			</li>
		</ol>
		<br>
	
		@if ($checker->permission->can(['admin.product.create']))
			<a href="{{ route('admin.product.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
		@endif

		@if ($checker->permission->can(['admin.product.upload']))
			<a href="{{ route('admin.product.upload') }}" class="btn btn-primary"><i class="fas fa-file-upload"></i> Upload Product</a>
		@endif
		
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Products</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runDatatable('pages-product')" href="#pages-product" data-toggle="tab"><h5><b>Archive</b></h5></a>
	                    </li>  
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">
	                        
	                        <products-table ref="pages"
	                        	:actionable="'{{ $checker->permission->can(['admin.product.edit']) }}'"
								:autofetch="true"
								:filtertags="{{ $tags }}"
								:fetchurl="'{{ route('admin.products.fetch') }}'"
							></products-table>

	                    </div>
	                    <div class="tab-pane" id="pages-product">
	                        
							 <products-table ref="pages-product"
								:actionable="'{{ $checker->permission->can(['admin.product.edit']) }}'"
								:filtertags="{{ $tags }}"
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