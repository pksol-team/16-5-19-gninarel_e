<!DOCTYPE html>
<html dir="rtl">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>{{ $title }}- E Learning</title>
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
   <body class="login-page">
      <div class="container">
         <div class="row">
            <div class="offset-md-3 col-md-6 box-bg">
               <div class="login-box">
                  <img src="/frontend/assets/img/logo21.png" alt="Logo">
                  <div class="form-box">
                     <form name="loginform" id="loginform" method="POST" action="/forgot_send_email" class="loginform">
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p class="login-username">
                          <label for="email">Email:</label><br>
                          <input type="email" name="email" id="user_login" class="input" value="{{ old('email') }}" size="100">
                        </p>
                        <p class="login-submit">
                          <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Send Password Reset Link"><br>
                        </p>
                        <p>Login instead?<a class="fusion-modal-text-link forgot" href="/userlogin">Sign In</a></p>
                     </form>
                  </div>
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