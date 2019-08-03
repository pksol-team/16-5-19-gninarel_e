@extends('frontend.template.layout')

@section('title') <?= $title; ?> @stop

@section('content')


  
  <!-- Start main-content -->
  <div class="main-content">
       <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb text-right text-black mb-0 mt-40">
                    <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>
                    <li><a href="{{ lang_url('events') }}">تقويم الأحداث </a></li>
                    <li class="active text-gray-silver">تفاصيل الحدث</li>
                </ol>
                <h2 class="title text-white">{{ $eventNative->name }}</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
      
    

    <section class="bg-theme-colored">
      <div class="container pt-40 pb-40">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 id="basic-coupon-clock" class="text-white"></h2>
            <!-- Final Countdown Timer Script -->
            <script type="text/javascript">
              $(document).ready(function() {
                $('#basic-coupon-clock').countdown('2020/10/10', function(event) {
                  $(this).html(event.strftime('%D days %H:%M:%S'));
                });
              });
            </script>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <ul>
              <li>
                <h5>Title:</h5>
                <p>{{ $eventNative->name }}</p>
              </li>
              <li>
                <h5>Classification:</h5>
                <p>{{ $eventNative->events->classification }}.</p>
              </li>
              <li>
                <h5>Location:</h5>
                <p>{{ $eventNative->events->description }}</p>
              </li>
              <li>
                <h5>Start Date:</h5>
                <p>{{ $eventNative->events->start_date }}</p>
              </li>
              <!-- <li>
                <h5>End Date:</h5>
                <p>February 10, 2016</p>
              </li> -->
              <!-- <li>
                <h5>Website:</h5>
                <p>kodesolution.com</p>
              </li> -->
              <li>
                <h5>Share:</h5>
                <div class="styled-icons icon-sm icon-gray icon-circled">
                  <a target="_blank" href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
                  <a target="_blank" href="https://www.twiter.com"><i class="fa fa-twitter"></i></a>
                  <a target="_blank" href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
                  <a target="_blank" href="https://www.google.com"><i class="fa fa-google-plus"></i></a>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-md-8">
            <!-- <div class="owl-carousel-1col" data-nav="true"> -->
              <div class="item"><img src="\storage\{{ $eventNative->image }}" alt=""></div>
              <!-- <div class="item"><img src="https://placehold.it/755x480" alt=""></div> -->
              <!-- <div class="item"><img src="https://placehold.it/755x480" alt=""></div>
              <div class="item"><img src="https://placehold.it/755x480" alt=""></div>
              <div class="item"><img src="https://placehold.it/755x480" alt=""></div> -->
            <!-- </div> -->
          </div>
        </div>
        <div class="row mt-60">
          <div class="col-md-12">
            <h4 class="mt-0">Event Description</h4>
            <p>{{ $eventNative->description }}</p>
          </div>
        </div>
        <!-- <div class="row mt-40">
          <div class="col-md-12">
            <h4 class="mb-20">Keynote Speakers</h4>
            <div class="owl-carousel-6col" data-nav="true">
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Businessman</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Businessman</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/user-img.png" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </section>

    <!-- Section: Registration Form -->
    <section class="divider parallax bg-lighter">
      <div class="container-fluid">
        <div class="section-title">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <h3 class="title text-theme-colored">Registration Form</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form id="booking-form" name="booking-form" action="includes/event-register.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Name" name="register_name" required="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Email" name="register_email" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Phone" name="register_phone" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ticket types</label>
                    <select name="ticket_type" class="form-control">
                      <option>One Person</option>
                      <option>Two Person</option>
                      <option>Family Pack</option>
                      <option>Premium</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Event types</label>
                    <select name="event_type" class="form-control">
                      <option>Event 1</option>
                      <option>Event 2</option>
                      <option>Event 3</option>
                      <option>All package</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group text-center">
                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button data-loading-text="Please wait..." class="btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10" type="submit">Register now</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
  @stop
  