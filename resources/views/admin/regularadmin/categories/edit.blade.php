@extends('admin-master')
@section('content')
<div class="content-wrapper">
		<section class="content-header">
			<h1>Category</h1>
			<ol class="breadcrumb">
				<li>
					<a href="{{ route('regular.categories.index') }}"><i class="fas fa-user-shield"></i> Category</a>
				</li>
				<li class="active">
					Edit
				</li>
			</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $category->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'category ' . $category->renderName() }}'"
		        :restoreurl="'{{ $category->renderRestore() }}'"
		        :deleteurl="'{{ $category->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('regular.categories.update', $category->id) }}" 
						data-ref="category-details"
						action="#" method="GET">

						<category-details ref="category-details"
						:fetchurl="'{{ route('regular.category.fetch', $category->id) }}'">
						</category-details>

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