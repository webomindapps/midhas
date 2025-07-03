<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function viewprofile()
    {
        $address = OrderAddress::where('customer_id', Auth::user()->id)->first();
        return view('frontend.pages.profile.account-info', compact('address'));
    }
    public function details()
    {
        $customer = Auth::user();
        return view('frontend.pages.profile.customer-details', compact('customer'));
    }
    public function storedetails(Request $request)
    {

        $customer = Auth::user();

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        return redirect()->back()->with('message', 'Customer Updated Successfully');
    }
    public function forgotpassword()
    {
        return view('frontend.pages.profile.forgot-password');
    }
    public function resetpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|same:conf_password',
            'conf_password' => 'required',
        ]);
        $customer = Auth::user();
        $customer->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('message', 'Password Updated!');
    }
    public function addressbook()
    {
        $customer_id = Auth::user()->id;
        $address = OrderAddress::where('customer_id', $customer_id)->get();
        return view('frontend.pages.profile.address-book', compact('address'));
    }
    public function editaddress($id)
    {
        $address = OrderAddress::findOrFail($id);
        return view('frontend.pages.profile.edit-address', compact('address'));
    }
    public function updateaddress(Request $request, $id)
    {
        $request->validate([
            'firstname'     => 'required|string|max:255',
            'lastname'      => 'required|string|max:255',
            'address_1'     => 'required|string|max:255',
            'address_2'     => 'nullable|string|max:255',
            'city'          => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'province'      => 'required|string|max:100',
            'phone_number'  => 'required|string|max:20',
        ]);


        $address = OrderAddress::findOrFail($id);


        $address->first_name     = $request->firstname;
        $address->last_name      = $request->lastname;
        $address->address_1     = $request->address_1;
        $address->address_2     = $request->address_2;
        $address->city          = $request->city;
        $address->postal_code   = $request->postal_code;
        $address->province      = $request->province;
        $address->phone_number  = $request->phone_number;


        $address->save();

        return redirect()->route('customer.address')->with('message', 'Address updated successfully!');
    }
    public function deleteaddress($id){
        $address = OrderAddress::findOrFail($id);
        $address->delete();
        return redirect()->route('customer.address')->with('message','address Deleted');
    }
}
