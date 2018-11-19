@extends('admin-master')
@section('content')
	<div class="content-wrapper">
	<section class="content-header">
		<h1>Type</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('regular.types.index') }}"><i class="fas fa-user-shield"></i> Administrator</a>
			</li>
			<li class="active">
				Add
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('regular.types.update', $type->id) }}" 
						data-ref="type-details"
						action="#" method="GET">

						<type-details ref="type-details"
						:fetchurl="'{{ route('regular.types.fetch', $type->id) }}'">
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