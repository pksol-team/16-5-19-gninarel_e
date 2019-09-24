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
                     <li class="active text-gray-silver">@t('Profile personly')</li>
                  </ol>
                  <h2 class="title text-white">@t('Profile personly')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="divider bg-white">
      <div class="container pt-150">
         <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="vertical-tab">
                  <ul class="nav nav-tabs">
                     <li><a class="d-block" href="{{ lang_url('profile') }}" ><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/>@t('Profile personly')</a></li>
                     <li><a class="d-block" href="#tab2" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/>@t('My purchases') </a></li>
                     <li><a class="d-block" href="{{ lang_url('all_subscriptions') }}" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/>@t('My Packages') </a></li>
                     <li class="active"><a class="d-block" href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> @t('Electronic School')</a></li>
                     <li><a class="d-block" href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/>@t('Training activities') </a></li>
                     <li><a class="d-block" href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> @t('Communication') </a></li>
                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/>@t('Exit') </a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab4">
                     <div class="row mb-30">
                        <div class="col-md-12">


                           <a href="{{ lang_url('allschools') }}" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i>@t('Review of E - Schools')</a>

                           

                              

                           

                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive table-condensed">
                              <table class="table  sub-table">
                                 <thead>
                                    <tr>
                                       <th>@t('Start Date')</th>
                                       <th>@t('End date')</th>
                                       <th>@t('School Name')</th>
                                       <th>@t('Package  name')</th>
                                       <th>@t('Status')</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (count($my_subscriptions) > 0): ?>
                                       <?php foreach ($my_subscriptions as $key => $subscriptions): ?>
                                       <tr>
                                          <td class="half-gray">
                                             <?php 
                                                $dt = new DateTime($subscriptions->package_start_date);
                                                echo $dt->format('d-m-Y');
                                                
                                                ?>
                                          </td>
                                          <td class="half-gray">
                                             <?php 
                                                $dt = new DateTime($subscriptions->package_end_date);
                                                echo $dt->format('d-m-Y');
                                                
                                                ?>
                                          </td>
                                          <td class="color-theme-green">{{ $subscriptions->name }}</td>
                                          <td class="half-gray">{{ $subscriptions->package_name }} Package</td>
                                          <td class="color-theme-green font-weight-600">{{ $subscriptions->status }}</td>
                                          <td>
                                             @if ($subscriptions->status != "active")
                                             <button class="btn btn-default" disabled> @t('View Details')</button>
                                             @else
                                             <a href="{{ lang_url('schools/'.$subscriptions->school_id.'/'.$subscriptions->id.'/view') }}" class="btn btn-default btn-lg blue">@t('View details')</a>
                                             @endif
                                          </td>
                                       </tr>
                                       <?php endforeach ?>
                                    <?php else: ?>
                                       <tr>
                                          <td colspan="50">@t('No record found')</td>
                                       </tr>
                                    <?php endif ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop
