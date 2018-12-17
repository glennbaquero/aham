@extends('admin-master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{ $faq->renderName() }} <small>(Update FAQ)</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ route('admin.faqs.index') }}"><i class="fas fa-images"></i> FAQs</a>
			</li>
			<li class="active">
				{{ $faq->renderName() }}
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row mb-4">
			<div class="col-md-12">
				
				<std-button
				:size="'btn-sm pull-right'"
				:label="'Delete'"
		        :action="'{{ $faq->trashed() ? 'restore' : 'delete' }}'"
		        :message="'{{ 'faq ' . $faq->renderName() }}'"
		        :restoreurl="'{{ $faq->renderRestore() }}'"
		        :deleteurl="'{{ $faq->renderDelete() }}'"
		        ></std-button>

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<!-- /.box-header -->
					<form @submit.prevent="formSubmit" 
						data-action="{{ route('admin.faqs.update', $faq->id) }}" 
						data-ref="faq-details"
						action="#" method="GET">

						<faq-details ref="faq-details"
						:fetchurl="'{{ route('admin.faq.fetch', $faq->id) }}'"
						>
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