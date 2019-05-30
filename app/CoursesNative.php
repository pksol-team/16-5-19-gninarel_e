<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesNative extends Model
{
	protected $table = 'courses_natives';
	
    public function courses() {
	  return $this->belongsTo('App\Course', 'course_id');
	}
}
