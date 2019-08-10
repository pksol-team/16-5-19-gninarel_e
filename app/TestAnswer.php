<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TestAnswer extends Model
{
    public function questionId(){
	    return $this->belongsTo(TestQuestion::class);
	}

    public function questionIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return TestQuestion::orderBy('id', 'ASC')->get();
    	} else {
    	    return TestQuestion::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
