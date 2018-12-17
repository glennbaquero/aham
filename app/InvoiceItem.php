<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class InvoiceItem extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
	protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function invoice() {
    	return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    
    public function product() {
    	return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
    
    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }	

    public function renderView() {
        return route('admin.application.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.application.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.application.restore', $this->id);
    }
}
