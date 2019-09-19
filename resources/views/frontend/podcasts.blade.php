@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-heading-overview">
   <a href="#" class="resp-menu" onclick="openNav()">☰</a>
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-9">
         <div class="elegant-special-heading-wrapper">
            <h1 class="special-heading-title">@t('THE TRADING COACH PODCAST')</h1>
            <p class="special-heading-description">@t('By Akil Stokes: Trading - Investing - Entrepreneurship - Motivation')</p>
         </div>
      </div>
   </div>
</div>
<div class="podcast-detail">
   <div class="row">
      <div class="col-md-4 podcasting-img-desc">
         <div class="podcastimg">
            <img src="/frontend/assets/img/TC.jpg" alt="">
         </div>
         <div class="share-this row">
            <div class="col-5">
               <h4 class="tagline">@t('Share This!')</h4>
            </div>
            <div class="col-7">
               <div class="social_icon_list">
                  <ul>
                     <li>
                        <a href="#">
                        <i data-toggle="tooltip" data-placement="top" title="Facebook" class="fa fa-facebook"></i>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                        <i data-toggle="tooltip" data-placement="top" title="Twitter" class="fa fa-twitter"></i>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                        <i data-toggle="tooltip" data-placement="top" title="Youtube" class="fa fa-youtube-play"></i>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                        <i data-toggle="tooltip" data-placement="top" title="Mail" class="fa fa-envelope-o"></i>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="podcast-desc-text">
            <h4>
               <strong>@t('Description:')</strong>
            </h4>
            <p>@t('From professional Forex Trader &amp; Trading Coach Akil Stokes. Each Monday &amp; Thursday The Trading Coach Podcast shares helpful tips and inspiring stories aimed at helping aspiring Traders, Investors, and Entrepreneurs reach their goals. Voted 4th most helpful trader on Twitter and having a top 20 &nbsp; best trading 
            <a href="#">Youtube channel</a> , this podcast is yet another platform to help you through your trading journey and help you achieve your goal of becoming an independent and consistently profitable trader.&nbsp;')
            </p>
         </div>
         <div class="podcast-desc-text">
            <h4>
               <strong>@t('Subscribe!')</strong>
            </h4>
            <ul>
               <li>
                  <a href="#">
                  <img src="/frontend/assets/img/itunes-2.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="#">
                  <img src="/frontend/assets/img/googleplay-2.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="#">
                  <img src="/frontend/assets/img/stitcher-2.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="#">
                  <img src="/frontend/assets/img/spotify-2.png" alt="">
                  </a>
               </li>
               <li>
                  <a href="#">
                  <img src="/frontend/assets/img/sound3.png" alt="">
                  </a>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-md-8">
         <div class="rating-Episodes-view">
            <ul class="nav nav-tabs">
               <li>
                  <a data-toggle="tab" href="#episodes" class="active show">
                  <i class="fa fa-microphone"></i>@t(' Episodes')
                  </a>
               </li>
               <li>
                  <a data-toggle="tab" href="#ratings">
                  <i class="fa fa-star"></i>@t(' Ratings & Reviews')
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <div id="episodes" class="tab-pane fade active show">
                  <ul>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">@t('04, 2019')</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">@t('04, 2019')</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">@t('04, 2018')</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">04, 2019</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">@t('04, 2019')</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                     <li class="row">
                        <div class="date-and-formats">
                           <div class="podcast-date-box updated">
                              <span class="podcast-date">@t('28')</span>
                              <span class="podcast-month-year">@t('04, 2019')</span>
                           </div>
                           <div class="podcast-format-box">
                              <i class="fa fa-headphones"></i>
                           </div>
                        </div>
                        <div class="post-img">
                           <iframe width="100%" height="180" src="https://www.youtube.com/embed/qS9afGulHLU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="post-detail">
                           <div class="podcast-post-content post-content">
                              <h2 class="blog-shortcode-post-title">
                                 <a href="#">@t('176 – Stop Losses Are One Big Lie')</a>
                              </h2>
                              <p class="podcast-single-line-meta">
                                 <span>@t('April 28th, 2019')</span>
                              </p>
                              <div class="podcast-post-content-container">
                                 <p>@t('A discussion on using stop losses &amp; if they are helpful or hurtful for your trading. Your Trading [...]')</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 text-right pad-0">
                           <a class="readmore" href="#">@t('Read More') ></a>
                        </div>
                     </li>
                  </ul>
               </div>
               <div id="ratings" class="tab-pane fade">
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
                  <div class="rating-list">
                     <div class="rating-view">
                        <span class="star">
                           <ul>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul>
                        </span>
                        &nbsp; &nbsp;<span>@t('The BEST Coach')</span>
                     </div>
                     <p><span class="user-info">@t('by RonniePooBoo')</span></p>
                     <p class="rat-content">@t('Akil is THE ONLY reason I’ve gotten so far not only my trading career but in my professional career all together. He is by far among the best coaches out there. He is able to give his students the dry honesty they need to hear all WHILE motivating them. He always has a positive and inspirational message to offer.')</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop