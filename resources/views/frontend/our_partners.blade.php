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

                    <li><a href="index.html">الصفحة الرئيسية</a></li>

                    <li class="active text-gray-silver">الشركاء</li>

                </ol>

                <h2 class="title text-white">الشركاء</h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    <!-- Divider: Parteners --> 

    <section class="divider">

        <div class="container">

            <div class="section-content">

                <div class="row Parteners">

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-1.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-2.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-3.png">

                        </div> 

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6 mb-10 pr-5 pl-5">

                        <div class="parteners-white-block">

                            <img src="/frontend/_assets/images/part-4.png">

                        </div> 

                    </div>

                </div>

            </div>

        </div>

      </section>

      

  </div>

  <!-- end main-content -->























  @stop