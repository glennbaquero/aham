<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use App\Helpers;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Searchable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'contact' => $this->contact,
            'birthday' => $this->birthday,
            'email' => $this->email,
        ];
    }

    public static function store($request, $item = null) {
        $vars = $request->only(['email', 'firstname', 'lastname', 'contact', 'birthday', 'address']);

        if(!$item) {
            $item = static::create([
                'email' => $request->input('email'),
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'contact' => $request->input('contact'),
                'birthday' => $request->input('birthday'),
                'address' => $request->input('address'),
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
   
   public function isVerified()
   {
       return $this->is_verified;
   }
   
    public function renderFullName() {
        return $this->firstname . ' '. $this->lastname;
    }

    public function renderFilePath($column = 'user_image') {
        $path = null;
        if ($this[$column]) { $path = asset('storage/' . $this[$column]); }
        return $path;
    }

    public function renderName() {
        return '#' . $this->id . ' ' . $this->renderFullName();
    }

    public function renderView() {
        return route('admin.users.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.users.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.users.restore', $this->id);
    }
}
