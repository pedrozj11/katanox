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
        $todo = new Room();
        $todo->text = $request->get('text');
        $todo->save();

        return response()->json([
            'message' => 'Room successfully created.'
        ]);
    }

    public function delete(Request $request)
    {
        $todo = Room::find($request->get('id'));
        $todo->delete();

        return response()->json([
            'message' => 'Room successfully deleted.'
        ]);
    }
}
