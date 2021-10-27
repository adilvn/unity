@extends('visitor.layout.mainlayout')
@section('title', 'Blog')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Latest Blog</h2>
            <p class="text-white">It’s no secret that what goes around comes around. Offer a kind gesture to someone in need and let that altruistic energy flow. A cup of coffee, some groceries, or just a safe place to sleep; you have the power to make a positive difference in someone's life.</p>
        </div>
    </section>

    <section class="blog d-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog_box mb-5">
                        <div class="blog_img">
                            <img src="{{asset('images/blog1.jpg')}}" alt="">
                        </div>
                        <h2><a href="{{route('show-blog-post')}}">POOR CHILDREN DONATION</a></h2>
                        <hr>
                        <ul>
                            <li>OCTOBER 20, 2021</li>
                            <li>BY ADMIN</li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut laoreet dolore. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                        <div class="site-btn-4 btn-common">
                            <a href="{{route('show-blog-post')}}">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="blog_sidebar">
                        <!-- <div class="search_wrapp w-100 mb-3">
                            <input type="search" class="form-control" placeholder="Search">
                            <button type="button" class="search_btn"><i class="fas fa-search"></i></button>
                        </div> -->
                        <div class="recent_news">
                            <h4 class="mb-3">Recent News</h4>
                            <div class="recent_news_inner">
                                <div class="recent_news_img">
                                    <img src="{{asset('images/blog1.jpg')}}" alt="">
                                </div>
                                <div class="recent_news_text">
                                    <h3><a href="{{route('show-blog-post')}}">POOR CHILDREN DONATION</a></h3>
                                    <p>October 20, 2021</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="category_blog">
                            <h4 class="mb-3">Categories</h4>
                            <ul>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Coffee</a></li>
                                <li><a href="#">Begs</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
