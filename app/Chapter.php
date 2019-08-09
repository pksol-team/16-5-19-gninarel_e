<?php

namespace App;
use Auth;


use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';

    public function chapterDetail() {
   	  return $this->hasMany('App\ChaptersNative', 'chapter_id');
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
