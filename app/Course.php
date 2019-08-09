<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function coachID(){
        return $this->belongsTo(User::class);
    }

    public function schoolId(){
	    return $this->belongsTo(School::class);
	}

	public function schoolIdList(){
		$user = Auth::user();
		if ($user->role_id == '1') {
		    return School::orderBy('id', 'ASC')->get();
		} else {
		    return School::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
		}
	}

}
