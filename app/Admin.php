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
use Route;

use App\Helpers;

class Admin extends Authenticatable
{
    use SoftDeletes, Searchable, ActivityLogTrait, Notifiable, HasRoles;
    protected $dates = ['deleted_at'];

    protected $guarded = [];
	protected $guard_name = 'admin';

    const DEFAULT = 0;
    const REPAIRMAN = 1;

    /**
     * Boot All Model Events
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        foreach (static::getModelEvents() as $event) {
            static::$event(function($model) use ($event) {
                $name = Route::currentRouteName();

                switch ($name) {
                    case 'admin.logout':
                    
                        break;
                    
                    default:
                            $model->addActivity($event);
                        break;
                }
            });
        }
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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
        ];
    }

    /**
     * @Relationships
     */
    public function repairman() {
        return $this->hasMany(RepairMan::class, 'admin_id');
    }

    /**
     * @Scopes
     */
    public function scopeWhereAvailableRepairman($query) {
        $repairmanids = Admin::whereHas('repairman', function($a) {
            $a->whereHas('request', function($b) {
                $b->where('status', '!=', RepairServiceRequest::PENDING)->where('status', '!=', RepairServiceRequest::ONGOING);
            });
        })->pluck('id')->toArray();

        $adminids = Admin::whereDoesntHave('repairman')->pluck('id')->toArray();

        $ids = array_merge($repairmanids, $adminids);

        return $query->whereIn('id', $ids)->where('type', static::REPAIRMAN);
    }

    /**
     * @Getters
     */
    public static function getTypes() {
        return [
            ['value' => static::DEFAULT, 'label' => 'Default', 'class' => 'bg-green'],
            ['value' => static::REPAIRMAN, 'label' => 'Repairman', 'class' => 'bg-orange'],
        ];
    }

    /**
     * @Methods
     */
    public static function store($request, $item = null) 
	{
		if(!$item) {
			$vars = $request->only(['firstname', 'lastname', 'email', 'type']);
			$vars['password'] = Helpers::generateRandomString();
			$item = static::create($vars);
			$broker = Password::broker('admins');
			$broker->sendResetLink($request->only('email'));
		} else {
			$vars = $request->only(['firstname', 'lastname', 'type']);
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

	public function renderFullname() {
		return ucwords($this->firstname . ' ' . $this->lastname);
	} 

    public function renderName() {
        return '#' . $this->id . ' ' . $this->renderFullname();
    }

    public function renderRoleList() {
        $roles = $this->getRoleNames();
        $message = 'Super Admin';

        if (count($roles)) {
            $message = implode(', ', $roles->toArray());
        }

        return $message;
    }

    public function renderTypeLabel() {
        return $this->renderConstants(static::getTypes(), $this->type, 'label');
    }

    public function renderTypeClass() {
        return $this->renderConstants(static::getTypes(), $this->type, 'class');
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
