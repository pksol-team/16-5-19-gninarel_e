<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';

    public function chapterDetail() {
   	  return $this->hasMany('App\ChaptersNative', 'chapter_id');
	}
}
