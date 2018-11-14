@extends('admin-master')
@section('content')
<div class="content-wrapper">
<section class="content-header">
	<h1>Administrator <small>(Index)</small></h1>
	<ol class="breadcrumb">
		<li>
			<a href="{{ route('admin.admin') }}"><i class="fas fa-user-shield"></i> Administrator</a>
		</li>
		<li class="active">
			Index
		</li>
	</ol>
	<br>
	<a href="" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Admin</a>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Administrators</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover">
            <thead>
	            <tr>
					<th>Avatar</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status</th>
					<th>Verification</th>
					<th>Action</th>
	            </tr>
            </thead>
            <tbody>
	            <tr>
		            <td><img src="{{asset('storage/admin.png')}}" class="img-circle" width="75" height="75"></td>
					<td>Super Admin</td>
					<td>superadmin@praxxys.ph</td>
					<td>
		              	<label class="btn btn-default btn-xs">
		              		<small>
		              			<b>SUPER ADMIN</b>
		              		</small>
		              	</label>
		          	</td>
		            <td>
						<label class="btn btn-success btn-xs">
		              		<small>
		              			<b>ENABLED</b>
		              		</small>
		              	</label>
		            </td>
		           	<td>
		           		<label class="btn btn-primary btn-xs">
		              		<small>
		              			<b>VERIFIED</b>
		              		</small>
		              	</label>
		           	</td>
				  	<td>
				  		<label class="btn btn-info btn-xs">
		              		<span class="fa fa-eye"></span>
		              	</label>
				  	</td>
	            </tr>
            </tbody>
            <tfoot>
            <tr>
              <th>Avatar</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Verification</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
  </div>
@endsection