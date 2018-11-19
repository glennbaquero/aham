@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Category <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.categories.index') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('regular.categories.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Categories</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Category</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<categories-table 
							:fetchurl="'{{ route('regular.categories.fetch') }}'"
							:autofetch="true"
						></categories-table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>
@endsection