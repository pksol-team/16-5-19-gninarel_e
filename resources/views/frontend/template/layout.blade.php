<?php use Illuminate\Support\Facades\DB; ?>
<?php use storage\framework\sessions; ?>
<?php $user = Auth::user(); ?>
<!DOCTYPE html>
<html dir="rtl">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>@yield('title')- E Learning</title>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/rtl/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700,800">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mallanna">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yantramanav:300,400,500,700">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/raleway.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/rtl/style.css">
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/custom.css">
   </head>
   <body class="join-page">
      <div class="body-wrapper">
         <div id="side-menu" class="side-menu">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <nav class="main-menu" aria-label="Main Menu">
               <ul id="menu-front-end" class="menu">
                  <li>
                     <a href="/">
                     <span class="menu-text">Features</span>
                     </a>
                  </li>
                  <li>
                     <a href="plans-pricing.html">
                     <span class="menu-text">Plans and Pricing</span>
                     </a>
                  </li>
                  <li>
                     <a href="the-trading-coach-podcast.html">
                     <span class="menu-text">Podcast</span>
                     </a>
                  </li>
                  <li>
                     <a href="/userlogin">
                     <span class="menu-text">LogIn</span>
                     </a>
                  </li>
                  <li>
                     <a href="/">
                     <span class="menu-text">Homepage</span>
                     </a>
                  </li>
                  <li>
                     <a href="/about">
                     <span class="menu-text">About</span>
                     </a>
                  </li>
                  <li>
                     <a href="/profile">
                     <span class="menu-text">Profile</span>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span class="menu-text">Media</span>
                        <ul class="dropdown-content">
                           <li>
                     <a href="">Videos </a>
                  </li>
                     <li><a href="">Images </a></li>
                     <li><a href="">Files  </a></li>
                     <li><a href="">News & Economic Calander </a></li>
                     <li><a href="">Newsletter </a></li>
                     <li><a href="">Email List Subscription  </a></li>
                     </ul>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span>Services & Products</span>
                        <ul class="dropdown-content">
                           <li class="dropdown">
                     <a href="#">Events
                        <ul class="dropdown-content">
                        <li><a href="">Online Courses & Events</a></li>
                        <li><a href="">Live Training Room</a></li>
                        <li><a href="">Private Online Sessions</a></li>
                        <li><a href="">Off Site Courses & Events</a></li>
                        </ul> 
                     </a>
                     <a href="/products">Books
                        <ul class="dropdown-content">
                           <li class="dropdown">
                              <a href="#">Books</a>
                           </li>
                        </ul>
                     </a>
                     </li>
                     </ul>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span class="menu-text">Tools</span>
                        <ul class="dropdown-content">
                           <li>
                     <a href="">Better Trend Master File</a></li>
                     <li><a href="">E-Books</a></li>
                     </ul>
                     </a>
                  </li>
                  <li class="dropdown">
                     <a href="#">
                        <span class="menu-text">Books</span>
                        <ul class="dropdown-content">
                           <li>
                     <a href="">The Key in Trading Success</a></li>
                     <li><a href="">....</a></li>
                     </ul>
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
                              <a href="disclaimers.html">Disclaimers</a> | 
                              <a href="terms-and-conditions.html">Terms &amp; Conditions</a> | 
                              <a href="refund_policy.html">Refund Policy</a> | 
                              <a href="contact.html">Contact Us</a>
                           </p>
                           <p>Copyright 2019-2020 </p>
                           <p>All Rights Reserved | XYZ Rd Ste 999, Dumy</p>
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
      <script src="/frontend/assets/js/app.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
   </body>
</html>