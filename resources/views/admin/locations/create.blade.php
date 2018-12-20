@extends('admin-master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
<section class="content-header">
	<h1>Create Location <small>Make a new location</small></h1>
	<ol class="breadcrumb">
        <li class=""><a href="{{ route('admin.locations.index') }}"><i class="fas fa-file-alt"></i> Locations</a></li>
        <li class="active"><a href="#">Create</a></li>
    </ol>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			{{-- <std-alert></std-alert> --}}
			
			<form @submit.prevent="formSubmit" 
			data-action="{{ route('admin.locations.store') }}" 
			data-ref="location-details"
			action="#" method="GET">

				<location-details ref="location-details" 
				:fetchpositionurl="'{{ route('admin.locations.fetch-positions') }}'"
				:fetchurl="'{{ route('admin.location.fetch') }}'">
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
