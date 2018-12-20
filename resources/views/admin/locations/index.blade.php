@extends('admin-master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Locations
            <small>Manage Locations</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('admin.locations.index') }}"><i class="fas fa-file-alt"></i> Locations</a></li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row mb-4">
            <div class="col-md-12">
                <a href="{{ route('admin.locations.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus mr-1"></i> Add Location
                </a>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-widget nav-tabs-custom table-responsive">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#locations" data-toggle="tab"><h5><b>Locations</b></h5></a>
                        </li>
                        <li>
                            <a @click="runDatatable('locations-archive')" href="#locations-archive" data-toggle="tab"><h5><b>Archive</b></h5></a>
                        </li>                                                   
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="locations">
                            
                            <location-table ref="locations"
                            :autofetch="true"
                            :fetchurl="'{{ route('admin.locations.fetch') }}'"
                            ></location-table>

                        </div>
                        <div class="tab-pane" id="locations-archive">
                            
                            <location-table ref="locations-archive"
                            :autofetch="false"
                            :fetchurl="'{{ route('admin.locations.fetch.archive') }}'"
                            ></location-table>

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