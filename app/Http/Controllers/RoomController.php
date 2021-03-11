<?php

namespace App\Http\Controllers;

use App\Http\Resources\Room as RoomResource;
use App\Http\Resources\RoomCollection;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Get rooms.
     *
     * Retrieve all rooms
     *
     */
    public function index(Request $request)
    {
        if($request->get('booked')){
            //$bookings = Booking::find()->where('checkout', '<', new DateTime('now'))->get();         
            $sing_comp = $request->get('booked') === 1 ? '>' : '<';
            $rooms = Room::whereHas('bookings', function (Builder $query) use ($sing_comp) {
                $query->where('checkout', $sing_comp, new DateTime('now'));
            })->paginate();
            return RoomResource::collection($rooms);
        }
        return RoomResource::collection(Room::paginate());
    }

     /**
     * Get room.
     *
     * Get a single room by id
     *
     */
    public function show(Request $request)
    {
        return new RoomResource(Room::findOrFail($request->route('id')));
    }

     /**
     * Room creation.
     *
     * Create a room
     *
     */
    public function store(Request $request)
    {
        $room = new Room();

        $room->number = $request->get('number');
        $room->beds = $request->get('beds');
        $room->price = $request->get('price');
        $room->hotel_id = $request->get('hotel_id');

        $room->save();
        
        return response()->json([
            'id' => $room->id,
            'message' => 'Room successfully created.'
        ]);
    }

     /**
     * Edit room.
     *
     * Edit a room with id
     *
     */
    public function edit(Request $request)
    {
        $room = Room::find($request->route('id'));

        $hotel = Hotel::find($request->get('hotel_id'));
        if(!$hotel){
            return response()->json([
                'error' => 'Hotel does not exist.'
            ]);
        }
        $room->number = $request->get('number');
        $room->beds = $request->get('beds');
        $room->price = $request->get('price');
        $room->hotel_id = $request->get('hotel_id');

        $room->save();
        
        return response()->json([
            'id' => $room->id,
            'message' => 'Room successfully edited.'
        ]);
    }

     /**
     * Delete room.
     *
     * Delete a room by id
     *
     */
    public function delete(Request $request)
    {
        $room = Room::find($request->get('id'));
        $room->delete();

        return response()->json([
            'message' => 'Room successfully deleted.'
        ]);
    }
}
