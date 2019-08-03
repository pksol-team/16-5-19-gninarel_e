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

                    <li class="active text-gray-silver">الخدمات</li>

                </ol>

                <h2 class="title text-white">الملف الشامل لسوق الأسهم </h2>

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

                  <div class="post-thumb thumb"> <img src="\public\storage\{{ $productDecode->thumbnail }}" alt="{{ $productDecode->name }} class="img-responsive img-fullwidth"> </div>

                </div>  

                <div class="col-md-9 col-sm-12">

                    <div class="entry-title pt-10 pl-15">

                      <h4 class="color-theme-green font-weight-600">{{ $productDecode->name }} </h4>

                    </div>

                     <div class="entry-content mt-10">

                      <p class="mb-15">{!! $productDecode->long_description !!}</p>

                    </div>

                    <div class="entry-content mt-10">

                      <p class="mb-15"><strong>Price:</strong> $ {{ $productDecode->price }}</span></p>

                    </div>

                    <!-- <h4 class="color-theme-green ">المزايا</h4>

                    <ul class="table-list list-icon theme-colored pb-0">

                        <li><i class="">- </i>المدة</li>

                        <li><i class="">- </i>المحتوى</li>

                        <li><i class="">- </i>الخصم</li>

                        <li><i class="">- </i>ساعات الاستشارات</li>

                        <li><i class="">- </i>غرف التدريب اليوم </li>

                        <li><i class="">- </i>اخرى</li>

                    </ul> -->

                </div>

                <!-- <div class="col-md-3 col-sm-12">

                    <img src="images/file-img.png" alt="" class="img-responsive img-fullwidth">

                    <p class="text-center font-18 font-weight-600"><a href="#" class="color-theme-green">تحميل تفاصيل الملف </a></p>

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

            <!-- <div class="row">

            <div class="col-md-12">

              <h3 class="text-right font-weight-500 font-20">صور من المنتج</h3>  

 -->

              <!-- Portfolio Gallery Grid -->

              <!-- <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery"> -->

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-1.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-1.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->

                

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-2.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-2.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End --> 

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-3.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-3.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End --> 

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-4.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-4.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->  

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-5.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-5.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->  

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-6.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-6.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->  

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-7.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-7.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->  

                  

                <!-- Portfolio Item Start -->

                <!-- <div class="gallery-item mb-20">

                  <div class="thumb">

                    <img class="img-fullwidth" src="images/doc-8.png" alt="project">

                    <div class="overlay-shade"></div>

                    <div class="text-holder">

                      <div class="title text-center">أسم الصورة هنا</div>

                    </div>

                    <div class="icons-holder">

                      <div class="icons-holder-inner">

                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">

                          <a href="images/doc-8.png" data-lightbox-gallery="gallery" title="أسم الصورة هنا"><i class="fa fa-picture-o"></i></a>

                        </div>

                      </div>

                    </div>

                  </div>

                </div> -->

                <!-- Portfolio Item End -->  

              <!-- </div> -->

              <!-- End Portfolio Gallery Grid -->



            <!-- </div>

          </div> -->

            <div class="row rtl">

                <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12">

                    <div class="col-xs-12 col-sm-6 col-md-6 hvr-float-shadow mb-sm-30">

                      <div class="pricing-table maxwidth400">

                        </div>

                        <div class=" bg-white border-1px p-30 pt-20 pb-20">

                          <img src="/frontend/_assets/images/payment-1.jpg" alt="">  

                        </div>

                        <a data-toggle="modal" data-target="#pay-modal" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">شراء الملف باستخدام الدفع الالكتروني</a>

                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-6 hvr-float-shadow mb-sm-30">

                      <div class="pricing-table maxwidth400">

                        </div>

                        <div class=" bg-white border-1px p-30 pt-20 pb-20">

                          <img src="/frontend/_assets/images/payment-2.jpg" alt="">  

                        </div>

                        <a data-toggle="modal" data-target="#pay-modal" class="btn btn-lg btn-theme-green text-uppercase btn-block pt-20 pb-20 btn-flat">شراء الملف باستخدام التحويل البنكي</a>

                    </div>

                </div> 

            </div>     

        </div>

      </div>

    </section>  

  </div>

  <!-- end main-content -->







  <!-- ADD NEW JOB MODAL -->
  <div class="modal fade" id="pay-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center color-theme-green font-weight-700 font-26 mt-20 mb-10" id="myModalLabel">طلب المنتج بعد عملية التحويل </h4>
          <p class="color-dark-green text-right">فضلا قم بتعبئة النموذج بعد عملية التحويل المبلغ على حسابتنا البنكية </p>
          <p class="text-gray mb-0 text-right">معلومات البنك :</p>
          <p class="text-gray mb-0 text-right">اسم البنك : <span> البنك الاول</span></p>
          <p class="text-gray mb-0 text-right">رقم الحساب : <span> 33333333332323</span></p>
          <p class="text-gray mb-0 text-right">رقم الايبان : <span> sasasasasasasasasas</span></p>
        </div>
        <div class="modal-body">
             <!-- add new job Form -->
              <form name="checkoutForm" id="checkoutForm"  class="form-inline" action="{{ lang_url('checkout_post') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                          <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="first_name">الاسم الاول</label>
                              <input id="first_name" name="first_name" class="form-control" type="text" placeholder="الاسم الاول" required="" aria-required="true">
                            </div>
                          </div>
                          <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="last_name">الكنية</label>
                              <input id="last_name" name="last_name" class="form-control" type="text" placeholder="الكنية" required="" aria-required="true">
                            </div>
                          </div>
                          <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="user_address">عنوان</label>
                              <input id="user_address" name="user_address" class="form-control" type="text" placeholder="عنوان" required="" aria-required="true">
                            </div>
                          </div>

                          <div class="col-sm-12 p-0 mb-30">
                            <h6 class="my-0 quantity-h">Quantity</h6>
                            <div class="qty-changer form-group">
                              <button type="button" class="qty-change minus btn btn-danger">-</button>
                              <input class="qty-input form-control" name="qty-input" type="number" min="1" value="1" readonly>
                              <button type="button" class="qty-change plus btn btn-success">+</button>
                            </div>
                          </div>

                          <div class="col-sm-12 p-0 list-group-item d-flex justify-content-between">
                            <h6 class="my-0">Total Price</h6>
                            <span class="form-group text-muted total_price"><strong>$ <span>{{ $productDecode->price }} </span></strong></span>
                            <input type="hidden" name="product_price" class="book_price_main" value="{{ $productDecode->price }}">
                            <input class="total_price_hidden" name="total_price_hidden" type="hidden" value="{{ $productDecode->price }}">
                            <input name="product_native_id" type="hidden" value="{{ $productDecode->id }}">
                          </div>
                          
                          <!-- <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="city">المدينة </label>
                              <select class="form-control" id="city"> 
                                  <option>الرياض</option> 
                                  <option>2</option> 
                                  <option>3</option> 
                                  <option>4</option> 
                                  <option>5</option> 
                                </select>
                            </div>
                          </div> -->
                         <!--  <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="account-number">الحساب </label>
                              <input id="account-number" name="account-number" class="form-control" type="text" placeholder="رقم الحساب" required="" aria-required="true">
                            </div>
                          </div> -->
                          <!-- <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="amount">المبلغ المحول</label>
                              <input id="amount" name="amount" class="form-control" type="text" placeholder="المبلغ المحول" required="" aria-required="true">
                            </div>
                          </div> -->
                          <!-- <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="mobile">رقم الجوال</label>
                              <input id="mobile" name="mobile" class="form-control" type="text" placeholder="رقم الجوال" required="" aria-required="true">
                            </div>
                          </div> -->
                          <!-- <div class="col-sm-12 p-0">
                            <div class="form-group mb-30">
                              <label for="email">البريد الالكتروني</label>
                              <input id="email" name="email" class="form-control" type="email" placeholder="البريد الالكتروني" required="" aria-required="true">
                            </div>
                          </div> -->  
                          <!-- <div class="col-sm-12 p-0">
                            <div class="form-group mb-0">
                              <label for="job_end">ايصال التحويل</label>
                                  <div class="file-input-wrapper">
                                    <label for="upload-file" class="file-input-button">أستعراض</label>
                                    <input id="upload-file" type="file" name="file1" />
                                  </div>
                            </div>
                          </div> -->
                    </div>
                </div>
        <div class="modal-footer text-center mb-30">
          <button type="submit" class="btn btn-dark btn-flat btn-theme-green">طلب المنتج</button>
        </div>
              </form>
        </div>
      </div>
    </div>
  </div>

@push('scripts')
<script>
  $(document).ready(function() {
     var quantitiy = 0;

     var price = $('.book_price_main').val();

     $('button.qty-change.plus').click(function (e) {
       e.preventDefault();

       var quantity = parseFloat($('input.qty-input.form-control').val());

       $('input.qty-input.form-control').val(quantity + 1);

       var quantity_exact = $('input.qty-input.form-control').val();

       var myResult = quantity_exact * price;


       $('.total_price span').text(myResult);
       $('.total_price_hidden').val(myResult);
    });

     $('button.qty-change.minus').click(function (e) {
       e.preventDefault();

       var quantity = parseFloat($('input.qty-input.form-control').val());

       if (quantity > 1) {
         $('input.qty-input.form-control').val(quantity - 1);
       }

       var quantity_exact = $('input.qty-input.form-control').val();

       var myResult = quantity_exact * price;


       $('.total_price span').text(myResult);
       $('.total_price_hidden').val(myResult);
     });
  });
</script>
@endpush

@stop