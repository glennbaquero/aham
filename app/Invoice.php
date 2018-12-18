<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Invoice extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
	protected $guarded = [];
    protected $dates = ['deleted_at'];
	
	public function user() {
		return $this->belongsTo(User::class);
	}

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    public function renderFilePath($column = 'proof_purchase') {
        $path = null;
        $path = $this->first()->renderFilePath($column);
        return $path;
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
