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
        $request->validate(
            [
                'question' => 'required',
                'answer' => 'required'
            ],
            [
                'question.required' => 'You must enter the question',
                'answer.required' => 'Please answer the question'
            ]
        );

        $faqs = faqs::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => 1,
        ]);
        $request->session()->flash('save-faq', 'FAQ created successfully!');
        return redirect()->back();
    }

    public function editFaq($id)
    {
        $faq = faqs::find($id);
        return view('admin.content.faq-new', compact('faq'));
    }

    public function updateFaq(Request $request, $id)
    {
        $request->validate(
            [
                'question' => 'required',
                'answer' => 'required'
            ],
            [
                'question.required' => 'You must enter the question',
                'answer.required' => 'Please answer the question'
            ]
        );

        $faq = faqs::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = 1;
        $faq->update();

        $request->session()->flash('update-faq', 'FAQ updated successfully!');
        return redirect()->route('get-faqs');
    }

    public function updateFaqStatus($id)
    {
        $faq = faqs::find($id);
        if (!is_null($faq)) {
            if ($faq->status == 1) {
                $faq->status = 0;
                $faq->update();
                return redirect()->route('get-faqs');
            } else if ($faq->status == 0) {
                $faq->status = 1;
                $faq->update();
                return redirect()->route('get-faqs');
            }
        } else {
            return redirect()->route('get-faqs');
        }
    }

    public function deleteFaq(Request $request, $id)
    {
        $faq = faqs::find($id);
        $faq->delete();

        $request->session()->flash('delete-faq', 'FAQ has been deleted successfully!');
        return redirect()->back();
    }

    public function showFaqs()
    {
        $faqs = faqs::where('status', 1)->orderBy('id', 'DESC')->get();
        $gallery = Gallery::where('status', 1)->get();
        return view('visitor.content.faqs', compact('faqs', 'gallery'));
    }
}
