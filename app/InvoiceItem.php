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

    public $asYouType = true;

    const APP_PENDING = 0;
    const APP_APPROVED = 1;
    const INVOICE_PENDING = 2;
    const INVOICE_APPROVED = 3;
    const INVOICE_PENDING_PAYMENT = 4;

    public function invoice() {
    	return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    
    public function product() {
    	return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'serial' => $this->invoice['serial_number'],
            'unit_price' => $this->unit_price,
        ];
    }

    /**
     * @Getters
     */

    public static function getStatus() {
        return [
            ['value' => static::APP_PENDING, 'label' => 'PENDING APPLICATION', 'class' => 'bg-red'],
            ['value' => static::APP_APPROVED, 'label' => 'APPROVED APPLICATION', 'class' => 'bg-blue'],
            ['value' => static::INVOICE_PENDING, 'label' => 'PENDING INVOICE', 'class' => 'bg-red'],
            ['value' => static::INVOICE_PENDING_PAYMENT, 'label' => 'PENDING INVOICE (PAYMENT)', 'class' => 'bg-red'],
            ['value' => static::INVOICE_APPROVED, 'label' => 'APPROVED INVOICE', 'class' => 'bg-blue'],
        ];
    }
    
    /**
     * @Helpers
     */
    public function renderConstants($array, $value, $column = null) {

        /* Loop through the array */
        foreach ($array as $obj) {
            
            if($obj['value'] == $value) {

                /* Fetch columm if specified */
                if($column && isset($obj[$column]))
                    return $obj[$column];

                return $obj;
            }
        }
    }
    
    /*
     * Renders
     */

    
    public function renderStatusLabel() {
        return $this->renderConstants(static::getStatus(), $this->status, 'label');
    }

    public function renderStatusClass() {
        return $this->renderConstants(static::getStatus(), $this->status, 'class');
    }

    public function renderRawTotal() {
        return $this->unit_price;
    }

    public function renderTotal() {
        return number_format($this->renderRawTotal(), 2, '.', '');
    }
    
    public function renderName() {
        return '#' . $this->id . ' ' . $this->model;
    }

    public function renderFilePath() {
        if ($this->product) {
            return $this->product->renderFilePath();
        }
    }

    public function renderView() {
        return route('admin.application.approve', $this->id);
    }

    public function renderDelete() {
        return route('admin.application.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.application.restore', $this->id);
    }
}
