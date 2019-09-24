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
                     <li><a href="{{ lang_url('') }}">@t('the main page')</a></li>
                     <li class="active text-gray-silver">@t('call us')</li>
                  </ol>
                  <h2 class="title text-white">@t('call us')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: Contact -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 rtl">
            <div class="col-md-8 col-sm-12">
               <p class="mb-0 color-dark-green font-18">@t('We are happy to contact you via the form below or contact us on the following email')</p>
               <p class="mb-0 color-dark-green font-18">support@bettertrend.net</p>
               <p class="mb-40 color-dark-green font-18">@t('Or Phone: 052343567')</p>
               <!-- contact Form -->
               <form id="contact" name="contact" class="form-inline" action="{{ lang_url('contact_us_email') }}" method="post">
                  @csrf
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
                  <div class="row">
                     <div class="col-md-12 col-sm-12">
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="first_name">@t('First name')  </label>
                              <input id="first_name" class="form-control" placeholder="@t('First name') " aria-required="true" type="text" name="first_name" required>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="last_name">@t('A nickname')</label>
                              <input id="last_name"  class="form-control" type="text" placeholder="@t('A nickname')" aria-required="true" name="last_name" required>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="mobile_Number">@t('Mobile Phone Number') </label>
                              <input class="form-control" type="text" placeholder="@t('Mobile Phone Number') " id="mobile_Number" name="mobile_Number" required>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="subject">@t('Type of message')</label>
                              <select name="subject" id="subject" class="form-control" required="required">
                                 <option value="" hidden>@t('Subject')</option>
                                 <option value="Technical support">@t('Technical Support')</option>
                                 <option value="Sales">@t('Sales')</option>
                                 <option value="Complaint">@t('Complaint') </option>
                                 <option value="Suggestions">@t('Suggestions')</option>
                                 <option value="Special">@t('Special')</option>
                                 <option value="request">@t('Request')</option>
                                 <option value="others">@t('Others')</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="email">@t('An email address')</label>
                              <input id="email"  class="form-control" placeholder="@t('An email address')" aria-required="true" type="email" name="email" required>
                           </div>
                        </div>
                        <div class="col-sm-12 p-0">
                           <div class="form-group mb-30">
                              <label for="summernote">@t('additional information')</label>
                              <textarea id="summernote" class="form-control" name="message" rows="10" cols="5" placeholder="@t('Message')" required></textarea>
                           </div>
                        </div>
                        <div class="form-group form-group-center text-center mb-30 mt-20">
                           <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">@t('send')</button>
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
