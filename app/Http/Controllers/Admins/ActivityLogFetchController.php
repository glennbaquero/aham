<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\FetchController;

use DB;

use App\ActivityLog;

class ActivityLogFetchController extends FetchController
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass()
    {
        $this->class = new ActivityLog;
    }
    
    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query)
    {
        $query = ($this->class)->newQuery();

        if ($this->request->filled('search')) {
            $ids = $this->class::search($this->request->input('search'))->get()->pluck('id')->toArray();
            $query = $query->whereIn('id', $ids);
        }

        if($this->request->has('archive')) {
            $ids = $query->onlyTrashed()->pluck('id')->toArray();
            $query = $query->onlyTrashed()->whereIn('id', $ids);
        }

        if ($this->request->filled('user')) {
            $query = $query->where('auth_id', $this->request->input('user'));
        }

        if ($this->request->filled('event')) {
            $query = $query->where('event', $this->request->input('event'));
        }

        if ($this->request->filled('model')) {
            $query = $query->where('model_class', $this->request->input('model'));
        }

        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items)
    {
        $result = [];

        foreach($items as $item) {
            array_push($result, array(
                'message' => $item->renderMessage(),
                'model' => $item->renderModel(),
                'event' => $item->renderEvent(),
                'created_at' => $item->renderCreatedAt(),
                
                'actions' => array(
                    'view' => $item->renderView(),
                    'view_user' => $item->renderViewUser(),
                )
            ));
        }

        return $result;
    }
}
