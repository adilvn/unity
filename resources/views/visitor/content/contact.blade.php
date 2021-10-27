@extends('visitor.layout.mainlayout')
@section('title', 'Contact Us')
@section('content')
    <section class="contact_wrapp d-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-5 mb-md-0">
                    <div class="contact_left">
                        <h2 class="mb-3">Contact Us for any questions !</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu maximus ante, eget sollicitudin metus. Sed fringilla efficitur fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere</p>
                        <ul>
                            <li><b>Visit Us:</b> 92 Bowery St., New York, NY 10013, USA</li>
                            <li><b>Call Us:</b> <a href="tel:0123 456 789">0123 456 789</a></li>
                            <li><b>Email Us:</b> <a href="mailto:contact@unity.com">contact@unity.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact_form ps-md-5 ps-0">
                        <h2 class="mb-3">Leave a Reply</h2>
                        <form action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Enter Your Name">
                                <label for="YourName">Enter Your Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" placeholder="Enter Your Email Address">
                                <label for="email">Enter Your Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Your Message" rows="5"></textarea>
                                <label for="Message">Your Message</label>
                            </div>
                            <div class="site-btn-4 btn-common">
                                <a href="#">Submit</a>
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
