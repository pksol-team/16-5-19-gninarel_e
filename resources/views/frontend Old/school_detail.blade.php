<?php 
   use App\Course;
   use App\ChaptersNative;
   use App\VideoNative;
   use App\User_access;
   use App\TestResult;
   use App\Exams;

?>
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

                    <li><a href="{{ lang_url('') }}">الصفحة الرئيسية</a></li>

                    <li class="active text-gray-silver">الاشتراكات الرئيسية </li>

                    <li class="active text-gray-silver">المدارس الالكترونية </li>

                </ol>

                <h2 class="title text-white">مدرسة MAY</h2>

            </div>

          </div>

        </div>

      </div>

    </section>

      

    

    <section class="divider bg-white">

      <div class="container pt-150">

            <div class="row">

              <div class="col-md-3 col-sm-3 col-xs-12">

                <div class="vertical-tab">

                  <ul class="nav nav-tabs">

                    <li class=""><a href="{{ lang_url('profile') }}"><img src="/frontend/_assets/images/icon-1.png" class="img-responsive" alt="icon-1"/> الملف الشخصي </a></li>

                    <li><a href="{{ lang_url('all_purchases') }}"><img src="/frontend/_assets/images/icon-2.png" class="img-responsive" alt="icon-2"/> مشترياتي</a></li>

                    <li><a href="{{ lang_url('all_subscriptions') }}"><img src="/frontend/_assets/images/icon-3.png" class="img-responsive" alt="icon-3"/> باقاتي</a></li>

                    <li class="active"><a href="{{ lang_url('schools') }}"><img src="/frontend/_assets/images/icon-4.png" class="img-responsive" alt="icon-4"/> المدرسة  الالكترونية</a></li>

                    <li><a href="{{ lang_url('training_activities') }}"><img src="/frontend/_assets/images/icon-5.png" class="img-responsive" alt="icon-5"/> الانشطة التدريبة</a></li>

                    <li><a href="{{ lang_url('communication') }}"><img src="/frontend/_assets/images/icon-6.png" class="img-responsive" alt="icon-6"/> التواصل </a></li>

                    <li><a href="{{ lang_url('logout_frontend') }}"><img src="/frontend/_assets/images/icon-7.png" class="img-responsive" alt="icon-7"/> خروج</a></li>

                  </ul>

                </div>

              </div>

              <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="tab-content">

                  <div class="tab-pane fade" id="tab1">

                    <div class="row">

                        <div class="col-md-8 col-md-offset-2">

                            <!-- profile Form -->

                            <form id="profile_form" name="profile_form" class="form-inline" action="" method="post">

                          <div class="row">

                              <div class="col-md-10 col-sm-12 col-md-offset-1">

                                    <div class="col-sm-12 p-0">

                                        <div class="avatar-upload">

                                            <div class="avatar-edit">

                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />

                                                <label for="imageUpload"></label>

                                            </div>

                                            <div class="avatar-preview">

                                                <div id="imagePreview" style="background-image: url(images/user_pic.png)">

                                                </div>

                                            </div>

                                            <h4 class="text-center">تغير الصورة</h4>

                                        </div>

                                    </div> 

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="name">الاسم</label>

                                        <input id="name" name="name" class="form-control" type="text" placeholder="خالد عبد العزيز" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="email">البريد الألكتروني</label>

                                        <input id="email" name="email" class="form-control" type="email" placeholder="البريد الألكتروني" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="password"> الرقم السري</label>

                                        <input id="password" name="password" class="form-control" type="password" placeholder=" الرقم السري" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="mobile">رقم الجوال</label>

                                        <input id="mobile" name="mobile" class="form-control" type="text" placeholder="رقم الجوال" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="gender">الجنس </label>

                                        <select class="form-control" id="gender"> 

                                            <option>ذكر</option> 

                                            <option>أنثي</option> 

                                          </select>

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="age">العمر</label>

                                        <input id="age" name="age" class="form-control" type="text" placeholder="العمر" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="col-sm-12 p-0">

                                      <div class="form-group mb-30">

                                        <label for="field">التخصص</label>

                                        <input id="field" name="field" class="form-control" type="text" placeholder="التخصص" required="" aria-required="true">

                                      </div>

                                    </div>

                                    <div class="form-group form-group-center text-center mb-30 mt-20">

                                        <input name="form_botcheck" class="form-control" type="hidden" value="">

                                        <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">حفظ</button>

                                    </div>

                              </div>

                          </div>

                        </form>

                        </div>

                    </div>

                  </div>

                  <div class="tab-pane fade" id="tab2"> 

                     <div class="row mb-30">

                          <div class="col-md-12">   

                              <a href="products.html" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i> إستعراض المنتجات </a>

                          </div> 

                     </div>  

                     <div class="row">

                         <div class="col-md-12">

                             <div class="table-responsive table-condensed">

                                  <table class="table  sub-table">

                                         <thead> 

                                             <tr> 

                                                 <th>تاريخ الشراء</th>

                                                 <th>المنتج</th>

                                                 <th>المبلغ</th>

                                                 <th></th>

                                             </tr>

                                         </thead>

                                         <tbody>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">اسم الاشتراك </td>

                                                 <td class="color-dark-green">85</td>

                                                 <td>

                                                     <a href="packages.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                         </tbody> 

                                  </table>

                             </div>

                         </div>

                     </div>  

                  </div> 

                  <div class="tab-pane fade" id="tab3"> 

                     <div class="row mb-30">

                          <div class="col-md-12">   

                              <a href="packages.html" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i> إستعراض الباقات</a>

                          </div> 

                     </div>  

                     <div class="row">

                         <div class="col-md-12">

                             <div class="table-responsive table-condensed">

                                  <table class="table  sub-table">

                                         <thead> 

                                             <tr> 

                                                 <th>تاريخ الاشتراك</th>

                                                 <th>تاريخ الانتهاء</th>

                                                 <th>اسم الباقة</th>

                                                 <th>المبلغ</th>

                                                 <th>حالة العرض</th>

                                             </tr>

                                         </thead>

                                         <tbody>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-theme-green">الباقة 1</td>

                                                 <td class="color-dark-green">85</td>

                                                 <td class="color-theme-green font-weight-600">فعالة</td>

                                             </tr>

                                         </tbody> 

                                  </table>

                             </div>

                         </div>

                     </div>  

                  </div> 

                  <div class="tab-pane fade in active" id="tab4"> 

                     <div class="row mb-30">

                         <h4 class="color-theme-green mt-0 mb-30 font-weight-600 font-18">تفاصيل المدرسة</h4>

                         <div class="col-md-12">

                             <div class="table-responsive table-condensed">

                                  <table class="table sub-table">

                                         <tbody>

                                             <tr> 

                                                 <td class="color-dark-green">اسم المدرسة</td>

                                                 <td class="half-gray">{{ $schoolNative->name }} </td>

                                                 <!-- <td class="color-dark-green">عنوان الوظيفة</td>

                                                 <td class="half-gray">عنوان الوظيفة</td>

                                                 <td class="color-dark-green">عنوان الوظيفة </td>

                                                 <td class="half-gray">عنوان الوظيفة  </td> -->

                                             </tr>

                                             <tr> 

                                                 <td class="color-dark-green">وصف المدرسة:  </td>

                                                 <td class="half-gray"> {{ $schoolNative->description }}  </td>

                                                 <!-- <td class="color-dark-green">المدينة</td>

                                                 <td class="half-gray">الرياض</td>

                                                 <td class="color-dark-green">المدينة</td>

                                                 <td class="half-gray">الرياض</td>
 -->
                                             </tr>

                                         </tbody> 

                                  </table>

                             </div>

                         </div>   

                     </div>  

                     <div class="row">

                         <h4 class="color-theme-green mt-0 mb-30 font-weight-600 font-18">الدورات</h4>
                         <?php if (count($courseNative) > 0): ?>
                            <?php foreach ($courseNative as $key => $courses): ?>
                         <div class="col-md-12 course-container">

                             <article class="post media-post clearfix pb-0 mb-10">

                                <img src="\public\storage\{{ $courses->image }}" class="pull-right ml-20" alt="" alt="{{ $schoolNative->name }}">

                                <div class="post-right">

                                  <h4 class="post-title mt-0 color-dark-green">{{ $courses->name }}</h4>

                                  <p>{{ $courses->description }}</p>

                                </div>

                             </article>

                             <div class="table-responsive table-condensed">

                                  <table class="table  sub-table">

                                         <thead> 

                                             <tr> 

                                                 <th>رقم الدرس</th>

                                                 <th>عنوان الدرس</th>

                                                 <th>عدد ساعات الدرس</th>

                                                 <th>الحالة </th>

                                                 <th>حالة الاختبار</th>

                                                 <th></th>

                                             </tr>

                                         </thead>

                                         <tbody>
                                            <?php 
                                               $course_id = $courses->courses->id;
                                               $chapterNative = ChaptersNative::with('chapters')->whereHas('chapters', function ($query) use ($course_id) {
                                                  $query->where('course_id', $course_id);
                                               })->where([['lang', Request::locale()], ['status', 'active']])->get();
                                             ?>
                                            <?php if (count($chapterNative) > 0): ?>
                                                <?php $last_watched = NULL;  ?>
                                               <?php foreach ($chapterNative as $key => $chapter): ?>
                                             <tr>

                                                 <td class="half-gray">{{ $key+1 }}</td>

                                                 <td class="color-theme-green">{{ $chapter->name }} </td>

                                                 <td class="color-dark-green">2</td>

                                                 <td class="color-dark-green"> <?php 
                                                $watched = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $chapter->chapters->id], ['status', 'completed']])->first();

                                                $haveExam = Exams::where([['chapter_id', $chapter->id], ['status', 'active']])->first();
                                                
                                                $testTaken = User_access::where([['user_id', Auth::user()->id], ['object_type', 'test'], ['object_id', $chapter->id], ['status', 'Passed']])->first();
                                                if ($watched) {
                                                  if ($haveExam) {
                                                    if ($testTaken) {
                                                      echo 'Watched';
                                                      $last_watched = 1;
                                                    } else {
                                                      echo 'In Progress';
                                                    }

                                                  } else {
                                                    echo 'Watched';
                                                    $last_watched = 1;
                                                  }
                                                  

                                                } else {

                                                  if ($last_watched === 1) {
                                                    echo 'In Progress';
                                                    $last_watched = NULL;
                                                  } else {
                                                    if ($key == 0) {
                                                      echo 'In Progress';
                                                    } else {
                                                      echo 'Not Watched';
                                                    }
                                                  }
                                                }
                                               ?> </td>

                                               <td class="color-dark-green"><?php 
                                                $chapter_native_id = $chapter->id;
                                                $testTaken = TestResult::with('exam')->whereHas('exam', function ($query) use ($chapter_native_id) {
                                                  $query->where('chapter_id', $chapter_native_id);
                                                })->where([['user_id', Auth::user()->id]])->orderBy('percentage', 'DESC')->first();

                                              ?>
                                              <?php if ($testTaken): ?>
                                                <span class="{{ $testTaken->result == 'Passed' ? 'text-success': 'text-danger' }}">{{ $testTaken->result }}</span>
                                              <?php else: ?>
                                                <span class="text-dark">Not taken</span>
                                              <?php endif ?>
                                            </td>
                                            <?php if ($key == 0): ?>
                                              <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>
                                            <?php else: ?>

                                              <?php 
                                                $videoNative = User_access::where([['user_id', Auth::user()->id], ['object_type', 'chapter'], ['object_id', $last_chapter_id], ['status', 'completed']])->first();
                                              ?>

                                              <?php if ($videoNative): ?>

                                                <?php 
                                                  //check exam min pass is 0 or not if 0 then next chapter opens without attempting test
                                                  $checkMinPass = Exams::where([['chapter_id', $last_chapter_Native_id], ['status', 'active']])->first(); ?>

                                                  <?php if ($checkMinPass): ?>

                                                    <?php if ($checkMinPass->min_pass == '0'): ?>

                                                      <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>

                                                    <?php else: ?>

                                                       <?php $userPassed = User_access::where([['user_id', Auth::user()->id], ['object_type', 'test'], ['object_id', $last_chapter_Native_id], ['status', 'Passed']])->first();
                                                      ?>

                                                      <?php if ($userPassed): ?>

                                                 <td>

                                                     <a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                                           <?php else: ?>

                                                            <td><button class="btn btn-default" disabled> View Details</button></td>

                                                           <?php endif ?>

                                                         <?php endif ?>

                                                       <?php else: ?>

                                                         <td><a href="{{ lang_url('chapters/'.$chapter->chapters->id.'/view') }}"><button class="btn btn-default"> View Details</button></a></td>

                                                       <?php endif ?>

                                                   <?php else: ?>

                                                      <td><button class="btn btn-default" disabled> View Details</button></td>

                                                   <?php endif ?>

                                                 <?php endif ?>

                                             </tr>
                                               <?php $last_chapter_id = $chapter->chapter_id; ?>
                                               <?php $last_chapter_Native_id = $chapter->id; ?>

                                                <?php  endforeach ?>
                                             <?php endif ?>
                                         </tbody> 

                                  </table>

                             </div>

                         </div>

                        
                            <?php endforeach ?>
                         <?php else: ?>
                             <div class="col-md-12 course-container">

                             <article class="post media-post clearfix pb-0 mb-10">

                               
                                <div class="post-right">

                                  <h4 class="post-title mt-0 color-dark-green">No Courses Found!</h4>


                                </div>

                             </article>

                         </div>
                         <?php endif ?>
                     </div>   

                  </div> 

                  <div class="tab-pane fade" id="tab5"> 

                     <div class="row mb-30">

                          <div class="col-md-12">   

                              <a href="online-schools.html" class="btn btn-dark btn-xl btn-blue pull-left"><i class="fa fa-plus ml-10"></i>إستعراض الأنشطة </a>

                          </div> 

                     </div>  

                     <div class="row">

                         <div class="col-md-12">

                             <div class="table-responsive table-condensed">

                                  <table class="table  sub-table">

                                         <thead> 

                                             <tr> 

                                                 <th>تاريخ الاشتراك</th>

                                                 <th>نوع النشاط</th>

                                                 <th>تصنيف النشاط</th>

                                                 <th>عنوان النشاط </th>

                                                 <th>المكان </th>

                                                 <th>تاريخ النشاط</th>

                                                 <th>المدة </th>

                                                 <th>المبلغ</th>

                                                 <th>الاجمالي</th>

                                                 <th>الدفع </th>

                                                 <th>العدد </th>

                                                 <th>الحالة  </th>

                                                 <th>  </th>

                                             </tr>

                                         </thead>

                                         <tbody>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">دورة </td>

                                                 <td class="color-dark-green">اونلاين </td>

                                                 <td class="color-theme-green">احتراف التداول 1</td>

                                                 <td class="half-gray">online</td>

                                                 <td class="half-gray">22/1/2019</td>

                                                 <td class="color-dark-green">88 </td>

                                                 <td class="color-dark-green">1500 ريال </td>

                                                 <td class="color-dark-green">2000 ريال </td>

                                                 <td class="half-gray">2500 ريال</td>

                                                 <td class="color-dark-green">12</td>

                                                 <td class="color-dark-green">انتهت</td>

                                                 <td>

                                                     <a href="course-details.html" class="btn btn-default btn-lg blue">عرض التفاصيل</a>

                                                 </td>

                                             </tr>

                                             

                                         </tbody> 

                                  </table>

                             </div>

                         </div>

                     </div>  

                  </div>    

                  <div class="tab-pane fade" id="tab6">

                      <div class="row">

                          <div class="col-md-12">

                              <!-- contact Form -->

                                <form id="contact" name="contact" class="form-inline" action="" method="post" novalidate="novalidate">

                                  <div class="row">

                                      <div class="col-md-12 col-sm-12">

                                            <div class="col-sm-12 p-0">

                                              <div class="form-group mb-30">

                                                <label for="msg_title">عنوان الرسالة</label>

                                                <input id="msg_title" name="msg_title" class="form-control" type="text" placeholder="عنوان الرسالة" required="" aria-required="true">

                                              </div>

                                            </div>

                                            <div class="col-sm-12 p-0">

                                              <div class="form-group mb-30">

                                                <label for="msg_type">نوع الرسالة </label>

                                                <select class="form-control" id="msg_type"> 

                                                    <option>-- حدد نوع الرسالة --</option> 

                                                    <option>2</option> 

                                                    <option>3</option> 

                                                    <option>4</option> 

                                                    <option>5</option> 

                                                  </select>

                                              </div>

                                            </div>

                                            <div class="col-sm-12 p-0">

                                              <div class="form-group mb-30">

                                                <label for="msg_type">المدرب</label>

                                                <select class="form-control" id="msg_type"> 

                                                    <option>-- أختر المدرب --</option> 

                                                    <option>2</option> 

                                                    <option>3</option> 

                                                    <option>4</option> 

                                                    <option>5</option> 

                                                  </select>

                                              </div>

                                            </div>

                                            <div class="col-sm-12 p-0">

                                              <div class="form-group mb-30">

                                                <label for="more_details" style="width: 100% !important;">الرسالة</label>

                                                <div class="editor" id="editor-2">

                                                  <div class="toolbar">

                                                    <a href="#" data-command='undo' data-toggle="tooltip" data-placement="top" title="Undo"><i class='fa fa-undo'></i></a>

                                                    <a href="#" data-command='redo' data-toggle="tooltip" data-placement="top" title="Redo"><i class='fa fa-undo icon-flipped '></i></a>

                                                            <a href="#" data-command='removeFormat' data-toggle="tooltip" data-placement="top" title="Clear format"><i class='fa fa-times '></i></a>

                                                    <div class="fore-wrapper"><i class='fa fa-font' data-toggle="tooltip" data-placement="top" title="text color" style='color:#C96;'></i>

                                                      <div class="fore-palette">

                                                      </div>

                                                    </div>

                                                    <div class="back-wrapper"><i class='fa fa-font'  data-toggle="tooltip" data-placement="top" title="Background color" style='background:#C96;'></i>

                                                      <div class="back-palette">

                                                      </div>

                                                    </div>

                                                    <a href="#" data-command='bold' data-toggle="tooltip" data-placement="top" title="Bold"><i class='fa fa-bold'></i></a>

                                                    <a href="#" data-command='italic' data-toggle="tooltip" data-placement="top" title="Italic"><i class='fa fa-italic'></i></a>

                                                    <a href="#" data-command='underline' data-toggle="tooltip" data-placement="top" title="Underline"><i class='fa fa-underline'></i></a>

                                                    <a href="#" data-command='strikeThrough' data-toggle="tooltip" data-placement="top" title="Stike through"><i class='fa fa-strikethrough'></i></a>

                                                    <a href="#" data-command='justifyLeft' data-toggle="tooltip" data-placement="top" title="Left align"><i class='fa fa-align-left'></i></a>

                                                    <a href="#" data-command='justifyCenter'><i class='fa fa-align-center' data-toggle="tooltip" data-placement="top" title="Center align"></i></a>

                                                    <a href="#" data-command='justifyRight' data-toggle="tooltip" data-placement="top" title="Right align"><i class='fa fa-align-right'></i></a>

                                                    <a href="#" data-command='justifyFull' data-toggle="tooltip" data-placement="top" title="Justify"><i class='fa fa-align-justify'></i></a>

                                                    <a href="#" data-command='indent' data-toggle="tooltip" data-placement="top" title="Indent"><i class='fa fa-indent'></i></a>

                                                    <a href="#" data-command='outdent'  data-toggle="tooltip" data-placement="top" title="Outdent"><i class='fa fa-outdent'></i></a>

                                                    <a href="#" data-command='insertUnorderedList'  data-toggle="tooltip" data-placement="top" title="Unordered list"><i class='fa fa-list-ul'></i></a>

                                                    <a href="#" data-command='insertOrderedList' data-toggle="tooltip" data-placement="top" title="Ordered list"><i class='fa fa-list-ol'></i></a>

                                                    <a href="#" data-command='h1' data-toggle="tooltip" data-placement="top" title="H1">H1</a>

                                                    <a href="#" data-command='h2'  data-toggle="tooltip" data-placement="top" title="H2">H2</a>

                                                    <a href="#" data-command='createlink' data-toggle="tooltip" data-placement="top" title="Inser link"><i class='fa fa-link'></i></a>

                                                    <a href="#" data-command='unlink' data-toggle="tooltip" data-placement="top" title="Unlink"><i class='fa fa-unlink'></i></a>

                                                    <a href="#" data-command='insertimage' data-toggle="tooltip" data-placement="top" title="Insert image"><i class='fa fa-image'></i></a>

                                                    <a href="#" data-command='p' data-toggle="tooltip" data-placement="top" title="Paragraph">P</a>

                                                    <a href="#" data-command='subscript' data-toggle="tooltip" data-placement="top" title="Subscript"><i class='fa fa-subscript'></i></a>

                                                    <a href="#" data-command='superscript'  data-toggle="tooltip" data-placement="top" title="Superscript"><i class='fa fa-superscript'></i></a>

                                                  </div>

                                                  <div id='editor' class="editorAria" contenteditable>

                                                  </div>

                                              </div>

                                              </div>

                                            </div>

                                            <div class="form-group form-group-center text-center mb-30 mt-20">

                                                <input name="form_botcheck" class="form-control" type="hidden" value="">

                                                <button type="submit" class="btn btn-dark btn-theme-colored btn-flat text-uppercase pr-100 pl-100">أرسال</button>

                                            </div>

                                      </div>

                                  </div>

                                </form>

                          </div>

                      </div>

                  </div>    

                </div>

              </div>          

            </div>

      </div>

    </section>

  </div>

  <!-- end main-content -->

  







@stop