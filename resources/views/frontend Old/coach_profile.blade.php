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
                    <li class="active text-gray-silver">المدربين</li>
                </ol>
                <h2 class="title text-white">محمد اليحي</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
      
    <!-- Divider: profile -->
    <section class="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="entry-header">
                  <div class="post-thumb thumb"> <img src="\public\storage\{{ $allCoaches->users->avatar }}" alt="{{ $allCoaches->users->name }}" alt="" class="img-responsive img-fullwidth"> </div>
                </div>  
                <div class="entry-title pt-10 pl-15">
                  <h4 class="color-theme-green font-weight-600">حول</h4>
                </div>
                <div class="entry-content mt-10">
                  <p class="mb-15">{{ $allCoaches->users->about }}</p>
                </div>
                <!-- <div class="entry-title pt-10 pl-15">
                  <h4 class="color-dark-green font-weight-600 mb-30 text-center">عضوية المدرب</h4>
                </div> -->  
                <!-- <div class="entry-header entry-head">
                    <div class="col-md-8 col-md-offset-2">
                      <div class="id-white-block">
                          <div class="id-top-section">
                              <div class="right-id-img">
                                  <img src="/frontend/_assets/images/id-logo.png" alt="" class="img-responsive pull-right">
                              </div>
                              <div class="left-id-heading">
                                  <h4>عضوية مدرب</h4>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="id-footer-section pb-50">
                              <h3 class="color-theme-green font-weight-500 font-36 text-center">محمد اليحيى </h3>
                              <h4 class="color-dark-green font-28 text-center">مدرب مالي</h4>
                          </div>
                      </div>
                    </div>
                </div> -->  
                <div class="clearfix"></div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>
      
    
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- <h3 class="text-right font-weight-500 font-20">الوثائق</h3>   -->

              <!-- Portfolio Gallery Grid -->
              <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
                  
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-1.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-1.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->
                
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-2.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-2.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End --> 
                  
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-3.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-3.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End --> 
                  
                <!-- Portfolio Item Start -->
               <!--  <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-4.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-4.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->  
                  
                <!-- Portfolio Item Start -->
               <!--  <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-5.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-5.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->  
                  
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-6.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-6.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->  
                  
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-7.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-7.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->  
                  
                <!-- Portfolio Item Start -->
                <!-- <div class="gallery-item mb-20">
                  <div class="thumb">
                    <img class="img-fullwidth" src="/frontend/_assets/images/doc-8.png" alt="project">
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center">أسم الصورة هنا</div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="/frontend/_assets/images/doc-8.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Portfolio Item End -->  
              </div>
              <!-- End Portfolio Gallery Grid -->

            </div>
          </div>
          <div class="row">
              <div class="col-md-12 text-center mt-30">
                  <h4 class="text-center">الحسابات الاجتماعية  للمدرب</h4>
                  <ul class="styled-icons flat medium list-inline mb-40">
                      <?php if ($allCoaches->users->instagram != '' && $allCoaches->users->instagram != NULL): ?>
                        <li><a target="_blank" href="{{ strstr( $allCoaches->users->instagram, 'http' ) ? $allCoaches->users->instagram : 'https://'.$allCoaches->users->instagram }}"><i class="fa fa-instagram"></i></a> </li>
                      <?php endif ?>
                      <?php if ($allCoaches->users->facebook != '' && $allCoaches->users->facebook != NULL): ?>
                        <li><a target="_blank" href="{{ strstr( $allCoaches->users->facebook, 'http' ) ? $allCoaches->users->facebook : 'https://'.$allCoaches->users->facebook }}"><i class="fa fa-facebook"></i></a> </li>
                      <?php endif ?>
                      <?php if ($allCoaches->users->twitter != '' && $allCoaches->users->twitter != NULL): ?>
                        <li><a target="_blank" href="{{ strstr( $allCoaches->users->twitter, 'http' ) ? $allCoaches->users->twitter : 'https://'.$allCoaches->users->twitter }}"><i class="fa fa-twitter"></i></a> </li>
                      <?php endif ?>
                      <?php if ($allCoaches->users->youtube != '' && $allCoaches->users->youtube != NULL): ?>
                        <li><a target="_blank" href="{{ strstr( $allCoaches->users->youtube, 'http' ) ? $allCoaches->users->youtube : 'https://'.$allCoaches->users->youtube }}"><i class="fa fa-youtube"></i></a> </li>
                      <?php endif ?>
                  </ul>
              </div>
          </div>    
        </div>
      </div>
    </section>  
  </div>
  <!-- end main-content -->











  @stop