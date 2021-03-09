<?php

namespace App\Http\Controllers;

use App\Http\Resources\Hotel as HotelResource;
use App\Http\Resources\HotelCollection;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Get hotels.
     *
     * Retrieve all hotels
     *
     */
    public function index(Request $request)
    {
        return HotelResource::collection(Hotel::paginate());
    }

    /**
     * Get hotel.
     *
     * Get a single hotel by id
     *
     */
    public function show(Request $request)
    {
        return new HotelResource(Hotel::findOrFail($request->route('id')));
    }

    /**
     * Room creation.
     *
     * Create a hotel
     *
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();

        $hotel->name = $request->get('name');
        $hotel->address = $request->get('address');
        $hotel->phone = $request->get('phone');
        $hotel->city = $request->get('city');
        $hotel->stars = $request->get('stars');

        $hotel->save();

        return response()->json([
            'id' => $hotel->id,
            'message' => 'Hotel successfully created.'
        ]);
    }

    /**
     * Edit hotel.
     *
     * Edit a hotel with id
     *
     */
    public function edit(Request $request)
    {
        $hotel = Hotel::find($request->route('id'));
        $hotel->name = $request->get('name');
        $hotel->address = $request->get('address');
        $hotel->phone = $request->get('phone');
        $hotel->city = $request->get('city');
        $hotel->stars = $request->get('stars');
        
        $hotel->save();

        return response()->json([
            'id' => $hotel->id,
            'message' => 'Hotel successfully edited.'
        ]);
    }

    /**
     * Delete hotel.
     *
     * Delete a hotel by id
     *
     */
    public function delete(Request $request)
    {
        $hotel = Hotel::find($request->get('id'));
        $hotel->delete();

        return response()->json([
            'message' => 'Hotel successfully deleted.'
        ]);
    }
}
