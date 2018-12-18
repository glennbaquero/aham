<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Message extends Model
{
    use SoftDeletes, Searchable, ActivityLogTrait;
	protected $guarded = [];
    protected $dates = ['deleted_at'];

     public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }
}
