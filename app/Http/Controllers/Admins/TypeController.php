<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use Illuminate\Http\Request;

use App\Type;
use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {

        DB::beginTransaction();
            $type = Type::store($request);
        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new type of product',
            'redirect' => $type->renderView(),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.types.edit',[
            'type' => Type::withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $id)
    {

        $type = Type::withTrashed()->find($id);

        DB::beginTransaction();
        $type = Type::store($request, $type);
        DB::commit();

        return response()->json([
            'message' => 'You have successfully updated the product type'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();

        return response()->json([
            'message' => "You have successfully archived {$type->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $type = Type::onlyTrashed()->find($id);
        $type->restore();

        return response()->json([
            'message' => "You have successfully restored {$type->renderName()}",
        ]);
    }
}
