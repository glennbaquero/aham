<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    const MINIMAL_COLUMNS = ['id', 'firstname', 'lastname', 'address'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function requests() {
        return $this->hasMany(RepairServiceRequest::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function userdetail() {
        return $this->hasOne(UserDetail::class);
    }

     public function products() {
        return $this->hasMany(Product::class);
    }

    public static function getInvoiceItems($request) {
        $invoiceItems = [];

        if($request->filled('user_id')) {
            $user = User::find($request->input('user_id'));
            $ids = $user->invoices()->pluck('id')->toArray();
            $invoiceItems = InvoiceItem::with('product')->whereIn('invoice_id', $ids)->get();
        }
        
        return $invoiceItems;
    }

    /*
    *  Renderers
     */

    public function renderName() {
        return $this->firstname. ' '. $this->lastname;
    }
}
