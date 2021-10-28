<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCareers()
    {
        $careers = Career::all();
        return view('admin.content.career', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCareer()
    {
        return view('admin.content.career-new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCareer(Request $request)
    {
        $request->validate(
            [
                'position' => 'required',
                'location' => 'required',
                'type' => 'required'
            ],
            [
                'position.required' => 'Career position is required',
                'location.required' => 'Location is required',
                'type.required' => 'Type is required'
            ]
        );

        $career = Career::create([
            'position' => $request->position,
            'location' => $request->location,
            'type' => $request->type,
            'status' => 1,
        ]);
        $request->session()->flash('save-career', 'Career created successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function editCareers($id)
    {
        $career = Career::find($id);
        return view('admin.content.career-new', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function updateCareer(Request $request, $id)
    {
        $request->validate(
            [
                'position' => 'required',
                'location' => 'required',
                'type' => 'required'
            ],
            [
                'position.required' => 'Career position is required',
                'location.required' => 'Location is required',
                'type.required' => 'Type is required'
            ]
        );

        $career = Career::find($id);
        $career->position = $request->position;
        $career->location = $request->location;
        $career->type = $request->type;
        $career->status = 1;
        $career->update();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function updateCareerStatus($id)
    {
        $career = Career::find($id);
        if (!is_null($career)) {
            if ($career->status == 1) {
                $career->status = 0;
                $career->update();
                return redirect()->route('get-careers');
            } else if ($career->status == 0) {
                $career->status = 1;
                $career->update();
                return redirect()->route('get-careers');
            }
        } else {
            return redirect()->route('get-careers');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function deleteCareer(Request $request, $id)
    {
        $career = Career::find($id);
        $career->delete();

        $request->session()->flash('delete-career', 'Career has been deleted successfully!');
        return redirect()->back();
    }
}
