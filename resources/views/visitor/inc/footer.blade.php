<footer class="site-footer bg-blue">
    <div class="container">
        <div class="row">
            <div class="footer-col-1 col-lg-4  col-12">
               <div class="footer-wrap text-lg-start text-center">

                    <a href="{{route('home')}}">
                        <img src="{{asset('images/unity-logo.png')}}">
                    </a>

                    <div class="footer-text footer-common-gap">
                        <p>Harum distinctio pariatur ad asperiores praesent, viverra sociosqu omnis! Ante, leo sem? Ipsam blanditiis quae tincidunt, wisi nulla blanditiis non? Eget repellat debitis laborum.</p>
                    </div>
                    <div class="right-social footer-common-gap">
                        <ul>
                          <li><a href="https://pinterest.com"><i class="fab fa-pinterest-p"></i></a></li>
                          <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                          <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                          <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                          <li><a href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="footer-col-2 col-sm-6 col-12 ">
                        <div class="footer-wrap footer-menu text-md-start text-center">
                            <h2>Quick Links</h2>
                            <ul>
                                <li><a href="{{route('get-gestures')}}">Gestures</a></li>
                                <li><a href="{{route('about')}}">About</a></li>
                                <!-- <li><a href="donations.php">Donation</a></li> -->
                                <li><a href="{{route('login-page')}}">My Donation</a></li>
                                <li><a href="{{route('get-donators')}}">Donators</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class=" footer-col-3 col-sm-6 col-12 ">
                        <div class="footer-wrap footer-menu text-md-start text-center">
                            <h2>Company</h2>
                            <ul>
                                <li><a href="{{route('show-careers')}}">Career</a></li>
                                <li><a href="{{route('show-faqs')}}">Faq's</a></li>
                                <li><a href="{{route('show-blog')}}">Blog</a></li>
                                <li><a href="{{route('contact')}}">Contact Us</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 ">
                <div class="row">
                    <div class="footer-col-4 col-xl-6 col-lg-12 col-sm-6">
                        <div class="footer-wrap footer-menu text-md-start text-center">
                            <h2>Support</h2>
                            <ul>
                                <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('terms')}}">Terms and Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                <div class="footer-col-5   col-xl-6 col-lg-12 col-sm-6 ">
                    <div class="footer-wrap text-md-start text-center">
                        @if (Auth::user() == null)
                            <div class="site-btn-1 btn-common">
                                <a href="{{route('register-page')}}">Sign Up</a>
                            </div>
                        @endif
                        <div class="site-btn-2 btn-common mtop-15">
                            <a href="{{route('get-gestures')}}">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class=" text-center mt-5">
        <p>Copyright © Unity All rights reserved</p>
    </div>
</footer>
