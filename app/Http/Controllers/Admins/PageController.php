<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PagePost;

use DB;

use App\Page;
use App\PageItem;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\Pages\PageIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\Pages\PageStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\Pages\PageUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\Pages\PageDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagePost $request)
    {
        DB::beginTransaction();

        $page = Page::store($request);

        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new Page',
            'redirect' => $page->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::withTrashed()->find($id);
        $types = json_encode(PageItem::getTypes());

        return view('admin.pages.edit', [
            'page' => $page,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PagePost $request, $id)
    {
        $page = Page::withTrashed()->find($id);

        DB::beginTransaction();

        $page = Page::store($request, $page);

        DB::commit();

        return response()->json([
            'message' => "You have successfully updated {$page->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::withTrashed()->find($id);
        $page->delete();

        return response()->json([
            'message' => "You have successfully archived {$page->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $page = Page::onlyTrashed()->find($id);
        $page->restore();

        return response()->json([
            'message' => "You have successfully restored {$page->renderName()}",
        ]);
    }
}
