<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class EventsNative extends Model
{
    protected $table = 'events_natives';
	
    public function events() {
	  return $this->belongsTo('App\Event', 'event_id');
	}

	public function eventId(){
	    return $this->belongsTo(Event::class);
	}

    public function eventIdList(){
    	$user = Auth::user();
    	if ($user->role_id == '1') {
    	    return Event::orderBy('id', 'ASC')->get();
    	} else {
    	    return Event::where('coach_id', $user->id)->orderBy('id', 'DESC')->get();
    	}
    }
}
