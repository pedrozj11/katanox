<?php

namespace App\Http\Controllers;

use App\Http\Resources\Booking as BookingResource;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    /**
     * Get bookings.
     *
     * Retrieve all bookings
     *
     */
    public function index(Request $request)
    {
        return BookingResource::collection(Booking::paginate());
    }

     /**
     * Get booking.
     *
     * Get a single booking by id
     *
     */
    public function show(Request $request)
    {
        return new BookingResource(Booking::findOrFail($request->route('id')));
    }

     /**
     * Booking creation.
     *
     * Create a booking
     *
     */
    public function store(Request $request)
    {
        $booking = new Booking();

        $room = Room::find($request->get('room_id'));
        if(!$room){
            return response()->json([
                'error' => 'Room does not exist.'
            ]);
        }

        $user = User::find($request->get('user_id'));
        if(!$user){
            return response()->json([
                'error' => 'User does not exist.'
            ]);
        }
        $room_price = $room->price;

        $checkIn = new DateTime($request->get('checkin'));
        $checkout = new DateTime( $request->get('checkout'));
        $days = $checkIn->diff($checkout)->format('%a');

        $price = $request->get('people')*$room_price*$days;
        $booking->price =  $price;
        $booking->people = $request->get('people');
        $booking->booked_by = $request->get('user_id');
        $booking->room_id = $request->get('room_id');
        $booking->checkin = $request->get('checkin');
        $booking->checkout = $request->get('checkout');

        $booking->save();
        
        return response()->json([
            'id' => $booking->id,
            'message' => 'Booking successfully created.'
        ]);
    }

     /**
     * Edit booking.
     *
     * Edit a booking with id
     *
     */
    public function edit(Request $request)
    {
        
        $booking = Booking::find($request->route('id'));

        $room = Room::find($request->get('room_id'));
        if(!$room){
            return response()->json([
                'error' => 'Room does not exist.'
            ]);
        }
        $room_price = $room->price;

        $checkIn = new DateTime($request->get('checkin'));
        $checkout = new DateTime( $request->get('checkout'));
        $days = $checkIn->diff($checkout)->format('%a');

        $price = $request->get('people')*$room_price*$days;
        $booking->price =  $price;
        $booking->people = $request->get('people');
        $booking->booked_by = $request->get('user_id');
        $booking->checkin = $request->get('checkin');
        $booking->checkout = $request->get('checkout');

        $booking->save();
        
        return response()->json([
            'id' => $booking->id,
            'message' => 'Booking successfully created.'
        ]);
    }

     /**
     * Delete booking.
     *
     * Delete a booking by id
     *
     */
    public function delete(Request $request)
    {
        $booking = Booking::find($request->get('id'));
        $booking->delete();

        return response()->json([
            'message' => 'Booking successfully deleted.'
        ]);
    }
}
