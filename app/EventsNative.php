<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsNative extends Model
{
    protected $table = 'events_natives';
	
    public function events() {
	  return $this->belongsTo('App\Event', 'event_id');
	}
}
