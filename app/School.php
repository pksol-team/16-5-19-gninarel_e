<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';
	
    public function schoolDetail() {
   	  return $this->hasMany('App\SchoolsNative', 'school_id');
	}

}
