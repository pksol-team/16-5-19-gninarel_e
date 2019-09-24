@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content">
   <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
         <!-- Section Content -->
         <div class="section-content">
            <div class="row">


               <div class="col-md-12">
                  <ol class="breadcrumb text-right text-black mb-0 mt-40">
                     <li><a href="{{ lang_url('') }}">@t('the main page')</a></li>
                     <li class="active text-gray-silver">@t('For the best direction')</li>
                     <li class="active text-gray-silver">@t('Definition of')</li>
                  </ol>
                  <h2 class="title text-white">@t('For the best direction')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-md-12">
                <a href="{{ lang_url('schools') }}" class="btn btn-dark btn-xl btn-blue pull-left"></i>@t('School Page')</a>
               <table id="school-Datatable" class="display custom-table table-bordered" width="100%">
                  <thead>
                     <tr>
                        <th>@t('Sr') #</th>
                        <th>@t('Test Name')</th>
                        <th>@t('Minimum Percentage')</th>
                        <th>@t('My Percentage')</th>
                        <th>@t('Result')</th>
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
            </div>
         </div>
         <div class="separator separator-rounedd"></div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop