@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-12">
         <div class="our_logo text-center">
            <a href="{{ lang_url('') }}"><img src="/frontend/assets/img/logo_trans.png" alt="Logo" class="logo_black"></a>
            <h1 class="text-center"><span>All Tests</span></h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
      </div>
   </div>
</div>
<div class="podcast-detail all_questions_show row pt-3 pb-3">
   <div class="col-12">
    <table id="school-Datatable" class="display table-bordered" width="100%">
      <thead>
          <tr>
            <th>Sr #</th>
            <th>Test Name</th>
            <th>Minimum Percentage</th>
            <th>My Percentage</th>
            <th>Result</th>
          </tr>
      </thead>
      <tbody>
       <?php if (count($allTests) > 0): ?>
          <?php foreach ($allTests as $key => $allTest): ?>
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $allTest->exam->exam_title }}</td>
              <td>{{ $allTest->exam->min_pass }}</td>
              <td>{{ $allTest->percentage }}</td>
              <td>{{ $allTest->result }}</td>
            </tr>
          <?php endforeach ?>
       <?php endif ?>
      </tbody>
    </table>
  </div><!-- /.col-12 -->
</div>


      
   </div>
</div>


@push('scripts')
<script>

  jQuery(document).ready(function($) {

  });
</script>
@endpush

@stop