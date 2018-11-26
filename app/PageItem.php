<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class PageItem extends Model
{
 	use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    const TEXT = 0;
    const CONTENT = 1;
    const FILE = 2;

    /**
     * @TNT Search
     */
    public $asYouType = true;
    
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
        ];
    }

    /**
     * @Relationships
     */
    public function page() {
        return $this->belongsTo(Page::class, 'page_id')->withTrashed();
    }

    /**
     * @Getters
     */
    public static function getTypes() {
        return [
            ['value' => static::TEXT, 'label' => 'Text/Link/Label'],
            ['value' => static::CONTENT, 'label' => 'Content/Editor'],
            ['value' => static::FILE, 'label' => 'Image/File'],
        ];
    }

    /**
     * @Methods
     */
    public static function store($request, $item = null) {

        $vars = $request->only(['page_id', 'content', 'type']);
        $vars['slug'] = Helpers::slugify($request->input('slug'));

        switch ($request->input('type')) {
            case static::FILE:
                    if($request->hasFile('content')) {
                        if($item && $item->content) {
                            Storage::delete('public/' . $item->content);
                        }

                        $vars['content'] = $request->file('content')->store('page-items-files', 'public');
                    }
                break;
            
            default:
                # code...
                break;
        }

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }
    /*
     * Renders
     */

    public function renderName() {
        return '#' . $this->id . ' ' . $this->slug;
    }

    public function renderRelationshipName($column = 'slug', $relationship = 'page') {
        $name = null;

        if ($this->page) {
            $name = $this->page->$column;
        }

        return $name;
    }

    public function renderFilePath($column = 'content') {
        $path = null;
        if ($this[$column]) { $path = asset('storage/' . $this[$column]); }
        return $path;
    }

    public function renderView() {
        return route('admin.page-items.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.page-items.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.page-items.restore', $this->id);
    }
}
