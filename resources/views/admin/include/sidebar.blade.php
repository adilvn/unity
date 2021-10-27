<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html">
                        {{-- <img src="{{ asset('adminAssets/images/logo/unity-logo.png')}}" alt="Logo" srcset=""> --}}
                        <h3>Unity</h3>
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ request()->routeIs('admin-dashboard') ? 'active' : ''}}">
                    <a href="{{ route('admin-dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->user_type == 0)
                <li class="sidebar-item  has-sub {{ request()->is('admin/users*') ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Admins & Users</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->is('admin/users*') ? 'block' : 'none'}};">
                        <li class="submenu-item {{ request()->routeIs('get-admins') ? 'active' : ''}}">
                            <a href="{{route('get-admins')}}">Admins</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('show-donators') ? 'active' : ''}}">
                            <a href="{{ route('show-donators') }}">Donators</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('show-businesses') ? 'active' : ''}}">
                            <a href="{{ route('show-businesses') }}">Businesses</a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="sidebar-item  has-sub {{ request()->is('admin/career*') ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-briefcase-fill"></i>
                        <span>Career</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->is('admin/career*') ? 'block' : 'none'}};">
                        <li class="submenu-item {{ request()->routeIs('get-careers') ? 'active' : ''}}">
                            <a href="{{route('get-careers')}}">All Careers</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('add-career') ? 'active' : ''}}">
                            <a href="{{route('add-career')}}">Add New Career</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub {{ request()->is('admin/faqs*') ? 'active' : ''}}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-patch-question-fill"></i>
                        <span>FAQs</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->is('admin/faqs*') ? 'block' : 'none'}};">
                        <li class="submenu-item {{ request()->routeIs('get-faqs') ? 'active' : ''}}">
                            <a href="{{route('get-faqs')}}">All FAQs</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('add-faq') ? 'active' : ''}}">
                            <a href="{{route('add-faq')}}">Add New FAQ</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item ">
                    <form action="{{route('admin-logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center gap-1"><i class="bi bi-box-arrow-in-left"></i> Logout</button>
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
