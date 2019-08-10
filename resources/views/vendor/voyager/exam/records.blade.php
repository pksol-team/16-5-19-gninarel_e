<?php use App\User; ?>
@extends('voyager::master')

@section('page_title', __('Students Record'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-person"></i> Student Records
        </h1>
        <a href="{{ lang_url('admin/exam') }}" class="btn btn-dark btn-add-new">
            <i class="voyager-angle-left"></i> <span>Back to exams</span>
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
                                        <th>Student Name</th>
                                        <th>Percentage</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($getRecords): ?>
                                        <?php foreach ($getRecords as $key => $record): ?>
                                            <tr>
                                                <?php
                                                    $user_id = (int)$record->user_id;
                                                    $recordTable = User::find($user_id);
                                                ?>
                                                <td>{{ $recordTable->name }}</td>
                                                <td>{{ $record->percentage }}%</td>
                                                <td>{{ $record->result }}</td>
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
