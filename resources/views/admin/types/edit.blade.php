@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $type->renderName() }} <small>(Update product type information and details)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.types.index') }}"><i class="fas fa-th-large"></i> Product Types</a>
			</li>
			<li class="active">
				{{ $type->renderName() }}
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $type->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'type ' . $type->renderName() }}'"
		        :restoreurl="'{{ $type->renderRestore() }}'"
		        :deleteurl="'{{ $type->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.types.update', $type->id) }}" 
						data-ref="type-details"
						action="#" method="GET">

						<type-details ref="type-details"
						:fetchurl="'{{ route('admin.type.fetch', $type->id) }}'">
						</type-details>

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