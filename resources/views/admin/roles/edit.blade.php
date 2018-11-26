@extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $role->renderName() }} <small>(Update role information and details)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.roles') }}"><i class="fas fa-id-card-alt"></i> Roles</a>
			</li>
			<li class="active">
				{{ $role->renderName() }}
			</li>
		</ol>
</section>
<section class="content">
	<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $role->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'role ' . $role->renderName() }}'"
		        :restoreurl="'{{ $role->renderRestore() }}'"
		        :deleteurl="'{{ $role->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>

		<div class="row">

			<div class="col-xs-12">
				<!-- /.box-header -->
					

				<div class="box box-widget nav-tabs-custom table-responsive">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="#pages" data-toggle="tab"><h5><b>Role</b></h5></a>
	                    </li>
	                    <li>
	                        <a @click="runComponent('permissions-details')" href="#pages-permission" data-toggle="tab"><h5><b>Permissions</b></h5></a>
	                    </li>                                                   
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="pages">

	                    	<form @submit.prevent="formSubmit" 
							data-action="{{ route('admin.role.update', $role->id) }}" 
							data-ref="roles-details"
							action="#" method="GET">
	                        
			                    <roles-details ref="roles-details"
									:fetchurl="'{{ route('admin.role.fetch', $role->id) }}'">
								</roles-details>

								<div class="row">
									<div class="col col-xs-12">
										<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
									</div>
								</div>
							</form>

	                    </div>
	                    <div class="tab-pane" id="pages-permission">

	                    	<form @submit.prevent="formSubmit" 
							data-action="{{ route('admin.permissions.update', $role->id) }}" 
							data-ref="permissions-details"
							action="#" method="GET">
	                        
								<permission-list ref="permissions-details"
									:autofetch="false"
									:fetchurl="'{{ route('admin.permissions.fetch', $role->id) }}'"
								></permission-list>

								<div class="row">
									<div class="col col-xs-12">
										<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
									</div>
								</div>
							</form>

	                    </div>                  
	                </div>
        	    </div>
						
				<!-- /.box-body -->
			</div>
		</div>
	</section>
</div>
@endsection