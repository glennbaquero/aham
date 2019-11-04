<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use Notification;
use App\Notifications\UserExpiredWarrantyNotification;

use Carbon\Carbon;

class Invoice extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
	protected $guarded = [];
    protected $dates = ['deleted_at', 'expiration_date'];
	
    const GATEWAY_IPAY = 1;

    const BASIC = 0;
    const EXTENDED = 1;

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'serial_number' => $this->serial_number,
            'application_number' => $this->application_number,
        ];
    }

	public function user() {
		return $this->belongsTo(User::class)->withTrashed();
	}

    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    public static function sendExpirationNotifications() {
        $invoices = Invoice::select(['id', 'user_id', 'expiration_date', 'has_notified'])->where('has_notified', false)->get();
        $now = Carbon::now();

        foreach ($invoices as $invoice) {
            if ($invoice->user && $invoice->expiration_date->lt($now)) {
                $invoice->has_notified = true;
                $invoice->save();
                $invoice->user->notify(new UserExpiredWarrantyNotification($invoice));
            }
        }
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
