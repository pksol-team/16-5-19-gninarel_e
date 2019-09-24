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
                     <li><a class="d-block" href="{{ lang_url('profile') }}" ><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/>@t('Profile personly ')</a></li>
                     <li><a class="d-block" href="{{ lang_url('all_purchases') }}" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/>@t('My purchases') </a></li>
                     <li class="active"><a class="d-block" href="#tab3" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/>@t('My Packages') </a></li>
                     <li><a class="d-block" href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/>@t('Electronic School') </a></li>
                     <li><a class="d-block" href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/>@t('Training activities') </a></li>
                     <li><a class="d-block" href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/>@t('Communication ') </a></li>
                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> @t('Exit')</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab3">
                     <div class="row mb-30">
                        <div class="col-md-12">
                           <a href="{{ lang_url('plans_pricing') }}" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i>@t('Browse packages') </a>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive table-condensed">
                              <table class="table  sub-table">
                                 <thead>
                                    <tr>
                                       <th>@t('Subscription date')</th>
                                       <th>@t('Expiry date')</th>
                                       <th>@t('Days left')</th>
                                       <th>@t('Package name')</th>
                                       <th>@t('the amount')</th>
                                       <th>@t('View status')</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if($my_subscriptions)
                                       @foreach($my_subscriptions as $subscriptions)
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
                                          <td class="color-theme-green">
                                             <?php
                                                if ($subscriptions->package_name != 'Gold') {
                                                  $expiry_date = $subscriptions->package_end_date;
                                                  $current_date = time();
                                                  $seconds_to_expire = strtotime($expiry_date) - $current_date;
                                                  $days_to_expire = floor($seconds_to_expire/86400);
                                                  echo ($days_to_expire < 0) ? '0' : $days_to_expire;
                                                }
                                                ?>                                
                                          </td>
                                          <td class="color-dark-green">{{ $subscriptions->package_name }}</td>
                                          <td class="color-dark-green">{{ $subscriptions->package_price }}</td>
                                          <td class="color-theme-green font-weight-600">{{ $subscriptions->status }}</td>
                                       </tr>
                                       @endforeach
                                    @else
                                       <tr>
                                        <td colspan="50">@t('No records found')</td>
                                       </tr>
                                    @endif
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
