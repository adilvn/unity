<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\ContactUsQueries;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showContactQueries()
    {
        $queries = ContactUsQueries::all();
        return view('admin.content.contactQueries', compact('queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveQuery(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:100'
            ],
            [
                'name.required' => 'Tell us your name',
                'email.required' => 'Email is Required',
                'message.required' => 'Please write something',
            ]);

        $query = ContactUsQueries::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        $request->session()->flash('save-query', 'Your query has been sent successfully!');
        return redirect()->route('contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteQuery(Request $request, $id)
    {
        $query = ContactUsQueries::findOrFail($id);
        $query->delete();

        $request->session()->flash('delete-query', 'Query has been deleted successfully!');
        return redirect()->back();
    }

    public function addContactInfo()
    {
        $contactInfo = ContactInfo::where('id', 1)->first();
        return view('admin.content.contactInfo', compact('contactInfo'));
    }

    public function contactInfo(Request $request)
    {
        $request->validate([
            'detail' => 'required|max:300',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ],
        [
            'detail.required' => 'Please enter brief detail',
            'address.required' => 'Address is required',
            'phone.required' => 'Phone number is required',
            'email.required' => 'Email is required'
        ]);

        ContactInfo::updateOrCreate([
            'id' => $request->id
        ],
        [
            'brief_detail' => $request->detail,
            'address' => $request->address,
            'ph_no' => $request->phone,
            'email' => $request->email,
            'status' => 1,
        ]);

        $request->session()->flash('save-contact-info', 'Contact details updated successfully!');
        return redirect()->back()->withInput();
    }

}
