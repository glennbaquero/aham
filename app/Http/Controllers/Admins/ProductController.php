<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

use App\Http\Requests\ProductImportPost;

use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Product;
use App\ProductImage;
use App\Type;
use App\Category;
use App\ProductTag;
use App\PageItem;

use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\Admins\Products\ProductIndexMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\Admins\Products\ProductStoreMiddleware', ['only' => ['create', 'store']]);
        $this->middleware('App\Http\Middleware\Admins\Products\ProductUpdateMiddleware', ['only' => ['edit', 'update']]);
        $this->middleware('App\Http\Middleware\Admins\Products\ProductDestroyMiddleware', ['only' => ['destroy', 'restore']]);
        $this->middleware('App\Http\Middleware\Admins\Products\ProductUploadMiddleware', ['only' => ['upload', 'uploadproduct']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = ProductTag::select(ProductTag::MINIMAL_COLUMN)->get();

        return view('admin.products.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',[
            'types' => Type::all(),
            'categories' => Category::all(),
            'tags' => ProductTag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        $product = Product::store($request);

        DB::commit();

        return response()->json([
            'message' => 'You have successfully create a new product',
            'redirect' => $product->renderView(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.edit', [
            'categories' => Category::all(),
            'types' => Type::all(),
            'tags' => ProductTag::all(),
            'product' => Product::withTrashed()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::withTrashed()->find($id);
       
        DB::beginTransaction();

        $product = Product::store($request, $product);

        DB::commit();

        return response()->json([
            'message' => "You have successfully updated {$product->renderName()}",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'message' => "You have successfully archived {$product->renderName()}",
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();

        return response()->json([
            'message' => "You have successfully restored {$product->renderName()}",
        ]);
    }

    /**
     * Upload product manifest view
     */
    public function upload()
    {
        return view('admin.uploadmanifests.products');
    }

    public function uploadproduct(ProductImportPost $request) 
    {   
        $result = Excel::import(new ProductImport($request), $request->file('manifest'));

        return response()->json([
            'title' => 'Success',
            'message' => 'You have successfully uploaded a manifest.',
            'list' => session('import_messages'),
        ]);
    } 

    public function featuredproduct(Product $product)
    {
        // $product->product_tag()->sync()

        return redirect()->back();
    }

    public function fetch(Category $categories)
    {
        return response()->json([
            'categories' => $categories->fetchCategory(),
        ]);
    }

    public function view(Product $product, $id)
    {
        return view('public.pages.product-selected-page',[
            'product' => $product->find($id),
            'products' => $product->all(),
            'item' => PageItem::where('slug','register_product_view')->first()
        ]);
    }

    public function warrantyproductfetch()
    {
        return response()->json([
            'products' => Product::with('images')->get(),
        ]);
    }

    public function extendedwarrantyproductfetch()
    {
        return response()->json([
            'products' => Product::with('images', 'category')->orWhereNotNull('extended_amount')->get(),
        ]);
    }

    public function downloadmanual($id) {
        $product = Product::withTrashed()->find($id);
        $file = 'storage/'.$product->manual_path;

        $headers = array('Content-Type: application/pdf');
        $explode = explode('/', $product->manual_path);
        return response()->download($file, $explode[1]);
    }
}
