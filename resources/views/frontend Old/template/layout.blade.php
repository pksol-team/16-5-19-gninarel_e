<?php $user = Auth::user(); ?>
<?php $direction = \Request::get('direction'); ?>
<!DOCTYPE html>
<html dir="<?= $direction ?>" >
  <head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- Page Title -->
    <title>@yield('title')- Better Trend</title>
    <!-- Stylesheet -->
    <link href="/frontend/_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/_assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/_assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="/frontend/_assets/css/css-plugin-collections.css" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins" href="/frontend/_assets/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
    <!-- CSS | RTL Layout -->
    <link href="/frontend/_assets/css/style-main-ar.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="/frontend/_assets/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | RTL Layout -->
    <link href="/frontend/_assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/_assets/css/style-main-rtl.css" rel="stylesheet" type="text/css">
    <link href="/frontend/_assets/css/style-main-rtl-extra.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="/frontend/_assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href='/frontend/assets/css/plyr.css'>
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="/frontend/_assets/css/style.css" rel="stylesheet" type="text/css"> -->
    <!-- font-awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS | Theme Color -->
    <link href="/frontend/_assets/css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/custom.css?time=<?php  echo time() ?>">
    <!-- external javascripts -->
    <script src="/frontend/_assets/js/jquery-2.2.4.min.js"></script>
    <script src="/frontend/_assets/js/jquery-ui.min.js"></script>
    <script src="/frontend/_assets/js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="/frontend/_assets/js/jquery-plugin-collection.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5d009929b534676f32ae799d/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
  <body class="">
    <div id="wrapper" class="clearfix">
      <!-- Header -->
      <header id="header" class="header">
        <div class="header-nav navbar-fixed-top header-dark navbar-white navbar-sticky-animated animated-active">
          <div class="header-nav-wrapper">
            <div class="container">
              <nav id="menuzord-right" class="menuzord orange">
                <a class="menuzord-brand pull-left flip mt-15" href="{{ lang_url('') }}">
                <img src="/frontend/_assets/images/header-logo.png" alt="">
                </a>
                <ul class="menuzord-menu dark">
                  <li class="active"><a href="{{ lang_url('') }}">@t('الرئيسية ')</a></li>
                  <li class="">
                    <a href="#">الأتجاة الأفضل </a>
                    <ul class="dropdown">
                      <li><a href="{{ lang_url('about') }}">@t('تعريف  ')</a></li>
                      <li><a href="{{ lang_url('coaches') }}">@t('المدربين  ')</a></li>
                    </ul>
                  </li>
                  <li class="">
                    <a href="{{ lang_url('plans_pricing') }}">@t('الخدمات ')</a>
                    <ul class="dropdown">
                      <li><a href="{{ lang_url('plans_pricing') }}"> @t('باقات الاشتراك  ') </a></li>
                      <li><a href="{{ lang_url('tools') }}">الملف الشامل</a></li>
                      <li><a href="{{ lang_url('books') }}">الكتب</a></li>
                      <li><a href="{{ lang_url('allschools') }}">@t('المدرسة الإلكترونية ')</a></li>
                      <li><a href="{{ lang_url('events') }}">الدورات</a></li>
                    </ul>
                  </li>
                  <li class=""><a href="{{ lang_url('media') }}">@t('المكتبة التعليمية ')</a></li>
                  <li class=""><a href="{{ lang_url('contact_us') }}">@t('أتصل بنا  ')</a></li>
                  <li class="dashboard-btn"><a href="{{ lang_url('profile') }}">{{ Auth::check() ? Auth::user()->name : t('بوابة العملاء  ') }}  </a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>
      <!-- Main Content -->
      @yield('content')
      <!-- Main Content -->
      <footer class="bg-semi-gray">
        <div class="container pt-70 pb-40">
          <div class="row">
            <div class="col-sm-6 col-md-2 col-xs-12 footer-widget-col">
              <div class="widget dark">
                <div class="opening-hours">
                  <img src="/frontend/_assets/images/footer-logo.png"/>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xs-12 footer-widget-col">
              <div class="widget dark">
                <h4 class="widget-title">@t('صفحات الموقع ')</h4>
                <div class="col-md-6 col-sm-12 p-0">
                  <ul class="list angle-double-right list-border">
                    <li><a href="{{ lang_url('about') }}"><span>-</span>@t(' عن الاتجاه الأفضل ')</a></li>
                    <li><a href="{{ lang_url('') }}"><span>-</span>@t(' بوابة المستخدمين')</a></li>
                    <!-- <li><a href="news.html"><span>-</span> الاخبار والمقالات </a></li> -->
                    <!-- <li><a href="calendar.html"><span>-</span> تقويم الأحداث </a></li> -->
                    <li><a href="{{ lang_url('coaches') }}"><span>-</span>@t(' المدربين ')</a></li>
                  </ul>
                </div>
                <div class="col-md-6 col-sm-12 p-0">
                  <ul class="list angle-double-right list-border">
                    <li><a href="{{ lang_url('our_partners') }}"><span>-</span>@t(' الشركاء')</a></li>
                    <li><a href="{{ lang_url('terms_and_conditions') }}"><span>-</span>@t(' ساسية وشروط الاستخدام ')</a></li>
                    <!-- <li><a href="warning.html"><span>-</span> إشعار التحذير من المخاطر   </a></li> -->
                    <li><a href="{{ lang_url('contact_us') }}"><span>-</span>@t(' التواصل ')</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xs-12 footer-widget-col">
              <div class="widget dark">
                <h4 class="widget-title">@t('المنتجات والخدمات ')</h4>
                <ul class="list angle-double-right list-border">
                  <li><a href="{{ lang_url('books') }}"><span>-</span>@t(' الكتب')</a></li>
                  <!-- <li><a href="general-file.html"><span>-</span> الملف الشامل </a></li>     -->
                  <li><a href="{{ lang_url('allschools') }}"><span>-</span>@t(' المدرسة الالكترونية  ')</a></li>
                  <li><a href="{{ lang_url('plans_pricing') }}"><span>-</span>@t(' باقات الاشتراك   ')</a></li>
                  <li><a href="{{ lang_url('events') }}"><span>-</span>@t(' الدورات  ')</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-3 col-xs-12 footer-widget-col">
              <div class="widget dark">
                <h4 class="widget-title">@t('تواصل معنا ')</h4>
                <p class="font-14 mt-20 mb-20">
                  Support@bettertrend.net
                </p>
                <ul class="styled-icons flat medium list-inline mb-40">
                  <li><a target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a> </li>
                  <li><a target="_blank" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a> </li>
                  <li><a target="_blank" href="https://www.twitter.com"><i class="fa fa-twitter"></i></a> </li>
                  <li><a target="_blank" href="https://www.youtube.com"><i class="fa fa-youtube"></i></a> </li>
                </ul>
                <h4 class="widget-title">@t('القائمة')</h4>
                @if(session()->has('emailSubscriptionError'))
                <div class="alert alert-red w-50" style="margin:0 auto;">
                  <ul class="list-unstyled mb-0">
                    <li class="text-white">{!! session()->get('emailSubscriptionError') !!}</li>
                  </ul>
                </div>
                @endif
                @if(session()->has('emailSubscriptionMessage'))
                <div class="alert alert-blue w-50" style="margin:0 auto;">
                  <ul class="list-unstyled mb-0">
                    <li class="text-white">{!! session()->get('emailSubscriptionMessage') !!}</li>
                  </ul>
                </div>
                @endif
                <form id="mailchimp-subscription-form-footer" class="newsletter-form" action="{{ lang_url('email_subscribe_user') }}" method="POST">
                  @csrf
                  <div class="input-group">
                    <input style="color: black;" type="email"  name="email" placeholder="@t(' Your Email')" class="form-control input-lg font-16" data-height="45px" id="mce-EMAIL-footer" value="{{ old('email') }}" required>
                    <span class="input-group-btn">
                    <button data-height="45px" class="btn bg-theme-color-2 text-white btn-xs m-0 font-14" type="submit">@t('إشتراك')</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
              <div class="widget dark">
                <h4 class="widget-title" style="color:#D5D5D5 !important">@t('أشعار المخاطر ')</h4>
                <p class="">@t('footerNotice')</p>
              </div>
            </div>
          </div>
        </div>
        <div class="footer-bottom" data-bg-color="rgba(0, 0, 0, 1)">
          <div class="container pt-15 pb-10">
            <div class="row">
              <div class="col-md-6">
                <!-- <p class="font-14 color-gray-light m-0">Powered by DNet.sa</p> -->
              </div>
              <div class="col-md-6 text-left">
                <p class="font-14 color-gray-light m-0">@t('All copyrights reserved © 2019- 2018')</p>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- end wrapper -->
    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <script src="/frontend/_assets/js/custom.js"></script>
    <script>
      $(document).ready(function(){
        // $('#summernote').summernote({
        //   height: 230,
        //   disableResizeEditor: true
        // });
      });
    </script>
    @stack('scripts')
  </body>
</html>