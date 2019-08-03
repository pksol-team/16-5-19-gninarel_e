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

                    <li class="active text-gray-silver">الخدمات والمنتجات</li>

                </ol>

                <h2 class="title text-white">المدارس الالكترونية</h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    <section class="divider">

      <div class="container">

          <div class="row rtl">

              <div class="col-xs-12 col-sm-12 col-md-12 mb-sm-30">

                  <h2 class="mt-0 font-30 heading-title-spec">المدارس الإلكترونية</h2>

                  <p class="mb-30">وصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هناوصف الباقة هنا</p> 

              </div>

          </div>

          <div class="row rtl">

            <?php if ($schoolNative): ?>



              <?php foreach ($schoolNative as $key => $school): ?>

            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">

              <div class="pricing-table maxwidth400">

                </div>

                <div class=" bg-white border-1px p-30 pt-20 pb-20">

                  <h3 class="package-type font-24 m-0 mb-20 color-theme-green text-center"><a href="{{ lang_url('school/'.$school->schools->id.'/view') }}">{{ $school->name }}</a></h3>

                  <img src="\public\storage\{{ $school->image }}" alt="{{ $school->name }}">  

                  <p>{{ $school->description }}</p>

                </div>

                <a href="{{ lang_url('school/'.$school->schools->id.'/view') }}" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">التفاصيل </a>

            </div> 



            <?php endforeach ?>



          <?php else: ?>



            <div class="col-xs-12 col-sm-6 col-md-4 hvr-float-shadow mb-sm-30">

              <div class="pricing-table maxwidth400">

                </div>

                <div class=" bg-white border-1px p-30 pt-20 pb-20">

                  <p>No Record Found !</p>

                </div>

            </div> 

            <?php endif ?>

          </div>   

          <!-- <div class="row mt-40">

              <div class="col-sm-12">

                <nav>

                  <ul class="pagination theme-colored pull-center">

                    <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>

                    <li class="active"><a href="#">1</a></li>

                    <li><a href="#">2</a></li>

                    <li><a href="#">3</a></li>

                    <li><a href="#">4</a></li>

                    <li><a href="#">5</a></li>

                    <li><a href="#">...</a></li>

                    <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>

                  </ul>

                </nav>

              </div>

          </div> -->

      </div>

    </section>  

   

      

  </div>

  <!-- end main-content -->





















  @stop