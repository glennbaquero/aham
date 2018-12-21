<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Discount;
use App\Category;
use App\User;

use DB;

class DiscountController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\Discounts\DiscountIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\Discounts\DiscountStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\Discounts\DiscountUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\Discounts\DiscountDestroyMiddleware', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create', [
            'categories' => Category::all(),
            'users' => User::all()
        ]);
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
            $discount = Discount::store($request);
        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new discount',
            'redirect' => $discount->renderView(),
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
        return view('admin.discount.edit', [
            'discount' => Discount::withTrashed()->find($id),
            'categories' => Category::all(),
            'users' => User::all()
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
        $discount = Discount::withTrashed()->find($id);

        DB::beginTransaction();
            $discount = Discount::store($request, $discount);
        DB::commit();

        return response()->json([
            'message' => "You have successfully updated this item",
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
        $discount = Discount::find($id);
        $discount->delete();

        return response()->json([
            'message' => "You have successfully archived this item",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $discoutnt = Discount::onlyTrashed()->find($id);
        $discoutnt->restore();

        return response()->json([
            'message' => "You have successfully restored this item",
        ]);
    }
}
