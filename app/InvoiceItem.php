<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $guarded = [];

    public function invoice() {
    	return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    
    public function product() {
    	return $this->belongsTo(Product::class, 'product_id')->with('images')->withTrashed();
    }
}
