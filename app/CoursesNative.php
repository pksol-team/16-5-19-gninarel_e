<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class CoursesNative extends Model
{
	protected $table = 'courses_natives';
	
    public function courses() {
	  return $this->belongsTo('App\Course', 'course_id');
	}

	public function courseId(){
	    return $this->belongsTo(Course::class);
	}

	public function courseIdList(){
		$user = Auth::user();
		if ($user->role_id == '1') {
		    return Course::orderBy('id', 'ASC')->get();
		} else {
		    return Course::where('coach_id', $user->id)->orderBy('id', 'DESC')->get();
		}
	}
}
