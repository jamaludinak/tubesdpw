<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class CustomerController extends Controller
{
    public function getTotalCustomers()
    {
        $totalCustomers = Customer::count();
        return $totalCustomers;
    }
    // view page all customer
    public function allCustomers()
    {
        $allCustomers = DB::table('customers')->get();
        return view('formcustomers.allcustomers',compact('allCustomers'));
    }

    // add Customer
    public function addCustomer()
    {
        $data = DB::table('room_types')->get();
        $user = DB::table('users')->get();
        return view('formcustomers.addcustomer',compact('data','user'));
    }
    // save record
    public function saveCustomer(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'      => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
           
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email       = $request->email;
            $customer->ph_number   = $request->phone_number;
            $customer->save();
            
            DB::commit();
            Toastr::success('Create new customer successfully :)','Success');
            return redirect()->route('form/allcustomers/page');
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Customer fail :)','Error');
            return redirect()->back();
        }
    }

    // customer edit
    public function updateCustomer($bkg_customer_id)
    {
        $customerEdit = DB::table('customers')->where('bkg_customer_id',$bkg_customer_id)->first();
        return view('formcustomers.editcustomer',compact('customerEdit'));
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->fileupload)) {
                $photo = $request->fileupload;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/upload/'), $file_name);
            } else {
                $file_name = $request->hidden_fileupload;
            }

            $update = [
                'bkg_customer_id' => $request->bkg_customer_id,
                'name'   => $request->name,
                'email'   => $request->email,
                'ph_number' => $request->phone_number,
            ];
            Customer::where('bkg_customer_id',$request->bkg_customer_id)->update($update);
        
            DB::commit();
            Toastr::success('Updated customer successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update customer fail :)','Error');
            return redirect()->back();
        }
    }
    // delete record
    public function deleteRecord(Request $request)
    {
        try {

            Customer::destroy($request->id);
            unlink('assets/upload/'.$request->fileupload);
            Toastr::success('Customer deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Customer delete fail :)','Error');
            return redirect()->back();
        }
    }

}
