@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Add Category <small>(Make a new product category)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.categories.index') }}"><i class="fas fa-archive"></i> Categories</a>
			</li>
			<li class="active">
				Add
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<std-alert></std-alert>

				<form @submit.prevent="formSubmit" 
					data-action="{{ route('admin.categories.store') }}" 
					data-ref="category-details"
					action="#" method="GET">

					<category-details ref="category-details"
					:fetchurl="'{{ route('admin.categories.fetch') }}'">
					</category-details>

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
@endsection