<?php

namespace App\Http\Controllers;

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

}
