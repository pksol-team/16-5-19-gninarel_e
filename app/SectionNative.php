<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionNative extends Model
{
    protected $table = 'section_natives';
	
    public function sections() {
	  return $this->belongsTo('App\Section', 'section_id');
	}
}
