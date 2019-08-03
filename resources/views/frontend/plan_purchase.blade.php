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



                    <li class="active text-gray-silver">عن الأتجاه الأفضل</li>



                    <li class="active text-gray-silver">تعريف</li>



                </ol>



                <h2 class="title text-white">عن الأتجاه الأفضل</h2>



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



                <form id="buy_plan_school" name="buy_plan_school" class="form-inline" action="{{ lang_url('buy_plan_school') }}" method="post">

                    @csrf
                    <?php
                       $date = date("Y-m-d");// current date
                       if ($no == '1') {
                          $period = '';
                          
                       } else if ($no == '2') {
                          $period = '+1 year';

                       } else if ($no == '3') {
                          $period = '+1 month';
                          
                       } else if ($no == '4') {
                          $period = '+1 week';                     
                       }
                       $date = strtotime(date("Y-m-d", strtotime($date)) . $period); 
                       $time = date("Y-m-d h:i:s", $date);
                    ?>
                    @if(session()->has('error'))
                    <div class="alert alert-red">
                       <ul class="list-unstyled mb-0">
                          <li class="text-white">{!! session()->get('error') !!}</li>
                       </ul>
                    </div>
                    @endif
                    <input type="hidden" name="plan_name" value="{{ $plan_name }}" />
                    <input type="hidden" name="no" value="{{ $no }}" />
                    <input type="hidden" name="price" value="{{ $price }}" />
                    <input type="hidden" name="package_start_date" value="{{ date('Y-m-d h:i:s') }}" />
                    <input type="hidden" name="package_end_date" value="{{ $time }}" />

                          <div class="row">

                              <div class="col-md-10 col-sm-12 col-md-offset-1">
                                 <?php if ($schoolNative): ?>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="school_name">مدرسة </label>

                                        <select class="form-control" id="school_name" name="school"> 
                  <?php foreach ($schoolNative as $key => $school): ?>

                                          <option value="{{ $school->schools->id }}">{{ $school->name }}</option> 
                  <?php endforeach ?>

                                        </select>

                                      </div>

                                    </div>
                                    <?php endif ?>
                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="price">عضوية <small><span class="mbrshp_name">{{ $plan_name }}</span></small> </label>

                                        <input class="form-control" type="text" value="${{ $price }}" id="price" name="price" required disabled readonly>

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="price"> تنتهي صلاحيته في</label>

                                        <input id="price" name="price" value="{{ $time }}" class="form-control" type="text" placeholder=" الرقم السري" required disabled readonly>

                                      </div>

                                    </div>

                                    <div class="form-group form-group-center text-center mb-30 mt-20">

                                        <input name="form_botcheck" class="form-control" type="hidden" value="">

                                        <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">شراء حزمة</button>

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