@extends('visitor.layout.mainlayout')
@section('title', 'FAQs')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <p class="text-white">We are a registered non-profit, charitable organization that connects people to meaningful volunteer opportunities, provides community information and services.</p>
        </div>
    </section>


    <section class="faq_wrapp d-padding">
    <div class="container">
        <div class="accordion" id="accordionExample">
            @if (count($faqs) > 0)
                @foreach ($faqs as $key => $faq)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="{{"heading".$key}}">
                            <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{"collapse".$key}}" aria-expanded="{{ $key == 0 ? 'true' : '' }}" aria-controls="{{"collapse".$key}}">
                                {{$faq->question}}
                            </button>
                        </h2>
                        <div id="{{"collapse".$key}}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="{{"heading".$key}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>{{$faq->answer}}</p>
                        </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="p-5 text-center">No FAQ Found ...</p>
            @endif
        </div>
    </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
