<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChaptersNative extends Model
{
    protected $table = 'chapters_natives';
	
    public function chapters() {
	  return $this->belongsTo('App\Chapter', 'chapter_id');
	}
}
