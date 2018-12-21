@extends('admin-master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Users
            <small>Manage Users</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('admin.users.index') }}"><i class="fas fa-file"></i> Users</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-widget nav-tabs-custom table-responsive">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#users" data-toggle="tab"><h5><b>Users</b></h5></a>
                        </li>
                        <li>
                            <a @click="runDatatable('users-archive')" href="#users-archive" data-toggle="tab"><h5><b>Archive</b></h5></a>
                        </li>                                                   
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="users">
                            
                            <user-table ref="users"
                            :actionable="'{{ $checker->permission->can(['admin.users.show']) }}'"
                            :autofetch="true"
                            :fetchurl="'{{ route('admin.users.fetch') }}'"
                            ></user-table>

                        </div>
                        <div class="tab-pane" id="users-archive">
                            
                            <user-table ref="users-archive"
                            :actionable="'{{ $checker->permission->can(['admin.users.show']) }}'"
                            :autofetch="false"
                            :fetchurl="'{{ route('admin.users.fetch.archive') }}'"
                            ></user-table>

                        </div>                  
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->    
    </section>
</div>
<!-- /.content -->
@stop