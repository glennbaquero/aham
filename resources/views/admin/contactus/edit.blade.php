@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $contact->renderName() }} <small>(Update Contact Information)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.contacts.index') }}"><i class="fas fa-images"></i> Contact Info</a>
			</li>
			<li class="active">
				{{ $contact->renderName() }}
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $contact->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'contact ' . $contact->renderName() }}'"
		        :restoreurl="'{{ $contact->renderRestore() }}'"
		        :deleteurl="'{{ $contact->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.contacts.update', $contact->id) }}" 
						data-ref="contact-details"
						action="#" method="GET">
						
						<contact-us-details ref="contact-details"
						:fetchurl="'{{ route('admin.contact.fetch', $contact->id) }}'">
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