<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\CarouselImage;

class CarouselImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarouselImage  $carouselImage
     * @return \Illuminate\Http\Response
     */
    public function show(CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarouselImage  $carouselImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarouselImage  $carouselImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarouselImage $carouselImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarouselImage  $carouselImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carousel = CarouselImage::find($id);
        $carousel->destroy($id);

        Storage::delete('public/' . $carousel->image_path);

        return response()->json([
            'message' => 'Succesfully removed the image in the slider!'
        ]);
    }
}
