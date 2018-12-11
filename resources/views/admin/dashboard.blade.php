@extends('admin-master')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard <small>(View dashboard informations)</small></h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
			</li>
		</ol>
	</section>
	<section class="content">
	  <div class="row">
	    <div class="col-xs-12">
		</div>
	  </div>
	</section>
</div>
@endsection