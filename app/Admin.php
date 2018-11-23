<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;

use Hash;

class Admin extends Authenticatable
{
    use SoftDeletes, Searchable, ActivityLogTrait, Notifiable, HasRoles;
    protected $dates = ['deleted_at'];

    protected $guarded = [];
	protected $guard_name = 'admin';

	public static function store($request, $item = null) 
	{
		$password = Hash::make($request->get('password'));

		$vars = $request->only(['firstname', 'lastname', 'email']);

		if(!$item) {
			
			$item = static::create([
				'firstname' => $request->get('firstname'),
				'lastname' => $request->get('lastname'),
				'email' => $request->get('email'),
				'password' => $password,
			]);
		} else {
			$item->update([
				'firstname' => $request->get('firstname'),
				'lastname' => $request->get('lastname')
			]);

		}

		foreach ($request->roles as $role) {
			$item->syncRoles($request->roles);
		}
		
		return $item;
		
	}

    /**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
	    $this->notify(new ResetPasswordNotification($token));
	}

	public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /*
     * Renders
     */

	public function renderFullname() {
		return ucwords($this->firstname . ' ' . $this->lastname);
	} 

    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderView() {
    	return route('admin.administrator.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.administrator.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.administrator.restore', $this->id);
    }
}
