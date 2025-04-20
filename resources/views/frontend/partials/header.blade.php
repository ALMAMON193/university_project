@php
    use App\Models\CMS_Content;

    $header_cms = CMS_Content::all();
@endphp


<header data-aos="fade-down" data-aos-duration="1000">
    <div class="container">
        <div class="custom-row">
            <!-- logo  -->
            <a href="{{ route('home-page') }}" class="logo">
                <img src="{{ $header_cms[1]->image_url ? $header_cms[1]->image_url : asset('frontend/images/logo.svg') }}"
                    alt="logo" />
            </a>
            <!-- menu & search -->
            <div class="menu--search--wrapp">
                <!-- menu  -->
                <ul class="menu">
                    <li>
                        <a
                            href="{{ route('auction.page', ['year' => '*', 'model' => '*', 'make' => '*']) }}">Auctions</a>
                    </li>
                    {{-- <li>
                        <a href="#">Community</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('cars.bid.page') }}">What’s Cars & Bids ?</a>
                    </li>
                    {{-- <li>
                        <a href="#">Daily Email</a>
                    </li> --}}
                    {{-- user balance --}}

                    @guest
                        <li class="d-none mobile--login--btn">
                            <a href="{{ route('login') }}">Sign in</a>
                        </li>
                    @endguest
                    @auth
                        <li class="d-none mobile--login--btn">
                            <a href="{{ route('user.profile') }}">Profile ${{ auth()->user()->balance->balance ?? 0 }}</a>
                        </li>
                        @if (auth()->user()->role == 'admin')
                            <li class="d-none mobile--login--btn">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                        <li class="d-none mobile--logout--btn">
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>

                    @endauth
                </ul>
                <!-- search   -->
                <form action="{{route('search.auction')}}" method="GET">
                    @csrf
                    @method('GET')
                    <input type="text" name="search" placeholder="Search cars (Ex: Audi, Honda,Toyota)"
                        style="padding-left: 45px;" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19"
                        fill="none" class="search">
                        <path
                            d="M13.5233 12.9626L16.7353 16.1746L15.6746 17.2353L12.4626 14.0233C11.3077 14.9473 9.843 15.5 8.25 15.5C4.524 15.5 1.5 12.476 1.5 8.75C1.5 5.024 4.524 2 8.25 2C11.976 2 15 5.024 15 8.75C15 10.343 14.4473 11.8077 13.5233 12.9626ZM12.0185 12.4061C12.9356 11.4609 13.5 10.1717 13.5 8.75C13.5 5.84938 11.1506 3.5 8.25 3.5C5.34938 3.5 3 5.84938 3 8.75C3 11.6506 5.34938 14 8.25 14C9.6717 14 10.9609 13.4356 11.9061 12.5185L12.0185 12.4061Z"
                            fill="#5A5C5F" />
                    </svg>
                </form>
            </div>
            <!-- header right -->
            <div class="header--right">
                <!-- language  -->
                <div class="lang--select" id="google_translate_element"></div>
                {{-- <select class="lang--select">
                    <option selected value="1">English</option>
                    <option value="2">German</option>
                </select> --}}
                <a href="{{ route('sell.car.page') }}" class="buttonv2 button">Sell a Car</a>
                @guest
                    <a href="{{ route('login') }}" class="button login-btn">Sign In</a>
                @endguest

                @auth
                    {{-- <a href="{{route('login')}}" class="button login-btn">Profile</a> --}}
                    <div class="custom-dropdown">
                        <button id="custom-dropdown-toggle" class="custom-dropdown-toggle button login-btn ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                            </svg>
                            <p> ${{ auth()->user()->balance->balance ?? 0 }}</p>
                        </button>
                        <div class="custom-dropdown-menu" id="custom-dropdown-menu">
                            <a href="{{ route('user.profile') }}" class="custom-dropdown-item">Profile</a>
                            @if (auth()->user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="custom-dropdown-item">Dashboard</a>
                            @endif
                            {{-- <a href="#" class="custom-dropdown-item">Action 2</a> --}}
                            <a href="{{ route('logout') }}" class="custom-dropdown-item">Logout</a>
                        </div>
                    </div>
                @endauth
                <!-- menu toggler -->
                <div class="hamburger-menu">
                    <span class="line-top"></span>
                    <span class="line-center"></span>
                    <span class="line-bottom"></span>
                </div>
            </div>
        </div>
    </div>
</header>
