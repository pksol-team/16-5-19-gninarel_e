@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<div class="main-top-title">
  <a href="#" class="resp-menu" onclick="openNav()">☰</a>
  <div class="row">
    <div class="col-12">
      <div class="our_logo text-center">
        <a href="/"><img src="/frontend/assets/img/logo21.png" alt="" class="logo_black"></a>
        <h4 class="text-center"><span>Enroll in Course: {{ $courseNative->name }}</span></h4>
        <a href="{{ Auth::check() ? lang_url('profile') : lang_url('userlogin') }}"><button class="btn btn-success btn-lg">{{ Auth::check() ? Auth::user()->name : t('Login') }}</button></a>
      </div>
    </div>
  </div>
</div>
<div class="all-books checkout">
  <form name="checkoutForm" id="checkoutForm" method="POST" action="{{ lang_url('') }}/enroll_course_payment" class="checkoutForm">
    @csrf
    <input type="hidden" class="user_id" name="user_id" value="{{ Auth::check() ? Auth::user()->id : NULL }}" />
    <input type="hidden" name="course_id" value="{{ $subscription->course_id }}" />
    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}" />
    <input type="hidden" name="course_price" class="course_price" value="{{ $courseNative->courses->price}}" />
    <div class="row">
      <div class="col-10 order-md-1">
        <div class="row">
          <div class="col-12 mb-3">
            <label for="first_name">Course Price: <b class="course_actual_price">{{ $courseNative->courses->price }}</b></label>
            <?php if ($subscription->payment_status == 'Partially Paid'): ?>
              <?php if ($subscription->discount != NULL): ?>
                <span class="d-block">Discount: {{ $subscription->discount }}%</span>
              <?php endif ?>
              <span class="d-block">Total Paid: {{ $subscription->paid }}</span>
            <?php endif ?>
          </div>
        </div>
        <div class="row"><div class="col-12"><h3 class="text-dark"><b>Payment:</b></h3></div></div>
        <div class="row">
          <div class="col-12 mb-3">
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

        <div class="row payment_options_dv d-none">
          <div class="col-12 mb-3">
            <?php if ($subscription->payment_status == 'Partially Paid'): ?>
              <input type="hidden" name="payment_options" value="multiple_payment" />
            <?php else: ?>
              <select name="payment_options" class="form-control payment_options" id="payment_options">
                <option value="" hidden>Payment Options</option>
                <?php if ($courseNative->courses->payment_option == 1): ?>
                  <option value="one_payment">One Payment</option>
                <?php elseif ($courseNative->courses->payment_option == 2): ?>
                  <option value="multiple_payment">Multiple Payment</option>
                <?php elseif ($courseNative->courses->payment_option == 3): ?>
                  <option value="one_payment">One Payment</option>
                  <option value="multiple_payment">Multiple Payment</option>
                <?php endif ?>
              </select>
            <?php endif ?>
          </div>
        </div>
      <div class="row instal_dv {{ $subscription->payment_status == 'Partially Paid' ? NULL : 'd-none' }}">
       <div class="col-12">
         <h5>Instalments: <b><span><?php echo (int)$courseNative->courses->instalments; ?></span></b></h5>
         <?php if ($subscription->payment_status == 'Partially Paid'): ?>
           <span>Remaining: <b><?php echo ((int)$courseNative->courses->instalments - (int)$subscription->instalment_no); ?></b></span>
         <?php endif ?>
          <input type="hidden" name="instalments" class="instalments" value="{{ $courseNative->courses->instalments }}" />
       </div><!-- /.col-12 --> 
      </div><!-- /.row -->
       
      <div class="row payment_detail_dv {{ $subscription->payment_status == 'Partially Paid' ? NULL : 'd-none' }}">
        <div class="col-12 mb-3">
          <!-- CREDIT CARD FORM STARTS HERE -->
          <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" >
              <div class="row">
                <div class="col-6 text-left"><h3 class="panel-title display-td">Payment Details</h3></div><!-- /.col-6 -->
                <div class="col-6 text-right"><img class="img-responsive float-right" src="/frontend/assets/img/accepted_c22e0.png"></div><!-- /.col-6 -->
              </div>
            </div>
            <div class="panel-body p-3">
                <div class="row">
                  <div class="col-12">
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
                  <div class="col-7">
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
                  <div class="col-5 float-right">
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
                <?php if ($subscription->payment_status != 'Partially Paid'): ?>
                  
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="couponCode">COUPON CODE</label>
                        <input value="{{ old('couponCode') }}" data-course_id="{{ $courseNative->courses->id }}" type="text" class="form-control couponCode" name="couponCode" />
                        <img src="\public\loading.gif" class="loader_coupen mr-1 ml-1">
                        <span class="text-danger coupen_error">Coupen expire or Invalid</span>
                        <div class="coupen_discount_price_dv">Discount Price: <span class="w-100 text-success coupen_discount_price">123434</span></div>
                        <input type="hidden" name="coupen_status" class="coupen_status" value="0" />
                        <input type="hidden" name="discount_perc" class="discount_perc" value="0" />

                      </div>
                    </div>
                  </div>

                <?php endif ?>
            </div>
          </div>
          <!-- CREDIT CARD FORM ENDS HERE -->
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-12 mb-3 text-left">
          <button class="btn submmit" type="submit">Proceed</button>
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
          $('.payment_options_dv').removeClass('d-none');
          $('.payment_options_dv select').attr('required', '1');
        } else {
          $('.payment_options_dv').addClass('d-none');
          $('.payment_detail_dv').addClass('d-none');
          $('.payment_options_dv select').removeAttr('required');
          $('.instal_dv').addClass('d-none');
          $(".payment_options").removeAttr("selected");
        }
      });

      $(".payment_options").change(function() {
        var $this = $(this),
        paymentType = $this.val();

        if (paymentType == 'one_payment' || paymentType == 'multiple_payment') {
          if (paymentType == 'multiple_payment') {
            $('.instal_dv').removeClass('d-none');
          } else {
            $('.instal_dv').addClass('d-none');
          }

          $('.payment_detail_dv').removeClass('d-none');
          $('.payment_detail_dv input[name!=couponCode]').attr('required', '1');
        } else {
          $('.payment_detail_dv').addClass('d-none');
          $('.payment_detail_dv input[name!=couponCode]').removeAttr('required');
        }

      });

      $('.couponCode').on('focusout', function(e) {
        e.preventDefault();
        var $this = $(this),
            coupenCode = $this.val(),
            user_id = $('.user_id').val(),
            object_id = $this.attr('data-course_id'),
            object_type = 'course';

            if (coupenCode != '') {

              $('.loader_coupen').show();

              $.ajax({
                    type: 'POST',
                    url: '{{ lang_url("coupenCheck") }}',
                    data: {"_token": "{{ csrf_token() }}", 'object_type':object_type, 'user_id':user_id, 'coupenCode':coupenCode, 'object_id':object_id},
                })
                .done(function(response) {
                    $('.loader_coupen').hide();

                  if (response == '0') {
                    $('.coupen_error').show();
                    $('.coupen_discount_price_dv').hide();
                    $('.course_price').val($('.course_actual_price').text());
                    $('.coupen_status').val('0');
                    $('.discount_perc').val('0');

                  } else {
                    $('.coupen_error').hide();
                    $('.coupen_discount_price').text(response['discountedPrice']);
                    $('.course_price').val(response['discountedPrice']);
                    $('.coupen_discount_price_dv').show();
                    $('.coupen_status').val('1');
                    $('.discount_perc').val(response['discount']);
                  }

                });


            } else {

              $('.loader_coupen').hide();
              $('.coupen_error').hide();
              $('.course_price').val($('.course_actual_price').text());
              $('.coupen_discount_price').text($('.course_actual_price').text());
              $('.coupen_discount_price_dv').hide();

            }
        
      });
    });
  </script>
  @endpush
  @stop