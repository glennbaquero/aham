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
		<a href="{{ route('regular.product.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Product</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Roles</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<products-table 
							:fetchurl="'{{ route('regular.products.fetch') }}'"
							:autofetch="true"
						></products-table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>
@endsection