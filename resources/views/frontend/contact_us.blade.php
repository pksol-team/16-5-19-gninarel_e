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

                    <li class="active text-gray-silver">أتصل بنا</li>

                </ol>

                <h2 class="title text-white">أتصل بنا</h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    <!-- Divider: Contact -->

    <section class="divider">

      <div class="container">

        <div class="row pt-30 rtl">

          <div class="col-md-8 col-sm-12">

            <p class="mb-0 color-dark-green font-18">بسعدنا تواصلكم معنا عبر النموذج ادناة او التواصل معنا على الايميل التالي</p>

            <p class="mb-0 color-dark-green font-18">support@bettertrend.net</p>

            <p class="mb-40 color-dark-green font-18">او هاتف : 052343567</p>

            <!-- contact Form -->

            <form id="contact" name="contact" class="form-inline" action="{{ lang_url('contact_us_email') }}" method="post">


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

                            <label for="msg_title">عنوان الرسالة</label>

                            <input id="msg_title" name="msg_title" class="form-control" type="text" placeholder="عنوان الرسالة" required="" aria-required="true">

                          </div>

                        </div>

                        <div class="col-sm-12 p-0">

                          <div class="form-group mb-30">

                            <label for="first_name">عالاسم الاول   </label>

                            <input id="first_name" class="form-control" placeholder="عالاسم الاول  " aria-required="true" type="text" name="first_name" required>

                          </div>

                        </div>

                        <div class="col-sm-12 p-0">

                          <div class="form-group mb-30">

                            <label for="last_name">عالكنية</label>

                            <input id="last_name"  class="form-control" type="text" placeholder="عالكنية" aria-required="true" name="last_name" required="required">

                          </div>

                        </div>

                        <div class="col-sm-12 p-0">

                          <div class="form-group mb-30">

                            <label for="msg_type">نوع الرسالة </label>

                            <select name="subject" id="subject" class="form-control" id="msg_type" required="required"> 

                                <option value="" hidden>موضوع</option>
                                <option value="Technical support">دعم فني</option>
                                <option value="Sales">مبيعات</option>
                                <option value="Complaint"> شكوى </option>
                                <option value="Suggestions">اقتراحات</option>
                                <option value="Special">خاص</option>
                                <option value="request">طلب</option>
                                <option value="others">الآخرين</option> 

                              </select>

                          </div>

                        </div>

                        <div class="col-sm-12 p-0">

                          <div class="form-group mb-30">

                            <label for="email">ععنوان بريد الكتروني </label>

                            <input id="email"  class="form-control" placeholder="ععنوان بريد الكتروني " aria-required="true" type="email" name="email" required>

                          </div>

                        </div>

                        <div class="col-sm-12 p-0">

                          <div class="form-group mb-30">

                            <label for="more_details">معلومات اضافية</label>

                            <textarea id="summernote" name="editordata" class="form-control"  name="message" required></textarea>

                          </div>

                        </div>

                        <div class="form-group form-group-center text-center mb-30 mt-20">

                            <input name="form_botcheck" class="form-control" type="hidden" value="">

                            <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">أرسال</button>

                        </div> 

                  </div>

              </div>

            </form>  

            </div>

        </div>

      </div>

    </section>

    

  </div>

  <!-- end main-content -->





  @stop