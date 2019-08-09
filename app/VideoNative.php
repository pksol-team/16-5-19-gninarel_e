<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class VideoNative extends Model
{
    protected $table = 'video_natives';
	
    public function videos() {
	  return $this->belongsTo('App\Video', 'video_id');
	}

	public function videoId(){
	    return $this->belongsTo(Video::class);
	}

    public function videoIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return Video::orderBy('id', 'ASC')->get();
    	} else {
    	    return Video::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
