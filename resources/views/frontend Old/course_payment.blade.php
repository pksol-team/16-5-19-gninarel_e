@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
   <div class="container pt-70 pb-20">
      <!-- Section Content -->
      <div class="section-content">
         <div class="row">
            <div class="col-md-12">
               <ol class="breadcrumb text-right text-black mb-0 mt-40">
                  <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>
                  <li class="active text-gray-silver">عن الأتجاه الأفضل</li>
                  <li class="active text-gray-silver">تعريف</li>
               </ol>
               <h2 class="title text-white">عن الأتجاه الأفضل</h2>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="all-books checkout">
<form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_course_payment" class="checkoutForm" style="padding:50px;">
   @csrf
   <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
   <input type="hidden" name="event_id" value="{{ $subscription->event_id }}" />
   <input type="hidden" name="subscription_id" value="{{ $subscription->id }}" />
   <input type="hidden" name="course_price" class="course_price" value="{{ $eventNative->events->price }}" />
   <div class="row">
      <div class="col-10 order-md-1">
         <div class="row">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12 mb-3">
               <label for="first_name">Event Price: <b class="course_actual_price">{{ $eventNative->events->price }}</b></label>
               <?php if ($subscription->payment_status == 'Partially Paid'): ?>
               <?php if ($subscription->discount != NULL): ?>
               <span class="d-block">Discount: {{ $subscription->discount }}%</span>
               <?php endif ?>
               <span class="d-block">Total Paid: {{ $subscription->paid }}</span>
               <?php endif ?>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12">
               <h3 class="text-dark mt-0 mb-30 font-30 heading-title-spec"><b>Payment:</b></h3>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12 mb-3">
               <?php if ($subscription->payment_status == 'Partially Paid'): ?>
               <input type="hidden" name="payment_type" value="online" />
               <?php else: ?>
               <select name="payment_type" class="form-control payment_type" id="payment_type" required>
                  <option value="" hidden>Payment way</option>
                  <option value="online">Online(Visa, Mastercard etc)</option>
                  <option value="offsite">Offsite(Wire transfer, Cash, Waiver, Scholarship etc)</option>
               </select>
               <?php endif ?>
            </div>
         </div>
         <?php if ($subscription->payment_status != 'Partially Paid'): ?>
         <div class="row" style="margin-top: 20px;">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label for="couponCode" style="width: 100%;">COUPON CODE:</label>
                  <input value="{{ old('couponCode') }}" data-event_id="{{ $eventNative->events->id }}" type="text" class="form-control couponCode" name="couponCode" style="width: 82%;display: inline-block;">
                  <button type="button" class="btn btn-success apply_code" style="display: inline-block;">Apply code</button>
                  <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                  <span class="text-danger coupen_error">Coupen expire or Invalid</span>
                  <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                  <input type="hidden" name="discount_perc" class="discount_perc" value="0" />
               </div>
            </div>
         </div>
         <?php elseif($subscription->payment_status == 'Partially Paid'): ?>
          <input value="{{ $subscription->promo_code }}" type="hidden" class="couponCode" name="couponCode">
          <input type="hidden" name="coupen_status" class="coupen_status" value="1" />
          <input type="hidden" name="discount_perc" class="discount_perc" value="{{ $subscription->discount }}" />
         <?php endif ?>
         <div class="row payment_options_dv hide">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12 mb-3">
               <?php if ($subscription->payment_status == 'Partially Paid'): ?>
               <input type="hidden" name="payment_options" value="multiple_payment" />
               <?php else: ?>
               <select name="payment_options" class="form-control payment_options" id="payment_options">
                  <option value="" hidden>Payment Options</option>
                  <?php if ($eventNative->events->payment_option == 1): ?>
                  <option value="one_payment">One Payment</option>
                  <?php elseif ($eventNative->events->payment_option == 2): ?>
                  <option value="multiple_payment">Multiple Payment</option>
                  <?php elseif ($eventNative->events->payment_option == 3): ?>
                  <option value="one_payment">One Payment</option>
                  <option value="multiple_payment">Multiple Payment</option>
                  <?php endif ?>
               </select>
               <?php endif ?>
            </div>
         </div>
         <div class="row instal_dv {{ $subscription->payment_status == 'Partially Paid' ? NULL : 'hide' }}">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12">
               <h5>Instalments: <b><span><?php echo (int)$eventNative->events->instalments; ?></span></b></h5>
               <h5>Amount: 
                  <b><span class="coupen_discount_price_">
                    <?php if ($subscription->payment_status == 'Partially Paid'): ?>
                      <?php if ($subscription->discount != NULL): ?>
                        <?php echo (($eventNative->events->price*$subscription->discount)/100) / (int)$eventNative->events->instalments; ?>
                      <?php else: ?>
                        <?php echo $eventNative->events->price/(int)$eventNative->events->instalments; ?>
                      <?php endif ?>
                    <?php else: ?>
                      <?php echo $eventNative->events->price/(int)$eventNative->events->instalments; ?>
                    <?php endif ?>
                  </span></b>
                </h5>
               <?php if ($subscription->payment_status == 'Partially Paid'): ?>
               <span>Remaining: <b><?php echo ((int)$eventNative->events->instalments - (int)$subscription->instalment_no); ?></b></span>
               <?php endif ?>
               <input type="hidden" name="instalments" class="instalments" value="{{ $eventNative->events->instalments }}" />
            </div>
            <!-- /.col-12 col-md-12 col-sm-6 col-xs-12 --> 
         </div>
         <!-- /.row -->
         <div class="row payment_detail_dv {{ $subscription->payment_status == 'Partially Paid' ? NULL : 'hide' }}">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12 mb-3">
               <!-- CREDIT CARD FORM STARTS HERE -->
               <div class="panel panel-default credit-card-box" style="padding: 15px;">
                  <div class="panel-heading display-table" style="background-color: #213b40;">
                     <div class="row">
                        <div class="col-6 text-left">
                           <h3 class="panel-title display-td" style="padding: 0px 15px; color: #fff;">Payment Details</h3>
                        </div>
                        <!-- /.col-6 -->
                        <div class="col-6 text-right" style="padding: 0px 15px;"><img class="img-responsive float-right" src="/frontend/assets/img/accepted_c22e0.png"></div>
                        <!-- /.col-6 -->
                     </div>
                  </div>
                  <div class="panel-body p-3">
                     <div class="row">
                        <div class="col-12 col-md-12 col-sm-6 col-xs-12">
                           <div class="form-group">
                              <label for="cardNumber">CARD NUMBER</label>
                              <div class="input-group">
                                 <input
                                    value="{{ old('cardNumber') }}"
                                    type="tel"
                                    class="form-control"
                                    name="cardNumber"
                                    placeholder="Valid Card Number"
                                    autocomplete="cc-number" autofocus
                                    />
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-7 col-md-7 col-lg-7">
                              <div class="form-group">
                                 <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                 <input
                                    value="{{ old('cardExpiry') }}"
                                    type="tel"
                                    class="form-control"
                                    name="cardExpiry"
                                    placeholder="MM / YY"
                                    autocomplete="cc-exp"
                                    />
                              </div>
                           </div>
                           <div class="col-5 col-md-5 col-lg-5 float-right">
                              <div class="form-group">
                                 <label for="cardCVC">CV CODE</label>
                                 <input
                                    value="{{ old('cardCVC') }}"
                                    type="tel"
                                    class="form-control"
                                    name="cardCVC"
                                    placeholder="CVC"
                                    autocomplete="cc-csc"
                                    />
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- CREDIT CARD FORM ENDS HERE -->
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 col-md-12 col-sm-6 col-xs-12 mb-3 text-left">
               <button class="btn submmit btn btn-dark btn-xl btn-blue mt-10" type="submit">Proceed</button>
            </div>
         </div>
      </div>
