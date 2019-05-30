<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoNative extends Model
{
    protected $table = 'video_natives';
	
    public function videos() {
	  return $this->belongsTo('App\Video', 'video_id');
	}
}
