<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppliedCoach extends Model
{
    protected $table = 'applied_coach';

    public function users() {
	  return $this->belongsTo('App\User', 'user_id');
	}
}