</form>
</div>

  @push('scripts')
  <script>
    $(document).ready(function() {
      $(".payment_type").change(function() {
        var $this = $(this),
          paymentType = $this.val();

        if (paymentType == 'online') {
          $('.payment_options_dv').removeClass('hide');
          $('.payment_options_dv select').attr('required', '1');
        } else {

          $('.course_price').val('{{ $eventNative->events->price }}');
          $('.payment_options_dv').addClass('hide');
          $('.payment_detail_dv').addClass('hide');
          $('.payment_options_dv select').removeAttr('required');
          $('.instal_dv').addClass('hide');
          $(".payment_options").removeAttr("selected");
        }
      });

      $(".payment_options").change(function() {
        var $this = $(this),
        paymentType = $this.val();

        if (paymentType == 'one_payment' || paymentType == 'multiple_payment') {
          if (paymentType == 'multiple_payment') {
            $('.instal_dv').removeClass('hide');
            // $('.course_price').val('{{ $eventNative->events->price / $eventNative->events->instalments }}');

          } else {
            $('.course_price').val('{{ $eventNative->events->price }}');
            $('.instal_dv').addClass('hide');
          }

          $('.payment_detail_dv').removeClass('hide');
          $('.payment_detail_dv input[name!=couponCode]').attr('required', '1');
        } else {
          $('.payment_detail_dv').addClass('hide');
          $('.payment_detail_dv input[name!=couponCode]').removeAttr('required');
          $('.course_price').val('{{ $eventNative->events->price }}');
        }

      });

      $('.apply_code').on('click', function(e) {

        e.preventDefault();
        var $this = $('.couponCode'),
            coupenCode = $this.val(),
            object_id = $this.attr('data-event_id'),
            object_type = '7',
            paymentType = $(".payment_options").val();

            if (coupenCode != '') {

              $('.loader_coupen').css('display', 'block');

              $.ajax({
                    type: 'POST',
                    url: '{{ lang_url("coupenCheck") }}',
                    data: {"_token": "{{ csrf_token() }}", 'object_type':object_type,'coupenCode':coupenCode, 'object_id':object_id},
                })
                .done(function(response) {
                    $('.loader_coupen').css('display', 'none');


                  if (response == '0') {
                    $('.coupen_error').css('display', 'inline-block');
                    $('.coupen_status').val('0');
                    $('.discount_perc').val('0');
                    $('.course_price').val('{{ $eventNative->events->price }}');
                    $('.coupen_discount_price_').text('{{ $eventNative->events->price / $eventNative->events->instalments }}');
                    // if (paymentType == 'multiple_payment') {
                    //   $('.course_price').val('{{ $eventNative->events->price / $eventNative->events->instalments }}');
                    // }


                  } else {
                    $('.coupen_error').hide();
                    $('.coupen_discount_price_').text(response['discountedPrice'] / response['instalments']);
                    $('.course_price').val(response['discountedPrice']);
                    $('.coupen_status').val('1');
                    $('.discount_perc').val(response['discount']);
                    // if (paymentType == 'multiple_payment') {
                    //   $('.course_price').val(response['discountedPrice'] / + response['instalments']);
                    // }
                  }

                });

            } else {

              $('.loader_coupen').css('display', 'none');
              $('.coupen_error').hide();
              $('.course_price').val('{{ $eventNative->events->price }}');
              $('.coupen_discount_price_').text('{{ $eventNative->events->price / $eventNative->events->instalments }}');
              // if (paymentType == 'multiple_payment') {
              //   $('.course_price').val('{{ $eventNative->events->price / $eventNative->events->instalments }}');
              // }
            }
        
      });
    });
  </script>
  @endpush
  @stop