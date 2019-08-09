<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class ChaptersNative extends Model
{
    protected $table = 'chapters_natives';
	
    public function chapters() {
	  return $this->belongsTo('App\Chapter', 'chapter_id');
	}

	public function chapterId(){
	    return $this->belongsTo(Chapter::class);
	}

	public function chapterIdList(){
		$user = Auth::user();
		if ($user->role_id == '1') {
		    return Chapter::orderBy('id', 'ASC')->get();
		} else {
		    return Chapter::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
		}
	}
}
