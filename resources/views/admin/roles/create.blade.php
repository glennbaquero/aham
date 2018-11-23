@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Role <small>(Make a new role)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles</a>
			</li>
			<li class="active">
				New Role
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.roles.store') }}" 
						data-ref="roles-details"
						action="#" method="GET">

						<roles-details ref="roles-details"
						:fetchurl="'{{ route('admin.role.fetch') }}'">
						</roles-details>

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