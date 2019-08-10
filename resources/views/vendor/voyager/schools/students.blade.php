<?php use App\User; ?>
@extends('voyager::master')

@section('page_title', __('Students'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-person"></i> Students
        </h1>
        <a href="{{ lang_url('admin/schools') }}" class="btn btn-dark btn-add-new">
            <i class="voyager-angle-left"></i> <span>Back to Schools</span>
        </a>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Price</th>
                                        <th>Package Start Date</th>
                                        <th>Package End Date</th>
                                        <th>Status</th>
                                        <th>Performance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($getStudents): ?>
                                        <?php foreach ($getStudents as $key => $student): ?>
                                            <tr>
                                                <?php
                                                    $user_id = (int)$student->user_id;
                                                    $studentTable = User::find($user_id);
                                                ?>
                                                <td>{{ $studentTable->name }}</td>
                                                <td>{{ $student->package_name }}</td>
                                                <td>{{ $student->package_price }}</td>
                                                <td>{{ $student->package_start_date }}</td>
                                                <td>{{ $student->package_end_date }}</td>
                                                <td>{{ $student->status }}</td>
                                                <td class="text-center">
                                                    <a style="margin-right: 5px;" href="{{ lang_url('admin/schools/'.$school_id.'/student/overall/'.$student->user_id) }}" title="View" class="btn btn-sm btn-success view">
                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View details</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
    <!-- DataTables -->
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable();
        });
           
    </script>
@stop
