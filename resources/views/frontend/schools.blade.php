@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">ALL Schools</h1>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail">
   <div class="row">
      <div class="col-md-12">
         <div class="rating-Episodes-view">
            <ul class="nav nav-tabs">
               <li>
                  <a data-toggle="tab" href="#episodes" class="active show">
                  <i class="fa fa-graduation-cap"></i> Schools
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <div id="episodes" class="tab-pane fade active show mb-4">
                  <div class="row mb-4"><button class="btn btn-success">Add School</button></div><!-- /.row -->
                  <table id="school-Datatable" class="display table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>School Name</th>
                            <th>Package Name</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php if (count($schoolNative) > 0): ?>
                        <?php foreach ($schoolNative as $key => $school): ?>
                          <tr>
                              <td>{{ $school->created_at }}</td>
                              <td></td>
                              <td>{{ $school->name }}</td>
                              <td>Gold Package</td>
                              <td>{{ $school->status }}</td>
                              <td><a href="schools/{{ $school->schools->id }}/view"><button class="btn btn-default"> View Details</button></a></td>
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