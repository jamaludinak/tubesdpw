<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomtype;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class RoomTypeController extends Controller
{
    public function getRentByRoom($room)
    {
        $rent = RoomType::where('room_name', $room)->first()->rent;
        return response()->json(['rent' => $rent]);
    }
    // index page
    public function allrooms()
    {
        $allRooms = DB::table('room_types')->get();
        return view('roomtype.allroomtype', compact('allRooms'));
    }
    // add room page
    public function addRoom()
    {
        $data = DB::table('room_types')->get();
        return view('room.addroom', compact('data'));
    }
    // edit room
    public function editRoom($bkg_room_id)
    {
        $roomtypeEdit = DB::table('room_types')->where('id', $bkg_room_id)->first();
        $data = DB::table('room_types')->get();
        return view('roomtype.editroomtype', compact('data', 'roomtypeEdit'));
    }
    // save record room
    public function saveRoom(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'room_type'     => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $room = new Room;
            $room->bkg_room_id  =
            $room->name         = $request->name;
            $room->room_type    = $request->room_type;
            $room->phone_number = $request->phone_number;
            $room->save();

            DB::commit();
            Toastr::success('Create new room successfully :)', 'Success');
            return redirect()->route('form/allrooms/page');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add Room fail :)', 'Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            $update = [
                'id' => $request->id,
                'food'  => $request->food,
                'bed_count' => $request->bed_count,
                'rent' => $request->rent,
            ];
            RoomType::where('id', $request->id)->update($update);

            DB::commit();
            Toastr::success('Updated room type successfully $update :)', 'Success',);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update room fail: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {

            Room::destroy($request->id);
            Toastr::success('Room deleted successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Room delete fail :)', 'Error');
            return redirect()->back();
        }
    }
}
