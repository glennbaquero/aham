<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Password;
use Laravel\Scout\Searchable;

use App\Traits\ActivityLogTrait;

use App\Helpers;

class Admin extends Authenticatable
{
    use SoftDeletes, Searchable, ActivityLogTrait, Notifiable, HasRoles;
    protected $dates = ['deleted_at'];

    protected $guarded = [];
	protected $guard_name = 'admin';

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

    /**
     * @Methods
     */
    public static function store($request, $item = null) 
	{
		if(!$item) {
			$vars = $request->only(['firstname', 'lastname', 'email']);
			$vars['password'] = Helpers::generateRandomString();
			$item = static::create($vars);
			$broker = Password::broker('admins');
			$broker->sendResetLink($request->only('email'));
		} else {
			$vars = $request->only(['firstname', 'lastname']);
			$item->update($vars);
		}

		if ($request->filled('roles')) {
			$roles = Role::whereIn('id', $request->input('roles'))->get();
			$item->syncRoles($roles);
		} else {
			foreach ($item->roles as $role) {
				$item->removeRole($role);
			}
		}

		return $item;	
	}

	/**
	 * @Checkers
	 */
	
	/**
     * Determine if the model has any of the given permissions.
     *
     * @param array ...$permissions
     *
     * @return bool
     * @throws \Exception
     */
    public function hasAnyPermission(...$permissions): bool
    {
    	if (!count($this->roles)) {
    		return true;
    	}

        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }

        foreach ($permissions as $permission) {
            if ($this->checkPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }

    /*
     * Renders
     */

	public function renderFullname() {
		return ucwords($this->firstname . ' ' . $this->lastname);
	} 

    public function renderName() {
        return '#' . $this->id . ' ' . $this->renderFullname();
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
