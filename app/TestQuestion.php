<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TestQuestion extends Model
{
    public function examId(){
	    return $this->belongsTo(Exams::class);
	}

    public function examIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return Exams::orderBy('id', 'ASC')->get();
    	} else {
    	    return Exams::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
