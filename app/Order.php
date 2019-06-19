<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	public function ProductsNative() {
	  return $this->belongsTo('App\ProductsNative', 'product_native_id');
	}
}
