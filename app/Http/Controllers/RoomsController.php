<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class RoomsController extends Controller
{
    public function getTotalRooms()
    {
        $totalRooms = Room::count();
        return $totalRooms;
    }
    // index page
    public function allrooms()
    {
        $allRooms = DB::table('rooms')->get();
        return view('room.allroom',compact('allRooms'));
    }
    // add room page
    public function addRoom()
    {
        $data = DB::table('room_types')->get();
        return view('room.addroom',compact('data'));
    }
    // edit room
    public function editRoom($bkg_room_id)
    {
        $roomEdit = DB::table('rooms')->where('bkg_room_id',$bkg_room_id)->first();
        $data = DB::table('room_types')->get();
        $user = DB::table('users')->get();
        return view('room.editroom',compact('user','data','roomEdit'));
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
            Toastr::success('Create new room successfully :)','Success');
            return redirect()->route('form/allrooms/page');
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Room fail :)','Error');
            return redirect()->back();
        }
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            $update = [
                'bkg_room_id' => $request->bkg_room_id,
                'name'   => $request->name,
                'room_type'  => $request->room_type,
                'phone_number' => $request->phone_number,
            ];
            Room::where('bkg_room_id',$request->bkg_room_id)->update($update);
        
            DB::commit();
            Toastr::success('Updated room successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update room fail :)','Error');
            return redirect()->back();
        }
    }

    // delete record
    public function deleteRecord(Request $request)
    {
        try {

            Room::destroy($request->id);
            unlink('assets/upload/'.$request->fileupload);
            Toastr::success('Room deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Room delete fail :)','Error');
            return redirect()->back();
        }
    }
}
