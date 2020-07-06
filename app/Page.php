<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;

use App\Product;

class Page extends Model
{
 	use SoftDeletes, Searchable, ActivityLogTrait;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected $request;

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
    public function getData($request = null) {

        $this->request = $request;

        $data = [
            'page' => $this,
            'item' => $this->getPageItems(),
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
        $arr = [];

        $products = Product::with('category')->get();
        
        switch($this->slug) {
            case 'home':
                    $data['view'] = "public.pages.home";
                    $data['featured_products'] = Product::whereHas('tags', function($query){
                                                    $query->where('name', 'Featured Product');
                                                })->get();
                    $data['products'] = Product::with('category')->orderBy('model', 'asc')->get();;
                    $data['categories'] = Category::all();;
                break;
            case 'products':
                    $data['view'] = "public.pages.product-page";
                    $data['product_sliders'] = Carousel::with('images')->whereHas('tags', function($query){
                                                    $query->where('name', 'product');
                                                })->get();
                    $data['products'] = $products;
                    $data['params'] = http_build_query($this->request->only('search'));
                break;
            case 'about':
                    $data['view'] = "public.pages.about-page";
                    $data['carousels'] = Carousel::with('images')->whereHas('tags', function($query){
                                                $query->where('name', 'strategic partners');
                                            })->get();
                    $data['carousels_about'] = Carousel::with('images')->whereHas('tags', function($query){
                                                    $query->where('name', 'about');
                                                })->get();
                    $data['faqs'] = Faqs::all();
                break;
            case 'warranty_info':
                    $data['view'] = "public.pages.warranty-info-page";
                    $data['warranty_info_sliders'] = Carousel::with('images')->whereHas('tags', function($query){
                                                            $query->where('name', 'warranty');
                                                        })->get();
                    $data['products'] = $products;
                break;
            case 'contact':
                    $data['view'] = "public.pages.contact-page";
                    $data['products'] = Product::with('category')->orderBy('model', 'asc')->get();;
                break;
            case 'selected':
                    $data['view'] = "public.pages.product-selected-page";
                    $data['products'] = $products;
                break;
            case 'category':
                    $data['view'] = "public.pages.product-category-page";
                break;
            case 'logo':
                $data['aham_logo'] = "includes.footer";
                $data['aham_logo'] = "includes.header";
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
