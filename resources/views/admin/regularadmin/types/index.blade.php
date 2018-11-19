@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Type <small>(Index)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.types.index') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Index
			</li>
		</ol>
		<br>
		<a href="{{ route('regular.types.create') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Types</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Type</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<types-table 
							:fetchurl="'{{ route('regular.types.fetch') }}'"
							:autofetch="true"
						></types-table>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
	</section>
</div>
@endsection