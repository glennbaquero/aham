<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes, Searchable, ActivityLogTrait;
    protected $dates = ['deleted_at'];

    const MINIMAL_COLUMN = [
        'id',
        'name',
    ];

    /**
     * @TNT Search
     */
    public $asYouType = true;

    public static function store($request, $item = null) 
    {
        $vars  = $request->only(['name', 'description']);

        if(!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
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

    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderView() {
    	return route('admin.roles.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.role.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.role.restore', $this->id);
    }

}
