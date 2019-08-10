<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Exams extends Model
{
	protected $table = 'exam';


	public function chapterId(){
	    return $this->belongsTo(ChaptersNative::class);
	}

    public function chapterIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return ChaptersNative::orderBy('id', 'ASC')->get();
    	} else {
    	    return ChaptersNative::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
