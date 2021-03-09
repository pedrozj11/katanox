<?php

namespace App\Http\Controllers;

use App\Http\Resources\Room as RoomResource;
use App\Http\Resources\RoomCollection;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        return RoomResource::collection(Room::paginate());
    }

    public function show(Request $request)
    {
        return new RoomResource(Room::findOrFail($request->route('id')));
    }

    public function store(Request $request)
    {
        $room = new Room();

        $room->number = $request->get('number');
        $room->beds = $request->get('beds');
        $room->booked = $request->get('booked');
        $room->hotel_id = $request->get('hotel_id');

        $room->save();
        
        return response()->json([
            'id' => $room->id,
            'message' => 'Room successfully created.'
        ]);
    }

    public function edit(Request $request)
    {
        $room = Room::find($request->route('id'));

        $room->number = $request->get('number');
        $room->beds = $request->get('beds');
        $room->booked = $request->get('booked');
        $room->hotel_id = $request->get('hotel_id');

        $room->save();
        
        return response()->json([
            'id' => $room->id,
            'message' => 'Room successfully edited.'
        ]);
    }

    public function delete(Request $request)
    {
        $room = Room::find($request->get('id'));
        $room->delete();

        return response()->json([
            'message' => 'Room successfully deleted.'
        ]);
    }
}
