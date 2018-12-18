@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Contact Information</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.contacts.index') }}"><i class="fas fa-images"></i> Contact Information</a>
			</li>
			<li class="active">
				New Contact Information
			</li>
		</ol>
</section>
<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.contacts.store') }}" 
						data-ref="contact-details"
						action="#" method="GET">

						<contact-us-details ref="contact-details"
						:fetchurl="'{{ route('admin.contacts.fetch') }}'">
						</contact-us-details>

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