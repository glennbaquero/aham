@extends('admin-master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Activity Logs <small>(View activity logs of admin users)</small></h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="{{ route('admin.administrator') }}"><i class="fas fa-clipboard-list"></i> Activity Logs</a>
            </li>
        </ol>
        <br>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-widget table-responsive">
                            
                    <activity-logs-table ref="activity-logs"
                    :filterusers="{{ $admins }}"
                    :filterevents="{{ $events }}"
                    :filtermodels="{{ $models }}"
                    :autofetch="true"
                    :fetchurl="'{{ route('admin.activity-logs.fetch') }}'"
                    ></activity-logs-table>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection