<?php
    use App\User;
    use App\Course;
?>
@extends('voyager::master')

@section('page_title', __('Students Performance'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-person"></i> {{ $student->name }} Performance
        </h1>
        <a href="{{ lang_url('admin/schools/'.$school_id.'/students') }}" class="btn btn-dark">
            <i class="voyager-angle-left"></i> <span>Back</span>
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
                                        <th>Course</th>
                                        <th>Chapter</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($getResults): ?>
                                        <?php foreach ($getResults as $key => $result): ?>
                                        <?php
                                            $loggedUser = Auth::user();
                                            if ($loggedUser->role_id != '1') {
                                                $getchapter = DB::table('chapters')->where([['id', $result->object_id], ['user_id', $loggedUser->id]])->first();
                                            } else {
                                                $getchapter = DB::table('chapters')->where('id', $result->object_id)->first();
                                            }
                                        ?>
                                            <?php if ($getchapter): ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                $course = Course::find($getchapter->course_id);
                                                                echo $course->name;
                                                            ?>
                                                        </td>
                                                        <td>{{ $getchapter->name }}</td>
                                                        <td>{{ $result->status }}</td>
                                                    </tr>
                                            <?php endif ?>
                                            
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
