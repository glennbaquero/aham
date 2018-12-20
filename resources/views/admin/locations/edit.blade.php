@extends('admin-master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
<section class="content-header">
	<h1>{{ $location->renderName() }} <small>Update location information and details</small></h1>
	<ol class="breadcrumb">
        <li class=""><a href="{{ route('admin.locations.index') }}"><i class="fas fa-file-alt"></i> Locations</a></li>
        <li class="active"><a href="#">{{ $location->renderName() }}</a></li>
    </ol>
</section>

<section class="content">

	<std-alert></std-alert>

	<div class="row mb-4">
		<div class="col-md-12">
			
			<std-button
			:size="'btn-sm pull-right'"
			:label="'Delete'"
	        :action="'{{ $location->trashed() ? 'restore' : 'delete' }}'"
	        :message="'{{ 'location ' . $location->renderName() }}'"
	        :restoreurl="'{{ $location->renderRestore() }}'"
	        :deleteurl="'{{ $location->renderDelete() }}'"
	        ></std-button>

		</div>
	</div>

	<div class="row">
		<div class="col-md-12">

			<form @submit.prevent="formSubmit" 
			data-action="{{ route('admin.locations.update', $location->id) }}" 
			data-ref="location-details"
			action="#" method="GET">

				<location-details ref="location-details" 
				:fetchpositionurl="'{{ route('admin.locations.fetch-positions') }}'"
				:fetchurl="'{{ route('admin.location.fetch', $location->id) }}'">
				</location-details>

				<div class="row">
					<div class="col col-xs-12">
						<button type="submit" class="btn btn-primary pull-right">Save Changes</button>
					</div>
				</div>
			</form>

		</div>
	</div>

</section>
</div>

@stop
