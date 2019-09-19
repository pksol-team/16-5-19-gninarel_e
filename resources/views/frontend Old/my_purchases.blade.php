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
                     <li class="active"><a class="d-block" href="#tab2" ><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/> مشترياتي</a></li>
                     <li><a class="d-block" href="{{ lang_url('all_subscriptions') }}" ><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/> باقاتي</a></li>
                     <li><a class="d-block" href="{{ lang_url('schools') }}" ><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> المدرسة  الالكترونية</a></li>
                     <li><a class="d-block" href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>
                     <li><a class="d-block" href="{{ lang_url('communication') }}" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>
                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="tab-content">
                  <div class="tab-pane fade in active " id="tab2">
                     <div class="row mb-30">
                        <div class="col-md-12">
                           <a href="{{ lang_url('listings') }}" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i> إستعراض المنتجات </a> 
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="table-responsive table-condensed">
                              <table class="table  sub-table">
                                 <thead>
                                    <tr>
                                       <th>تاريخ الشراء</th>
                                       <th>المنتج</th>
                                       <th>المبلغ</th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if($all_purchases)
                                       @foreach($all_purchases as $purchase)
                                       <tr>
                                          <td class="half-gray">
                                             @php
                                             $dt = new DateTime($purchase->created_at);
                                             echo $dt->format('d-m-Y');
                                             @endphp
                                          </td>
                                          <td class="color-theme-green">{{ $purchase->ProductsNative->name }} </td>
                                          <td class="color-dark-green">{{ $purchase->total_price }}</td>
                                          <td>
                                             <a href="#" class="btn btn-default btn-lg blue">عرض التفاصيل</a>
                                          </td>
                                       </tr>
                                       @endforeach
                                    @else
                                    <tr>
                                       <td colspan="50">No records found</td>
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
