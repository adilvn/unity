@extends('visitor.layout.mainlayout')
@section('title', 'Contact Us')
@section('content')
    <section class="contact_wrapp d-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="contact_left">
                        <h2 class="mb-3">Contact Us for any questions !</h2>
                        @if(isset($contactInfo))
                        <p>{{ $contactInfo->brief_detail }}</p>
                        <ul>
                            <li><b>Visit Us:</b> {{ $contactInfo->address }}</li>
                            <li><b>Call Us:</b> <a href="tel:{{ $contactInfo->ph_no }}">{{ $contactInfo->ph_no }}</a></li>
                            <li><b>Email Us:</b> <a href="mailto:{{ $contactInfo->email }}">{{ $contactInfo->email }}</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact_form ps-md-5 ps-0">
                        <h2 class="mb-3">Leave a Reply</h2>
                        <form action="{{ route('save-query') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
                                <label for="Name">Enter Your Name</label>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address">
                                <label for="email">Enter Your Email Address</label>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="message" class="form-control" placeholder="Your Message" rows="5"></textarea>
                                <label for="Message">Your Message</label>
                                @error('message')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="site-btn-4 btn-common">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map_section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d767887.0585831219!2d-2.5343357367965837!3d54.95879814393793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x25a3b1142c791a9%3A0xc4f8a0433288257a!2sUnited%20Kingdom!5e0!3m2!1sen!2sin!4v1631525134322!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
@endsection

@section('bodyExtra')
<script>
    $(function() {
        @if (Session::has('save-query'))
            toastr.options = {
            'timeOut': '3000',
            'closeButton': true,
            'progressBar': true,
            }
            toastr.success("{{ Session::get('save-query') }}");
        @endif
    });
</script>
@endsection
