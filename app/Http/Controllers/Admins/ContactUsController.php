<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ContactUs;
use App\Message;

use DB;

class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\ContactUs\ContactUsIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\ContactUs\ContactUsStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\ContactUs\ContactUsUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\ContactUs\ContactUsDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.contactus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contactus.create');
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

        $contact = ContactUs::store($request);

        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new contact information',
            'redirect' => $contact->renderView(),
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
        return view('admin.contactus.edit', [
        	'contact' => ContactUs::withTrashed()->find($id)
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
        $contact = ContactUs::withTrashed()->find($id);

        DB::beginTransaction();

        $contact = ContactUs::store($request, $contact);

        DB::commit();

        return response()->json([
            'message' => "You have successfully updated this contact information",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactUs::find($id);
        $contact->delete();

        return response()->json([
            'message' => "You have successfully archived this contact information",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $contact = ContactUs::onlyTrashed()->find($id);
        $contact->restore();

        return response()->json([
            'message' => "You have successfully restored this contact information",
        ]);
    }

}
