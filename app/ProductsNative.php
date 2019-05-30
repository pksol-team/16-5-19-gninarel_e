<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsNative extends Model
{
	protected $table = 'products_natives';

	public function productSpec() {
	  return $this->belongsTo('App\Product', 'product_id');
	}

}
