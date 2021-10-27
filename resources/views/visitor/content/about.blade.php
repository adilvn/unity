@extends('visitor.layout.mainlayout')
@section('title', 'About Us')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>About Us</h2>
            <p class="text-white">It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some groceries, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
        </div>
    </section>

    <section class="about_wrapp d-padding">
        <div class="container">
            <div class="title_main text-center">
                <h3>Help is our Goal</h3>
                <h2 class="mb-4">What Make Us Different</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-3">
                    <div class="about_wrapp_box text-center">
                        <img src="{{asset('images/about1.png')}}" alt="">
                        <h4>We Educate</h4>
                        <p>We help local nonprofits access the funding, tools, training, and support they need</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-3">
                    <div class="about_wrapp_box text-center">
                        <img src="{{asset('images/about2.png')}}" alt="">
                        <h4>We Help</h4>
                        <p>We help local nonprofits access the funding, tools, training, and support they need</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-sm-0 mb-3">
                    <div class="about_wrapp_box text-center">
                        <img src="{{asset('images/about3.png')}}" alt="">
                        <h4>We Build</h4>
                        <p>We help local nonprofits access the funding, tools, training, and support they need</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-sm-0 mb-3">
                    <div class="about_wrapp_box text-center">
                        <img src="{{asset('images/about4.png')}}" alt="">
                        <h4>We Donate</h4>
                        <p>We help local nonprofits access the funding, tools, training, and support they need</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about_wrapp_two">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h2 class="text-white mb-4">Each donation is an essential help which improves everyone's life</h2>
                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec lobortis diam. Pellentesque nec enim ipsum. Fusce ex nisi, efficitur vel odio eu, egestas mattis .</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about_wrapp_three d-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="about_wrapp_three_img pe-5">
                        <img src="{{asset('images/aboutimg2.jpg')}}" alt="">
                        <div class="about_wrapp_three_box">
                            <img src="{{asset('images/icon-white.png')}}" alt="">
                            <h3>+76 <span>DONATIONS</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_wrapp_three_text ps-md-5 ps-0">
                        <div class="title_main text-start">
                            <h3>A help to those who need it</h3>
                            <h2 class="mb-4">Each donation is an essential help which improves everyone's life</h2>
                        </div>
                        <p>Quisque eu euismod arcu. Morbi et dapibus diam, sed interdum velit. Proin tempor nunc vel nisl condimentum, nec tempor risus lacinia.</p>
                        <p>Suspendisse a cursus magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas non metus ipsum. Integer elementum enim urna.</p>
                        <p>Curabitur a fringilla eros. Pellentesque eu interdum nulla. Pellentesque porttitor dui nec leo condimentum, et euismod mi mollis.</p>
                        <p>Vulputate orci, et ultrices tellus rutrum mollis. Fusce a eros tellus. Ut vitae risus sit amet nisl blandit rutrum quis ac enim. Etiam congue at.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('visitor.inc.cta')
    @include('visitor.inc.gallery')
@endsection
