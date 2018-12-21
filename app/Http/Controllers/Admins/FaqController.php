<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Faqs;
use DB;

class FaqController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\FAQs\FAQIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\FAQs\FAQStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\FAQs\FAQUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\FAQs\FAQDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $faq = Faqs::store($request);
        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new FAQ',
            'redirect' => $faq->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.faqs.edit', [
        	'faq' => Faqs::withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$faq = Faqs::withTrashed()->find($id);
       
        DB::beginTransaction();

        $faq = Faqs::store($request, $faq);

        DB::commit();

        return response()->json([
            'message' => "You have successfully updated {$faq->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$faq = Faqs::find($id);
        $faq->delete();

        return response()->json([
            'message' => "You have successfully archived {$faq->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Faqs  $faq
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $faq = Faqs::onlyTrashed()->find($id);
        $faq->restore();

        return response()->json([
            'message' => "You have successfully restored {$faq->renderName()}",
        ]);
    }
}
