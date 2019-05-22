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
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/style.css">
      <?php if ($direction == 'rtl'): ?>
         <link rel="stylesheet" type="text/css" href="/frontend/assets/css/rtl/style.css">
      <?php endif ?>
      <link rel="stylesheet" type="text/css" href="/frontend/assets/css/custom.css">
   </head>
   <body class="login-page">
      <div class="container">
         <div class="row">
            <div class="offset-md-3 col-md-6 box-bg">
               <div class="login-box">
                  <img src="/frontend/assets/img/logo21.png" alt="Logo">
                  <!-- Main Content -->
                  @yield('content')
                  <!-- Main Content -->
               </div>
            </div>
         </div>
      </div>
      <script src="/frontend/assets/js/jquery-3.4.0.min.js"></script>
      <script src="/frontend/assets/js/proper.js"></script>
      <script src="/frontend/assets/js/bootstrap.min.js"></script>
      <script src="/frontend/assets/js/app.js"></script>
      <script src="/frontend/assets/js/custom.js"></script>
   </body>
</html>