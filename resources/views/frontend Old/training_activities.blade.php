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
                     <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>
                     <li class="active text-gray-silver">الملف الشخصي</li>
                  </ol>
                  <h2 class="title text-white">الملف الشخصي</h2>
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
                     <li><a class="d-block" href="{{ lang_url('profile') }}" ><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/> الملف الشخصي </a></li>
                     <li><a class="d-block" href="{{ lang_url('all_purchases') }}" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/> مشترياتي</a></li>
                     <li class="d-block"><a class="d-block" href="{{ lang_url('all_subscriptions') }}" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/> باقاتي</a></li>
                     <li class="d-block"><a href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> المدرسة  الالكترونية</a></li>
                     <li class="active"><a href="#tab5" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>
                     <li><a class="d-block" href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>
                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab5">
                     <div class="row mb-30">
                        <div class="col-md-12">   
                           <a href="{{ lang_url('events') }}" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i>إستعراض الأنشطة </a>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive table-condensed">
                              <table class="table  sub-table">
                                 <thead>
                                    <tr>
                                       <th>تاريخ الاشتراك</th>
                                       <th>نوع النشاط</th>
                                       <th>تصنيف النشاط</th>
                                       <th>عنوان النشاط </th>
                                       <th>المكان </th>
                                       <th>تاريخ النشاط</th>
                                       <th>ساعات</th>
                                       <th>المدة </th>
                                       <th>المبلغ</th>
                                       <th>الاجمالي</th>
                                       <th>الدفع </th>
                                       <th>العدد </th>
                                       <th>الحالة  </th>
                                       <th>  </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (count($training_activities) > 0): ?>
                                    <?php foreach ($training_activities as $key => $training_activity): ?>
                                    <tr>
                                       <td class="half-gray">
                                          <?php 
                                             $dt = new DateTime($training_activity->enroll_date);
                                             echo $dt->format('d-m-Y');
                                             
                                             ?>
                                       </td>
                                       <td class="color-dark-green">{{ ucwords(str_replace('_', ' ', $training_activity->type)) }}</td>
                                       <!-- <td>Training Room/Training Consultant/Coperative Courses/Others/Private Courses</td> -->
                                       <td class="color-dark-green">{{ $training_activity->classification }}</td>
                                       <!-- <td>Online/Offsite</td> -->
                                       <td class="color-dark-green">{{ $training_activity->name }}</td>
                                       <td class="half-gray">{{ $training_activity->location }}</td>
                                       <!-- <td>Online/Hotel/Other/Institution</td> -->
                                       <td class="half-gray">
                                          <?php 
                                             $dt = new DateTime($training_activity->start_date);
                                              echo $dt->format('d-m-Y');
                                             
                                             ?>
                                       </td>
                                       <!-- <td class="color-dark-green">{{-- $training_activity->days --}}</td> -->
                                       <td class="color-dark-green">{{ $training_activity->hours }}</td>
                                       <td class="color-dark-green">
                                          <?php 
                                             $coperativeActivity = DB::table('course_subscriptions')
                                             ->join('events', 'course_subscriptions.event_id', '=', 'events.id')
                                             ->select('course_subscriptions.*', 'events.*')
                                             ->where([['events.type', $training_activity->type], ['course_subscriptions.status', 'active']])
                                             ->groupBy('course_subscriptions.user_id')
                                             ->get();
                                             
                                             ?>
                                          <?php if ($training_activity->type == 'cooperative_courses'): ?>
                                          <div class='text-success'><b> {{ $training_activity->price/count($coperativeActivity) }} </b></div>
                                          <?php else: ?>
                                          {{ $training_activity->price }}
                                          <?php endif ?>
                                       </td>
                                       <td class="half-gray">{{ $training_activity->enroll_price }}</td>
                                       <td class="color-dark-green">{{ $training_activity->paid }}</td>
                                       <td class="color-dark-green">{{ count($coperativeActivity) }}</td>
                                       <td>{{ ucwords(str_replace('_', ' ', $training_activity->course_enroll_status)) }}</td>
                                       <!-- <td>Finish/Open Registration/Inprogress/Cancelled/Delayed/Closed Registration/On hold</td> -->
                                       <td>
                                          <a href="{{ lang_url($training_activity->subscriptionID.'/activity_detail') }}"class="btn btn-default btn-lg blue"> View Details</a>
                                       </td>
                                    </tr>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                    <tr>
                                       <td colspan="50">You have not enrolled in any event yet</td>
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