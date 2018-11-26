 @extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>Admin</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.administrator') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Add
			</li>
		</ol>
</section>
<section class="content">
	<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $admin->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'admin ' . $admin->renderName() }}'"
		        :restoreurl="'{{ $admin->renderRestore() }}'"
		        :deleteurl="'{{ $admin->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>

		<div class="row">

			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.administrator.update', $admin->id) }}" 
						data-ref="admins-details"
						action="#" method="GET">
  
	                    <admin-details ref="admins-details"
							:fetchurl="'{{ route('admin.administrator.fetch', $admin->id) }}'"
							:disable=true>
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