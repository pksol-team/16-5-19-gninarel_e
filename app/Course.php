<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    
    protected $table = 'courses';
	
    public function courseDetail() {
   	  return $this->hasMany('App\CoursesNative', 'course_id');
	}

	public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

}
