@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Administrator <small>(Make a new admin)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrators</a>
			</li>
			<li class="active">
				New Admin
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.administrator.store') }}" 
						data-ref="administrator-details"
						action="#" method="GET">

						<admin-details ref="administrator-details"
							:fetchurl="'{{ route('admin.administrator.fetch') }}'">
						</admin-details>

						<div class="row">
							<div class="col col-xs-12">
								<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
							</div>
						</div>
					</form>
				<!-- /.box-body -->
			</div>
		</div>
	</section>
</div>
@endsection