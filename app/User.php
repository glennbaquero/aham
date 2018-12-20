<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Helpers;

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

    public function discounts() {
        return $this->hasMany(Discount::class);
    }

    public static function store($request, $item = null) {
        $vars = $request->only(['email', 'firstname', 'lastname', 'contact', 'birthday']);

        if(!$item) {
            $item = static::create([
                'email' => $request->input('email'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'contact' => $request->input('contact'),
                'birthday' => $request->input('birthday'),
                'password' => Hash::make($request->input('password')),
                'email_token' => Helpers::generateRandomString(60),
            ]);
        } else {

        }


        return $item;
    }

    public static function getInvoiceItems($request) {
        $invoiceItems = [];

        if($request->filled('user_id')) {
            $user = User::find($request->input('user_id'));
            $ids = $user->invoices()->pluck('id')->toArray();
            $invoiceItems = InvoiceItem::with(['product', 'invoice'])->whereIn('invoice_id', $ids)->get();
        }
        
        return $invoiceItems;
    }

    /*
    *  Renderers
    */


    public function renderFullName() {
        return $this->firstname . ' '. $this->lastname;
    }

    public function renderName() {
        return '#' . $this->id . ' ' . $this->renderFullName();
    }

    public function renderView() {
        return '#';
    }
}
