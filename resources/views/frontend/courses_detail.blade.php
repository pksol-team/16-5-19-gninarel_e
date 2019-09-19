<?php 

   use App\Course; 

   use App\SectionNative; 

   use App\CategoryNative; 

?>

@extends('frontend.template.layout')

@section('title') <?= $title; ?> @stop

@section('content')

<div class="main-heading-overview">

   <a href="#" class="resp-menu" onclick="openNav()">☰</a>

   <div class="row">

      <div class="col-md-3"></div>

      <div class="col-md-9">

         <div class="elegant-special-heading-wrapper">

            <h1 class="special-heading-title text-uppercase">{{ $course->name }}</h1>

         </div>

      </div>

   </div>

</div>

<div class="podcast-detail">

   <div class="row">

      <div class="col-md-3 podcasting-img-desc">

         <div class="podcastimg">

            <img src="\public\storage\{{ $course->image }}" height="300" alt="{{ $course->name }}">

         </div>

         <div class="podcast-desc-text">

            <h4>

               <strong>@t('Description:')</strong>

            </h4>

            <p> {{ $course->description }} </p>

         </div>

         <div class="podcast-desc-text">

            <h4>

               <strong>@t('Categories:') </strong>

            </h4>

            <div class="row">

               <ul class="list-unstyled d-inline-block mb-3">

                  <?php 

                     if (count($categories) > 0) {

                        foreach ($categories as $key => $courseCategory) {

                           $category_id = $courseCategory->id;

                           $categoryNative = CategoryNative::with('categories')->whereHas('categories', function ($query) use ($category_id) {

                              $query->where('category_id', $category_id);

                           })->where([['lang', Request::locale()], ['status', 'active']])->get();

                           if ($categoryNative) {

                              foreach ($categoryNative as $key => $category) {

                                 echo '<li><span>'.$category->name.'</span></li>';

                              }

                           } else {

                              echo '<li><span>'.t('Uncategorized').'</span></li>';  

                           }

                        }

                     } else {

                        echo '<li><span>'.t('Uncategorized').'</span></li>';

                     }

                   ?>

               </ul>

            </div><!-- /.row -->

         </div>

      </div>

      <div class="col-md-9">

         <div class="course-detail">

            <div class="row">

               <div class="col-md-12">

                  <h3>@t('This course is divided into :CountChapterNative main chapters:', ['CountChapterNative' => count($chapterNative)])</h3>

                 <!--  <h3>This course is divided into {{ count($chapterNative) }} main chapters:</h3> -->

                  <div class="section-li">

                        <?php if (count($chapterNative) > 0): ?>

                           <div id="accordion">



                              <?php foreach ($chapterNative as $key => $chapters): ?>

                              <div class="card">

                                 <div class="card-header" id="heading-{{$key}}">

                                    <h5 class="mb-0">

                                       <a role="button" data-toggle="collapse" href="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">

                                          <i class="fa fa-book float-left"></i> &nbsp; {{ $chapters->name }}

                                       </a>

                                    </h5>

                                 </div>

                                 <div id="collapse-{{ $key }}" class="collapse" data-parent="#accordion" aria-labelledby="heading-1">

                                    <div class="card-body">

                                    <strong>@t('Description:')</strong> <p class="text-dark">{{ $chapters->description }}</p>

                                       <div id="accordion-1">

                                          <?php 

                                             $chapter_id = $chapters->chapters->id;

                                             $sectionNative = SectionNative::with('sections')->whereHas('sections', function ($query) use ($chapter_id) {

                                                $query->where('chapter_id', $chapter_id);

                                             })->where([['lang', Request::locale()], ['status', 'active']])->get();

                                          ?>

                                          <?php if (count($sectionNative) > 0): ?>

                                             <?php foreach ($sectionNative as $key_section => $sections): ?>

                                                <h3>@t('This chapter is divided into :countSectionNative main sections:',['countSectionNative' => count($sectionNative) ])</h3>



                                                <div class="card">

                                                   <div class="card-header" id="heading-{{$key_section}}-2">

                                                      <h5 class="mb-0">

                                                         <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-{{$key_section}}-2" aria-expanded="false" aria-controls="collapse-{{$key_section}}-2">

                                                         <i class="fa fa-credit-card-alt"></i>  &nbsp; {{ $sections->name }}

                                                         </a>

                                                      </h5>

                                                   </div>

                                                   <div id="collapse-{{$key_section}}-2" class="collapse" data-parent="#accordion-1" aria-labelledby="heading-{{$key_section}}-2">

                                                      <div class="card-body">

                                                         <strong>@t('Description:')</strong> <p class="text-dark">{{ $sections->description }}</p>

                                                         <?php 

                                                            $section_id = $sections->sections->id;

                                                            $videoNative = VideoNative::with('videos')->whereHas('videos', function ($query) use ($section_id) {

                                                               $query->where('section_id', $section_id);

                                                            })->where([['lang', Request::locale()], ['status', 'active']])->get();

                                                         ?>

                                                         <?php if (count($videoNative) > 0): ?>

                                                         <?php foreach ($videoNative as $key => $video): ?>

                                                            <ul>

                                                               <li>

                                                                  <span>{{ $video->name }}</span>

                                                                  <span class="float-right">

                                                                     <span>

                                                                        <a href="{{ lang_url('courses/'.$course_id.'/video/'.$video->id) }}" class="d-inline-block">

                                                                           <button class="btn btn-sm watch_all_video">@t('Watch Video')</button>

                                                                        </a>

                                                                     </span>

                                                                     <span>{{ $video->duration }}</span>

                                                                  </span>

                                                               </li>

                                                            </ul>

                                                         <?php endforeach ?>

                                                         <?php else: ?>

                                                            <ul>

                                                               <li><span>@t('No Videos found in this section')</span></li>

                                                            </ul>

                                                         <?php endif ?>

                                                      </div>

                                                   </div>

                                                </div>

                                             <?php endforeach ?>

                                          <?php else: ?> 

                                             <ul>

                                                <li><span>@t('No Sections found in this chapter')</span></li>

                                             </ul> 

                                          <?php endif ?>

                                       </div>

                                    </div>

                                 </div>

                              </div>

                              <?php endforeach ?>

                              

                           </div>

                        <?php else: ?> 

                           <ul>

                              <li><span>@t('No chapters found in this course')</span></li>

                           </ul>   

                        <?php endif ?>

                  </div>

               </div>

            </div>

         </div>

      </div>

   </div>

</div>

@stop