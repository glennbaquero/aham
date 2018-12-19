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
	
    const GATEWAY_IPAY = 1;

    const BASIC = 0;
    const EXTENDED = 1;

	public function user() {
		return $this->belongsTo(User::class);
	}

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    /*
     * Renders
     */

    public function renderRawTotal() {

        $total = 0;

        foreach($this->invoice_items as $item) {
            $total += $item->renderTotal();
        }

        return $total;
    }

    public function renderTotal() {
        return number_format($this->renderRawTotal(), 2, '.', '');
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
