<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\PageItem;
use App\Page;
use App\ProductTag;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$page = Page::where('slug', 'home')->first();
        return view('public.pages.home', 
        	$page->getData()
        );
    }
}
