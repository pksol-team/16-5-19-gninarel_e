<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolsNative extends Model
{
    protected $table = 'schools_natives';
	
    public function schools() {
	  return $this->belongsTo('App\School', 'school_id');
	}
}
