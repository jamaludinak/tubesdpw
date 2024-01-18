<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Booking;
use DB;

class BookingController extends Controller
{
    public function getTotalRent()
    {
        $totalRent = Booking::sum('rent');
        return $totalRent;
    }
    public function getTotalBooking()
    {
        $totalBooking = Booking::count();
        return $totalBooking;
    }
    // view page all booking
    public function allbooking()
    {
        $allBookings = DB::table('bookings')->get();
        return view('formbooking.allbooking', compact('allBookings'));
    }

    // booking add
    // booking add
    public function bookingAdd()
    {
        try {
            $data = DB::table('rooms')->get();
            $user = DB::table('customers')->get();
            $type = DB::table('room_types')->get();
            return view('formbooking.bookingadd', compact('data', 'user', 'type'));
        } catch (\Exception $e) {
            Toastr::error('Error fetching booking data: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    // booking edit
    public function bookingEdit($bkg_id)
    {
        $data = DB::table('rooms')->get();
        $type = DB::table('room_types')->get();
        $bookingEdit = DB::table('bookings')->where('bkg_id', $bkg_id)->first();
        return view('formbooking.bookingedit', compact('bookingEdit', 'data', 'type'));
    }

    // booking save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'room'     => 'required|string|max:255',
            'total_numbers' => 'required|string|max:255',
            'rent' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'arrival_date'  => 'required|string|max:255',
            'depature_date' => 'required|string|max:255',
            'message'    => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $booking = new Booking;
            $booking->name = $request->name;
            $booking->room     = $request->room;
            $booking->total_numbers  = $request->total_numbers;
            $booking->rent  = $request->rent;
            $booking->date  = $request->date;
            $booking->time  = $request->time;
            $booking->arrival_date   = $request->arrival_date;
            $booking->depature_date  = $request->depature_date;
            $booking->message     = $request->message;
            $booking->save();

            DB::commit();
            Toastr::success('Create new booking successfully :)', 'Success');
            return redirect()->route('form/allbooking');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Booking fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            $update = [
                'bkg_id' => $request->bkg_id,
                'name'   => $request->name,
                'room'  => $request->room,
                'total_numbers' => $request->total_numbers,
                'rent' => $request->rent,
                'date'   => $request->date,
                'time'   => $request->time,
                'arrival_date'   => $request->arrival_date,
                'depature_date'  => $request->depature_date,
                'message'   => $request->message,
            ];

            Booking::where('bkg_id', $request->bkg_id)->update($update);

            DB::commit();
            Toastr::success('Updated booking successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update booking fail :)', 'Error');
            return redirect()->back();
        }
    }

    // delete record booking
    public function deleteRecord(Request $request)
    {
        try {

            Booking::destroy($request->id);
            Toastr::success('Booking deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Booking delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
