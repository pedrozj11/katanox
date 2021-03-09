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
        $todo = new Hotel();
        $todo->text = $request->get('text');
        $todo->save();

        return response()->json([
            'message' => 'Room successfully created.'
        ]);
    }

    public function delete(Request $request)
    {
        $todo = Hotel::find($request->get('id'));
        $todo->delete();

        return response()->json([
            'message' => 'Room successfully deleted.'
        ]);
    }
}
