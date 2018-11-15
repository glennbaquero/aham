@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Permission <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.permission') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Permission</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Permission</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>
@endsection