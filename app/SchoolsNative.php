<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class SchoolsNative extends Model
{
    protected $table = 'schools_natives';
	
    public function schools() {
	  return $this->belongsTo('App\School', 'school_id');
	}

	public function schoolId(){
	    return $this->belongsTo(School::class);
	}

    public function schoolIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return School::orderBy('id', 'ASC')->get();
    	} else {
    	    return School::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
