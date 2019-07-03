<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
	protected $table = 'test_results';

	public function exam() {
	  return $this->belongsTo('App\Exams', 'exam_id');
	}

}
