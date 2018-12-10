@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Upload Product Manifest</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.products.index') }}"><i class="fas fa-boxes"></i> Products</a>
			</li>
			<li class="active">
				Upload
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.categories.upload') }}" 
						data-ref="upload-categories"
						enctype="multipart/form-data"
						action="#" method="GET">

						<upload-categories ref="upload-categories"></upload-categories>

						<div class="row">
							<div class="col col-xs-12">
								<button type="submit" class="btn btn-primary pull-right">Upload</button>
							</div>
						</div>
					</form>
				<!-- /.box-body -->
			</div>
		</div>
	</section>
</div>
@endsection