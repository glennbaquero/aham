<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if(!$page) {
            switch ($slug) {
                case 'admin':
                        return redirect()->route('admin.login.show');
                    break;
                
                default:
                        abort(404);
                    break;
            }
        }

        $data = $page->getData();
        return view($data['view'], $data);
    }

    public function signup()
    {
        return view('public.pages.signup-page');
    }

    public function login()
    {
        return view('public.pages.login-page');
    }
}
