@extends('admin-master')

@section('content')
<!-- Content Header (User header) -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $user->renderName() }} <small>Update user information and details</small></h1>
		<ol class="breadcrumb">
	        <li class=""><a href="{{ route('admin.users.index') }}"><i class="fas fa-file"></i> Users</a></li>
	        <li class="active"><a href="#">{{ $user->renderName() }}</a></li>
	    </ol>
	</section>

	<section class="content">

		<std-alert></std-alert>

		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $user->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'user ' . $user->renderName() }}'"
		        :restoreurl="'{{ $user->renderRestore() }}'"
		        :deleteurl="'{{ $user->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>

		<div class="row">
	        <div class="col-xs-12">

				<user-details ref="user-details" 
				:disabled="true"
				:fetchurl="'{{ route('admin.user.fetch', $user->id) }}'">
				</user-details>

	        </div>
	        <!-- /.col -->
		</div>

	</section>
</div>

@stop
