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

                     <li class="d-block"><a href="{{ lang_url('training_activities') }}" ><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>

                     <li  class="active"><a href="#tab6" ><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>

                     <li><a class="d-block" href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>

                  </ul>

               </div>

            </div>

            <div class="col-md-9 col-sm-9 col-xs-12">

               <div class="tab-content">

                <div class="tab-pane fade in active" id="tab6">

                    <div class="row">

                        <div class="col-md-12">

                            <!-- contact Form -->

                              <form id="contact" name="contact" class="form-inline" action="{{ lang_url('communication_contact_us_email') }}" method="post">
                                @csrf
                                @if(session()->has('error'))
                                <div class="alert alert-red">
                                   <ul class="list-unstyled mb-0">
                                      <li class="text-white">{!! session()->get('error') !!}</li>
                                   </ul>
                                </div>
                                @endif
                                @if(session()->has('message'))
                                <div class="alert alert-green">
                                   <ul class="list-unstyled mb-0">
                                      <li class="text-white">{!! session()->get('message') !!}</li>
                                   </ul>
                                </div>
                                @endif
                                <div class="row">

                                    <div class="col-md-12 col-sm-12">

                                          <div class="col-sm-12 p-0">

                                            <div class="form-group mb-30">

                                              <label for="mobile_Number">رقم الهاتف المحمول  </label>

                                              <input class="form-control" type="text" placeholder="عرقم الهاتف المحمول  " id="mobile_Number" name="mobile_Number" required>

                                            </div>

                                          </div>

                                          <div class="col-sm-12 p-0">

                                            <div class="form-group mb-30">

                                              <label for="subject">نموضوع </label>

                                              <select class="form-control" id="subject" name="subject" required="required"> 

                                                <option value="" hidden>Subject</option>
                                                <option value="Technical support">Technical support</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Complaint">Complaint</option>
                                                <option value="Suggestions">Suggestions</option>
                                                <option value="Special">Special</option>
                                                <option value="request">request</option>
                                                <option value="others">others</option>

                                              </select>

                                            </div>

                                          </div>

                                          <div class="col-sm-12 p-0">

                                            <div class="form-group mb-30">

                                              <label for="email">عنوان بريد الكتروني </label>

                                              <input class="form-control" placeholder="ععنوان بريد الكتروني " type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>

                                            </div>

                                          </div>

                                          <div class="col-sm-12 p-0">

                                            <div class="form-group mb-30">

                                              <label for="summernote">معلومات اضافية</label>

                                              <textarea id="summernote" class="form-control" name="message" rows="10" cols="5" placeholder="رسالة" required></textarea>

                                            </div>

                                          </div>

                                          <div class="form-group form-group-center text-center mb-30 mt-20">

                                              <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">أرسال</button>

                                          </div>

                                    </div>

                                </div>

                              </form>

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