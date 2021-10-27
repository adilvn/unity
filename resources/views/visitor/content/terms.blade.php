@extends('visitor.layout.mainlayout')
@section('title', 'Terms & Conditions')
@section('content')
    <section class="inner_header gestures">
        <div class="container">
            <h2>Terms & Condtions</h2>
        </div>
    </section>

    <section class="blog d-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog_detail_wrapp">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed varius, sapien eu aliquet rhoncus, tellus ante finibus magna, id aliquam augue erat ac justo. Nulla pretium arcu quis sem sagittis sagittis. Donec volutpat nisl eu massa placerat hendrerit. Nunc vel dignissim sapien. Nam justo est, consequat at facilisis porta, fringilla ut lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam eget enim vitae nibh tincidunt faucibus vel a velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam imperdiet, nulla vitae posuere mollis, ligula elit mattis sapien, ac viverra magna augue non metus. Nunc rhoncus, ex eu placerat eleifend, sem mi laoreet mauris, at pharetra ligula neque at ligula. Nunc porta mi a leo ullamcorper, sed varius nulla ultrices. Nam sit amet eros est. Nullam semper elit eget mauris eleifend condimentum. Suspendisse tortor orci, rhoncus eget mollis vel, convallis nec nunc.

                            Duis quis sapien sit amet tellus pretium luctus sit amet vel enim. Morbi euismod metus est, at tempus ligula varius a. Praesent at leo massa. Proin bibendum et nibh ut maximus. Fusce ex tortor, euismod ac pharetra sed, luctus efficitur nulla. Integer vulputate lobortis diam ac accumsan. Vestibulum imperdiet feugiat lacus. Maecenas fringilla, risus et ornare tincidunt, mi neque suscipit sapien, at faucibus erat ligula nec tortor. Etiam sollicitudin risus dignissim, vestibulum sem vitae, laoreet risus. Donec at leo vitae justo ultricies fermentum ac et nisl. Morbi est nisl, convallis sit amet ex eu, egestas dignissim libero. Duis egestas tellus eget tincidunt feugiat.

                            Morbi porttitor orci ut magna laoreet tristique. Proin condimentum, odio sed faucibus mattis, magna leo tristique ipsum, vel sagittis lectus dui nec enim. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla mollis, neque vitae sollicitudin laoreet, lectus ex fermentum purus, lobortis hendrerit odio tellus eget turpis. Vestibulum convallis neque eget lacus scelerisque, in eleifend sem blandit. Quisque aliquet ultrices purus, eget consequat velit suscipit a. Sed tempus, arcu vitae consectetur luctus, lectus augue fringilla purus, eu faucibus odio justo ac lacus. Quisque fermentum magna sed sodales ultricies. Praesent convallis odio vel faucibus bibendum. Morbi varius risus nec nisi molestie, et laoreet est porta. Suspendisse sed eros non nisl feugiat condimentum.

                            Aenean augue leo, congue interdum nisi ac, ullamcorper suscipit mi. Curabitur sit amet velit facilisis, tempor felis at, faucibus felis. Praesent vitae nisl ultricies, sollicitudin lacus vel, convallis massa. Donec tincidunt risus posuere elementum hendrerit. Vestibulum congue mi est, a cursus metus commodo accumsan. Praesent blandit id nisi porttitor euismod. Maecenas vestibulum vel elit tempus volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a sem vulputate, viverra nulla nec, congue nibh. Quisque ex turpis, porttitor id ipsum ut, efficitur pretium justo. Suspendisse posuere turpis a mauris sagittis, a congue lectus fermentum. Nunc sit amet neque tempus, cursus orci et, auctor felis. Ut semper sagittis arcu. Morbi rutrum metus id lacus cursus bibendum. Morbi cursus eros ac dignissim commodo.

                            Donec enim risus, dignissim sed facilisis ac, tempor auctor odio. Nullam dolor erat, mattis quis imperdiet vitae, ornare in mauris. Nullam eu lorem sed dolor finibus pellentesque non non augue. Sed ullamcorper orci non nunc semper porta. Vestibulum gravida, nisl finibus dignissim maximus, lorem nunc feugiat neque, tristique laoreet tellus diam non nulla. Nullam non justo nec justo tempus posuere. In sollicitudin a felis in fringilla. Sed non quam quis elit pulvinar facilisis. Ut suscipit pulvinar diam.
                        </p>
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
