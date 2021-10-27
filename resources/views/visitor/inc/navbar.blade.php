<header class="header-main">
    <div class="header-top-part bg-blue">
      <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/unity-logo.png')}}"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : ''}}" href="{{route('home')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : ''}}" href="{{route('about')}}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('get-gestures') ? 'active' : ''}}" href="{{route('get-gestures')}}">Gestures</a>
              </li>
               <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : ''}}" href="{{route('contact')}}">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('get-cart') ? 'active' : ''}}" href="{{route('get-cart')}}">Cart</a>
              </li>
              @if (Auth::user() != null)
                @if (Auth::user()->user_type == 3 || Auth::user()->user_type == 4)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->user_type == 4)
                                <li><a class="dropdown-item" href="{{route('business-profile')}}">Business Profile</a></li>
                            @endif
                            @if (Auth::user()->user_type == 3)
                            <li><a class="dropdown-item" href="{{route('donator-profile')}}">Donator Profile</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
              @endif
              <li class="nav-item">
                <div class="site-btn-1 btn-common">
                  @if (Auth::user() != null)
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                  @else
                    <a href="{{route('login-page')}}">SignUp/Login</a>
                  @endif
                </div>
              </li>
            </ul>
            <div id="bottom-top-part-toggle" class="my-sm-0 my-3">
            <hr/>
        <form action="{{route('search-donators')}}" method="POST">
                @csrf
                <div class="left-search my-sm-0 my-3">
                    <input type="search" name="search_text" placeholder="Search Donators">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </div>
        </form>
           <div class="right-social text-center ">
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
       </div>
      </nav>
    </div>
    <div class="bottom-top-part">
        <div class="container">
          <div class="bottom-part-wrap">
                <form action="{{route('search-donators')}}" method="POST">
                    @csrf
                    <div class="left-search">
                        <input type="search" name="search_text" placeholder="Search Donators">
                        <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                    </div>
                </form>
              <div class="right-social">
                <ul>
                    <li><a href="https://pinterest.com"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://youtube.com"><i class="fab fa-youtube"></i></a></li>
                </ul>
                <!-- <div class="shopping_cart">
                  <a href="cart.php"><img src="images/shopping-bag.png" alt=""></a>
                  <span class="bedge">0</span>
                </div> -->
              </div>
          </div>
        </div>
    </div>
</header>
