<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public function user() {
		return $this->belongsTo(User::class);
	}

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
