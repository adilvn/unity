<?php

namespace App\Http\Controllers;

use App\Models\faqs;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function getFaqs()
    {
        $faqs = faqs::all();
        return view('admin.content.faqs', compact('faqs'));
    }

    public function addFaq()
    {
        return view('admin.content.faq-new');
    }

    public function saveFaq(Request $request)
    {

    }

    public function editFaq($id)
    {

    }

    public function updateFaq(Request $request)
    {

    }

    public function updateFaqStatus($id)
    {

    }

    public function deleteFaq($id)
    {

    }

    public function showFaqs()
    {
        $faqs = faqs::where('status', 1)->get();
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.faqs', compact('faqs', 'gallery'));
    }

}
