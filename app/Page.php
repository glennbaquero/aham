<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

class Page extends Model
{
 	use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    const MINIMAL_COLUMN = [
        'id', 
        'name', 'slug',
    ];

    /**
     * @TNT Search
     */
    public $asYouType = true;
    
    public function toSearchableArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }

    /**
     * @Relationships
     */
    public function page_items() {
        return $this->hasMany(PageItem::class, 'page_id');
    }

    /**
     * @Getters
     */
    
    /**
     * Assemble Page Data
     * @return array Page Data
     */
    public function getData() {

        $data = [
            'page' => $this,
            'items' => $this->getPageItems(),
            'view' => "frontend.{$this->slug}"
        ];

        $data = $this->getExtraPageData($data);

        return $data;
    }

    /**
     * @Methods
     */
    public static function store($request, $item = null) {

        $vars = $request->only(['name']);
        $vars['slug'] = Helpers::slugify($request->input('slug'));

        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

    /**
     * @Helpers
     */

    /**
     * Get additional page data
     * @param  App\Page $page
     * @return array
     */
    public function getExtraPageData($data) {

        switch($this->slug) {

            case 'home':
                    $arr = [];
                    $data['view'] = "frontend.home";
                break;

            default:
                    $arr = [];
                break;
        }

        return array_merge($data, $arr);
    }

    /**
     * Rename Properties for easier access
     * @return stdClass       Collection of modified page items
     */
    public function getPageItems() {

        $item = new \stdClass();

        foreach($this->page_items as $pageItem) {
            $item->{$pageItem->slug . 'ID'} = $pageItem->id;

            if($pageItem->content) {
                switch ($pageItem->type) {
                    case PageItem::FILE:
                            $content = asset('storage/' . $pageItem->content);
                        break;
                    
                    default:
                            $content = $pageItem->content;
                        break;
                }

                $item->{$pageItem->slug} = $content;
            }
        }

        return $item;
    }

    /**
     * @Renders
     */
    public function renderName() {
        return '#' . $this->id . ' ' . $this->name;
    }

    public function renderPageView() {
        switch($this->slug) {
            default:
                    $view = 'frontend.' . $this->slug;
                break;
        }

        return $view;
    }

    public function renderView() {
        return route('admin.pages.edit', $this->id);
    }

    public function renderDelete() {
        return route('admin.pages.destroy', $this->id);
    }

    public function renderRestore() {
        return route('admin.pages.restore', $this->id);
    }
}
