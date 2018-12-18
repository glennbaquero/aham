@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>FAQ <small>(Make new a slider)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.faqs.index') }}"><i class="fas fa-images"></i> FAQ</a>
			</li>
			<li class="active">
				New FAQ
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.faqs.store') }}" 
						data-ref="faq-details"
						action="#" method="GET">

						<faq-details ref="faq-details"
						:fetchurl="'{{ route('admin.faqs.fetch') }}'">
						</faq-details>

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