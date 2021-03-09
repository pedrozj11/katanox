<?php

namespace App\Http\Controllers;

use App\Http\Resources\Hotel as HotelResource;
use App\Http\Resources\HotelCollection;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        return HotelResource::collection(Hotel::paginate());
    }

    public function show(Request $request)
    {
        return new HotelResource(Hotel::findOrFail($request->route('id')));
    }

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

    public function delete(Request $request)
    {
        $hotel = Hotel::find($request->get('id'));
        $hotel->delete();

        return response()->json([
            'message' => 'Hotel successfully deleted.'
        ]);
    }
}
