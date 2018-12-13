<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Category;
use App\Product;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
            $category = Category::store($request);
        DB::commit();
                
        return response()->json([
            'message' => 'You have successfully create a new category of product',
            'redirect' => $category->renderView(),
        ]);
        // return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.categories.edit',[
            'category' => Category::withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::withTrashed()->find($id);

        DB::beginTransaction();
            $category = Category::store($request, $category);
        DB::commit();
        
        return response()->json([
            'message' => "You have successfully updated {$category->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'message' => "You have successfully archived {$category->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();

        return response()->json([
            'message' => "You have successfully restored {$category->renderName()}",
        ]);
    }

    public function upload()
    {
        return view('admin.uploadmanifests.categories');
    }

    public function uploadcategory(Request $request)
    { 
        Excel::import(new CategoriesImport, $request->file('manifest'));
        return redirect()->back();
    }

    public function viewAllProduct(Category $category,$id)
    {
        return view('public.pages.product-category-page', [
            // 'products' => Category::with('products')->find($id)
            'category' => $category->fetchCategory($id)
        ]);
    }
}
