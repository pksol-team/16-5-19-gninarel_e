<?php $user = Auth::user(); ?>
<?php $direction = \Request::get('direction'); ?>
<!DOCTYPE html>
<html dir="<?= $direction ?>" >
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>@yield('title')- E Learning</title>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/font-awesome.min.css">
      <?php if ($direction == 'rtl'): ?>
         <link rel="stylesheet" type="text/css" href="/frontend/assets/css/rtl/bootstrap.min.css">
      <?php else: ?>
         <link rel="stylesheet" type="text/css" href="/frontend/assets/css/bootstrap.min.css">
      <?php endif ?>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,800">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mallanna">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yantramanav:300,400,500,700">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/raleway.css">
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css'>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css">
      <?php if ($direction == 'rtl'): ?>
         <link rel="stylesheet" type="text/css" href="/frontend/assets/css/rtl/style.css">
      <?php endif ?>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/custom.css">
   </head>
   <body class="join-page">
      <div class="body-wrapper">
         <div id="side-menu" class="side-menu">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <nav class="main-menu" aria-label="Main Menu">
               <ul id="menu-front-end" class="menu">
                  <!-- <li>
                     <a href="{{ lang_url('') }}">
                     <span class="menu-text">@t('Features')</span>
                     </a>
                  </li> -->
                  <li class="language_change">
                     <select class="selectpicker" data-width="fit">
                        <option value="en" data-content='<span class="flag-icon flag-icon-us"></span> English' <?= (Request::locale() == 'en') ? 'selected': NULL; ?> >English</option>
                        <option value="ar" data-content='<span class="flag-icon flag-icon-sa"></span> Arabic' <?= (Request::locale() == 'ar') ? 'selected': NULL; ?>>Arabic</option>
                     </select>
                  </li>
                  <li>
                     <a href="{{ lang_url('plans_pricing') }}">
                     <span class="menu-text">@t('Plans and Pricing')</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ lang_url('podcasts') }}">
                     <span class="menu-text">@t('Podcast')</span>
                     </a>
                  </li>
                  <li>
                     @if (Auth::check())
                        <a href="{{ lang_url('logout_frontend') }}">
                        <span class="menu-text">@t('LogOut')</span>
                        </a>
                     @else
                        <a href="{{ lang_url('userlogin') }}">
                        <span class="menu-text">@t('LogIn')</span>
                        </a>
                     @endif
                  </li>
                  <li>
                     <a href="{{ lang_url('/') }}">
                     <span class="menu-text">@t('Homepage')</span>
                     </a>
                  </li>
                  @if (Auth::check())
                  <li>
                     <a href="{{ lang_url('courses') }}">
                     <span class="menu-text">@t('Online School')</span>
                     </a>
                  </li>
                  @endif
                  <li>
                     <a href="{{ lang_url('about') }}">
                     <span class="menu-text">@t('About')</span>
                     </a>
                  </li>
                  @if (Auth::check())
                  <li>
                     <a href="{{ lang_url('profile') }}">
                     <span class="menu-text">@t('Profile')</span>
                     </a>
                  </li>
                  @endif
                  <li class="dropdown">
                     <a href="{{ lang_url('media') }}">
                        <span class="menu-text">@t('Media')</span>
                        <ul class="dropdown-content">
                           <li>
                     <a href="">@t('Videos')</a>
                  </li>
                     <li><a href="{{ lang_url('media') }}">@t('Images ')</a></li>
                     <li><a href="{{ lang_url('media') }}">@t('Files  ')</a></li>
                     <li><a href="{{ lang_url('media') }}">@t('News & Economic Calander ')</a></li>
                     <li><a href="{{ lang_url('media') }}">@t('Newsletter ')</a></li>
                     <li><a href="{{ lang_url('media') }}">@t('Email List Subscription  ')</a></li>
                     </ul>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span>@t('Events')</span>
                        <ul class="dropdown-content">
                           <li><a href="">@t('Online Courses & Events')</a></li>
                           <li><a href="">@t('Live Training Room')</a></li>
                           <li><a href="">@t('Private Online Sessions')</a></li>
                           <li><a href="">@t('Off Site Courses & Events')</a></li>
                        </ul>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span>@t('Services & Products')</span>
                        <ul class="dropdown-content">
                               <ul class="dropdown-content">
                                  <li><a href="">@t('Online Courses & Events')</a></li>
                                  <li><a href="">@t('Live Training Room')</a></li>
                                  <li><a href="">@t('Private Online Sessions')</a></li>
                                  <li><a href="">@t('Off Site Courses & Events')</a></li>
                               </ul>   
                           </a></li>
                           <li><a href="{{ lang_url('products/book') }}">@t('Books')</a></li>
                           <li><a href="{{ lang_url('products/tool') }}">@t('Tools')</a></li>
                        </ul>
                     </a>
                  </li>
                  <li>
                     <a href="{{ lang_url('our_partners') }}">
                     <span class="menu-text">@t('Our Partners')</span>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
         <div id="main-content" class="main-content">
            <!-- Main Content -->
            @yield('content')
            <!-- Main Content -->
            <footer id="footer" class="fusion-footer-copyright-area">
               <div class="fusion-row">
                  <div class="fusion-copyright-content">
                     <div class="fusion-copyright-notice">
                        <div class="text-center">
                           <p>
                              <a href="{{ lang_url('disclaimers') }}">@t('Disclaimers')</a> | 
                              <a href="{{ lang_url('terms_and_conditions') }}">@t('Terms & Conditions')</a> | 
                              <a href="{{ lang_url('refund_policy') }}">@t('Refund Policy')</a> | 
                              <a href="{{ lang_url('contact_us') }}">@t('Contact Us')</a>
                           </p>
                           <p>@t('Copyright 2019-2020 ')</p>
                           <p>@t('All Rights Reserved | XYZ Rd Ste 999, Dumy')</p>
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      
      <script src="/frontend/assets/js/jquery-3.4.0.min.js"></script>
      <script src="/frontend/assets/js/proper.js"></script>
      <script src="/frontend/assets/js/bootstrap.min.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'></script>
      <script src="/frontend/assets/js/app.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
      <script> 
        $(document).ready(function() {

         $(".selectpicker").change(function() {
            var $this = $(this),
               code = $this.val(),
               url = window.location.pathname,
               urlArray = url.split('/'),
               newPathname = url.replace(urlArray[1], code);
            
            window.location.href = newPathname;

         }); 
        }); 
    </script> 
   </body>
</html>