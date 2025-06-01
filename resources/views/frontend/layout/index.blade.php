@extends('frontend.app')

@section('main--content')
    @php
        use Illuminate\Support\Str;
        use App\Models\Auction;
        // assigning the data in single values
        $cms = $data['cms'];
        $auctions = $data['auctions'];
        $parameters = $data['parameters'];
        $year = $parameters['year'];
        $model = $parameters['model'];
        $make = $parameters['make'];

        $count = 0;

        // dd($year, $model, $make);

    @endphp
    <main>
        <!-- hero area :: start  -->
        <section class="hero--area">
            <div class="container">
                <div class="section--title mb_35" data-aos="fade-zoom-in" data-aos-duration="1500">
                    <h1 class="sec--title">Featured Auctions</h1>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel hero--slider">
                            @foreach ($auctions as $auction)
                                @if ($auction->featured)
                                    <div class="item">
                                        <div class="slider--box">
                                            <div class="row">
                                                <div class="col-lg-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                                    data-aos-delay="300">
                                                    <!-- showing first featured image  -->
                                                    <a href="javascript:void(0)" class="featured--car"
                                                        style="background-image: url({{ $auction->auctionImageGallery[0]->url ?? 'frontend/images/car1.png' }});">
                                                        <h3>
                                                            {{ $auction->year ?? '' }} {{ ' ' }}
                                                            {{ $auction->model }}
                                                        </h3>
                                                        <div class="more--info">
                                                            <p>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                                    height="23" viewBox="0 0 22 23" fill="none">
                                                                    <path
                                                                        d="M10.9365 20.6231C5.97082 20.6231 1.94531 16.5975 1.94531 11.6319C1.94531 6.66613 5.97082 2.64062 10.9365 2.64062C15.9022 2.64062 19.9278 6.66613 19.9278 11.6319C19.9278 16.5975 15.9022 20.6231 10.9365 20.6231ZM10.9365 18.8248C14.9091 18.8248 18.1295 15.6044 18.1295 11.6319C18.1295 7.65928 14.9091 4.43887 10.9365 4.43887C6.96396 4.43887 3.74356 7.65928 3.74356 11.6319C3.74356 15.6044 6.96396 18.8248 10.9365 18.8248ZM11.8357 11.6319H15.4322V13.4301H10.0374V7.13624H11.8357V11.6319Z"
                                                                        fill="#B3BAC5" />
                                                                </svg>
                                                                @php
                                                                    $end = \Carbon\Carbon::parse($auction->end);
                                                                    $now = \Carbon\Carbon::now();
                                                                @endphp
                                                                End in {{ $end->diffForHumans($now) ?? '' }}
                                                            </p>
                                                            <p><span>Bid:</span> ${{ $auction->maxBid() ?? 0 }}</p>
                                                        </div>
                                                        <p class="category">Featured</p>
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 slider-right-box">
                                                    <div class="row">
                                                        <!-- showing three images  -->
                                                        @for ($i = 1; $i < count($auction->auctionImageGallery) && $i <= 3; $i++)
                                                            <div class="col-sm-6 mt_20" data-aos="fade-up"
                                                                data-aos-duration="1000" data-aos-delay="400">
                                                                <a href="javascript:void(0)">
                                                                    <img class="w-100"
                                                                        src="{{ $auction->auctionImageGallery[$i]->url ?? 'frontend/images/car2.png' }}"
                                                                        alt="" />
                                                                </a>
                                                            </div>
                                                        @endfor
                                                        <div class="col-sm-6 mt_20" data-aos="fade-up"
                                                            data-aos-duration="1000" data-aos-delay="700">
                                                            <!-- remaining images count   -->
                                                            <a href="#" class="more--photos--box" id="morePhotosBox">
                                                                {{ count($auction->auctionImageGallery) - 4 }}+<br />
                                                                Photos
                                                            </a>
                                                            <!-- gallery  -->
                                                            <div class="gallery">
                                                                <!-- more images  -->
                                                                @for ($i = 4; $i < count($auction->auctionImageGallery); $i++)
                                                                    <a
                                                                        href="{{ $auction->auctionImageGallery[$i]->url ?? 'frontend/images/car1.png' }}">
                                                                    </a>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- lightbox gallery  -->
            {{-- <div class="gallery">
                <a href="{{ asset('frontend/images/car1.png') }}"> </a>
                <a href="{{ asset('frontend/images/car2.png') }}"> </a>
                <a href="{{ asset('frontend/images/car3.png') }}"> </a>
            </div> --}}
        </section>
        <!-- hero arean :: end -->

        <!-- live auctions area :: start -->
        <section class="live--auctions--area">
            <div class="container">
                <!-- section title  -->
                <div class="section--title mb_50" data-aos="fade-zoom-in" data-aos-duration="1500" data-aos-offset="0">
                    <h3 class="sec--title">Our Live Auctions</h3>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="filter--and--category">
                            <!-- category and sort  -->
                            {{-- <div class="category--and--sort" data-aos="fade-zoom-in" data-aos-duration="400"
                                data-aos-delay="100" data-aos-offset="0">
                                <!-- car category  -->
                                <select>
                                    <option selected disabled>Choose Car Category</option>
                                    <option>Sedan</option>
                                    <option>SUV</option>
                                    <option>Coupe</option>
                                    <option>Hatchback</option>
                                    <option>Convertible</option>
                                    <option>Wagon</option>
                                    <option>Minivan</option>
                                    <option>Pickup Truck</option>
                                    <option>Crossover</option>
                                    <option>Luxury Car</option>
                                    <option>Electric Vehicle</option>
                                    <option>Hybrid Vehicle</option>
                                </select>
                                <!-- sort by  -->
                                <div class="sort--by">
                                    <p>Sort By</p>
                                    <ul>
                                        <li class="active">Ending Soon</li>
                                        <li>Newly listed</li>
                                        <li>Closest to Me</li>
                                    </ul>
                                </div>
                            </div> --}}
                            <!-- filters  -->
                            <form action="{{ route('filter') }}" method="GET" class="filtered--options mt_30"
                                data-aos="fade-zoom-in" data-aos-duration="400" data-aos-delay="200" data-aos-offset="0">
                                @csrf
                                @method('GET')
                                <p>Filters:</p>
                                <!-- year--select  -->
                                {{-- @dd(Auction::allYears()) --}}
                                <select id="select_year" name="year" class="year--select">

                                    <option {{ $year === '*' ? 'selected' : '' }} value="*">Year</option>

                                    @foreach (Auction::allYears() as $item)
                                        <option {{ $year === $item->year ? 'selected' : '' }} value="{{ $item->year }}">
                                            {{ $item->year }}</option>
                                    @endforeach
                                    {{-- <option {{$item->id}}>{{$item->year}}</option> --}}
                                </select>
                                <!-- Car Brand select  -->
                                <select id="select_make" name="make" class="brand--select">
                                    <option {{ $make === '*' ? 'selected' : '' }} value="*">Car Brand</option>
                                    @foreach (Auction::allMakes() as $item)
                                        <option {{ $make === $item->make ? 'selected' : '' }} value="{{ $item->make }}">
                                            {{ $item->make }}</option>
                                    @endforeach
                                </select>
                                <!-- car model select  -->
                                <select id="select_model" name="model" class="car-model--select">
                                    <option {{ $model === '*' ? 'selected' : '' }} value="*">Car Model</option>
                                    @foreach (Auction::allModels() as $item)
                                        <option {{ $model === $item->model ? 'selected' : '' }}
                                            value="{{ $item->model }}">{{ $item->model }}</option>
                                    @endforeach
                                </select>
                                <!-- price-range--select  -->
                                {{-- <select id="range" class="price-range--select">
                                    <option selected value="*">Price Range</option>
                                    <option value="0-10000">Below $10,000</option>
                                    <option value="10000-20000">$10,000 - $20,000</option>
                                    <option value="20000-30000">$20,000 - $30,000</option>
                                    <option value="30000-40000">$30,000 - $40,000</option>
                                    <option value="40000-50000">$40,000 - $50,000</option>
                                    <option value="50000-more">Above $50,000</option>
                                </select> --}}
                                <button class="btn" style="background: #5459AC; color:white;">Filter</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row" id="search_result">
                            {{--  showing all the active auctions --}}
                            @foreach ($auctions as $auction)
                                @if ($count == 12)
                                @break;
                            @endif
                            @php
                                $count++;
                            @endphp
                            {{-- auction card --}}
                            <div class="col-xxl-3 col-lg-4 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000">
                                <!-- car card  -->
                                <div class="car--card">
                                    <div class="img--area">
                                        <img class="w-100" src="{{ $auction->auctionImageGallery[0]->url }}"
                                            alt="" />
                                    </div>
                                    <div class="car--info">
                                        <div class="bid--info">
                                            {{-- if status is approve then end time will show --}}
                                            @if ($auction->status === 'approve')
                                                <p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23"
                                                        height="23" viewBox="0 0 23 23" fill="none">
                                                        viewBox="0 0 23 23" fill="none">
                                                        <path
                                                            d="M11.7334 20.4663C6.7677 20.4663 2.74219 16.4408 2.74219 11.4751C2.74219 6.50939 6.7677 2.48389 11.7334 2.48389C16.6991 2.48389 20.7246 6.50939 20.7246 11.4751C20.7246 16.4408 16.6991 20.4663 11.7334 20.4663ZM11.7334 18.6681C15.706 18.6681 18.9264 15.4477 18.9264 11.4751C18.9264 7.50254 15.706 4.28213 11.7334 4.28213C7.76084 4.28213 4.54043 7.50254 4.54043 11.4751C4.54043 15.4477 7.76084 18.6681 11.7334 18.6681ZM12.6325 11.4751H16.229V13.2734H10.8343V6.9795H12.6325V11.4751Z"
                                                            fill="#141414" />
                                                    </svg>
                                                    {{-- need to do later --}}
                                                    @php
                                                        $end = \Carbon\Carbon::parse($auction->end);
                                                        $now = \Carbon\Carbon::now();
                                                    @endphp
                                                    End in {{ $end->diffForHumans($now) ?? '' }}
                                                </p>
                                            @endif

                                            {{-- if pending the status will show else higest bid will show --}}
                                            @if ($auction->status === 'pending')
                                                <p>
                                                    <span style="color:red">Pending</span>
                                                </p>
                                            @else
                                                <p>
                                                    <span>Bid</span>
                                                    <span class="auction_price_{{ $auction->id }}">{{ $auction->maxBid() ?? 0 }}</span>
                                                </p>
                                            @endif

                                            {{-- add to wishlist --}}
                                            @auth
                                                <svg class="wishlist-action star {{ $auction->isWished() ? 'active' : '' }}"
                                                    data-auction-id="{{ $auction->id }}" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill='none'
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.245 4.174C11.4765 3.50808 11.5922 3.17513 11.7634 3.08285C11.9115 3.00298 12.0898 3.00298 12.238 3.08285C12.4091 3.17513 12.5248 3.50808 12.7563 4.174L14.2866 8.57639C14.3525 8.76592 14.3854 8.86068 14.4448 8.93125C14.4972 8.99359 14.5641 9.04218 14.6396 9.07278C14.725 9.10743 14.8253 9.10947 15.0259 9.11356L19.6857 9.20852C20.3906 9.22288 20.743 9.23007 20.8837 9.36432C21.0054 9.48051 21.0605 9.65014 21.0303 9.81569C20.9955 10.007 20.7146 10.2199 20.1528 10.6459L16.4387 13.4616C16.2788 13.5829 16.1989 13.6435 16.1501 13.7217C16.107 13.7909 16.0815 13.8695 16.0757 13.9507C16.0692 14.0427 16.0982 14.1387 16.1563 14.3308L17.506 18.7919C17.7101 19.4667 17.8122 19.8041 17.728 19.9793C17.6551 20.131 17.5108 20.2358 17.344 20.2583C17.1513 20.2842 16.862 20.0829 16.2833 19.6802L12.4576 17.0181C12.2929 16.9035 12.2106 16.8462 12.1211 16.8239C12.042 16.8043 11.9593 16.8043 11.8803 16.8239C11.7908 16.8462 11.7084 16.9035 11.5437 17.0181L7.71805 19.6802C7.13937 20.0829 6.85003 20.2842 6.65733 20.2583C6.49056 20.2358 6.34626 20.131 6.27337 19.9793C6.18915 19.8041 6.29123 19.4667 6.49538 18.7919L7.84503 14.3308C7.90313 14.1387 7.93218 14.0427 7.92564 13.9507C7.91986 13.8695 7.89432 13.7909 7.85123 13.7217C7.80246 13.6435 7.72251 13.5829 7.56262 13.4616L3.84858 10.6459C3.28678 10.2199 3.00588 10.007 2.97101 9.81569C2.94082 9.65014 2.99594 9.48051 3.11767 9.36432C3.25831 9.23007 3.61074 9.22289 4.31559 9.20852L8.9754 9.11356C9.176 9.10947 9.27631 9.10743 9.36177 9.07278C9.43726 9.04218 9.50414 8.99359 9.55657 8.93125C9.61593 8.86068 9.64887 8.76592 9.71475 8.57639L11.245 4.174Z"
                                                        stroke="#000000" stroke-width="1" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            @endauth
                                        </div>
                                        <div class="car--model">
                                            <a
                                                href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}">
                                                {{ $auction->year ?? '' }}{{ ' ' }}{{ $auction->model ?? '' }}</a>
                                            <p>
                                                {{ $auction->engine ?? '' }}{{ ', ' }}
                                                {{ $auction->drivetrain ?? 'N/A' }}{{ ', ' }}
                                                {{ $auction->title_status ?? 'N/A' }} {{ ', ' }}
                                                {{ $auction->state->name ?? 'N/A' }}
                                                {{--                                            1 Owner, Dual-Motor AWD, Florida-Owned, Mostly Unmodified --}}

                                            </p>
                                            <div class="card--footer">
                                                <p>{{ $auction->user->profile->city ?? '' }},{{ ' ' }}{{ $auction->user->profile->state->name ?? '' }},{{ ' ' }}
                                                    {{ $auction->user->profile->zip ?? '' }}</p>

                                                @if ($auction->end >= now() && $auction->status == 'approve')
                                                    <a href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}"
                                                        class="buttonv2 button">Place a Bid</a>
                                                @else
                                                    <div></div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{--  show more button --}}
                <div class="col-12 text-center mt_70" data-aos="fade-in" data-aos-duration="1500"
                    data-aos-delay="100">
                    <a href="{{ route('auction.page', ['year' => $year, 'model' => $model, 'make' => $make]) }}"
                        class="button">View Auctions Result</a>
                </div>
            </div>
        </div>
    </section>
    <!-- live auctions area :: end -->

    <!-- why cars and bids area :: start  -->
    <section class="cars--and--bids--area"
        style="background-image: url('{{ $cms[0]->image_url ? $cms[0]->image_url : asset('frontend/images/car-and-bids-bg.png') }}')">
        <div class="container">
            <!-- section--title  -->
            <div class="section--title text-center" data-aos="fade-in" data-aos-duration="1500"
                data-aos-delay="100">
                <h3 class="sec--title">{{ $cms[0]->title ? $cms[0]->title : 'Why Cars & Bids?' }}</h3>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 mt_20" data-aos="fade-in" data-aos-duration="1200">
                    <!-- counter box  -->
                    <div class="counter--box first">
                        <h4>
                            <p class="counter">18000</p>
                            +
                        </h4>
                        <p>Auctions completed</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt_20" data-aos="fade-in" data-aos-duration="1200"
                    data-aos-delay="100">
                    <!-- counter box  -->
                    <div class="counter--box">
                        <h4>
                            $
                            <p class="counter">415</p>
                            M+
                        </h4>
                        <p>Value of cars sold</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt_20" data-aos="fade-in" data-aos-duration="1200"
                    data-aos-delay="200">
                    <!-- counter box  -->
                    <div class="counter--box three">
                        <h4>
                            <p class="counter">83</p>
                            %+
                        </h4>
                        <p>Sell-through rate</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt_20" data-aos="fade-in" data-aos-duration="1200"
                    data-aos-delay="300">
                    <!-- counter box  -->
                    <div class="counter--box">
                        <h4>
                            <p class="counter">510</p>
                            K+
                        </h4>
                        <p>Registered members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- why cars and bids area :: end  -->

    <!-- Testimonial area :: start  -->
    <section class="testimonial--area">
        <!-- section--title  -->
        <div class="section--title mb_95 text-center" data-aos="fade-in" data-aos-duration="1500">
            <h3 class="sec--title">Our Customers Love Us !</h3>
        </div>
        <!-- testimonial carousel  -->
        <div class="owl-carousel testimonial--carousel" data-aos="fade-left" data-aos-duration="1000"
            data-aos-delay="100">
            <div class="item">
                <!-- testimonial--card  -->
                <div class="testimonial--card">
                    <p class="message">
                        Great experience, from the listing to the post auction
                        follow-up, I will definitely use Cars and Bids again and
                        recommend it to all my friends!
                    </p>
                    <div class="client">
                        <img src="{{ asset('frontend/images/client.png') }}" alt="" />
                        <div>
                            <p>Prateek Kukreja</p>
                            <span>28th May 2024</span>
                        </div>
                    </div>
                    <!-- rating  -->
                    <div class="rating">
                        5.0
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="19" viewBox="0 0 104 19"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.35274 1.06264L11.816 6.29745L17.3223 7.1371C17.4649 7.15925 17.5831 7.26391 17.6275 7.40724C17.6719 7.55057 17.6348 7.70782 17.5317 7.81313L13.5481 11.887L14.4886 17.6405C14.5134 17.7888 14.4553 17.939 14.3388 18.0277C14.2223 18.1163 14.0678 18.1281 13.9403 18.0579L9.01495 15.342L4.08961 18.0587C3.9622 18.1291 3.80757 18.1176 3.69104 18.0289C3.57451 17.9403 3.5164 17.79 3.54127 17.6416L4.48182 11.887L0.49704 7.81313C0.393979 7.70782 0.35688 7.55057 0.401282 7.40724C0.445684 7.26391 0.563921 7.15925 0.706469 7.1371L6.21281 6.29745L8.67717 1.06264C8.73988 0.927282 8.87109 0.841309 9.01495 0.841309C9.15882 0.841309 9.29003 0.927282 9.35274 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M30.9309 1.06264L33.3941 6.29745L38.9004 7.1371C39.043 7.15925 39.1612 7.26391 39.2056 7.40724C39.25 7.55057 39.2129 7.70782 39.1099 7.81313L35.1262 11.887L36.0668 17.6405C36.0915 17.7888 36.0334 17.939 35.9169 18.0277C35.8005 18.1163 35.6459 18.1281 35.5184 18.0579L30.5931 15.342L25.6677 18.0587C25.5403 18.1291 25.3857 18.1176 25.2692 18.0289C25.1526 17.9403 25.0945 17.79 25.1194 17.6416L26.0599 11.887L22.0752 7.81313C21.9721 7.70782 21.935 7.55057 21.9794 7.40724C22.0238 7.26391 22.142 7.15925 22.2846 7.1371L27.7909 6.29745L30.2553 1.06264C30.318 0.927282 30.4492 0.841309 30.5931 0.841309C30.7369 0.841309 30.8682 0.927282 30.9309 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M52.509 1.06264L54.9722 6.29745L60.4786 7.1371C60.6211 7.15925 60.7393 7.26391 60.7837 7.40724C60.8282 7.55057 60.7911 7.70782 60.688 7.81313L56.7043 11.887L57.6449 17.6405C57.6696 17.7888 57.6115 17.939 57.495 18.0277C57.3786 18.1163 57.224 18.1281 57.0965 18.0579L52.1712 15.342L47.2459 18.0587C47.1185 18.1291 46.9638 18.1176 46.8473 18.0289C46.7308 17.9403 46.6727 17.79 46.6975 17.6416L47.6381 11.887L43.6533 7.81313C43.5502 7.70782 43.5131 7.55057 43.5575 7.40724C43.6019 7.26391 43.7202 7.15925 43.8627 7.1371L49.3691 6.29745L51.8334 1.06264C51.8961 0.927282 52.0273 0.841309 52.1712 0.841309C52.3151 0.841309 52.4463 0.927282 52.509 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M74.091 1.06264L76.5543 6.29745L82.0606 7.1371C82.2031 7.15925 82.3214 7.26391 82.3658 7.40724C82.4102 7.55057 82.3731 7.70782 82.27 7.81313L78.2864 11.887L79.2269 17.6405C79.2516 17.7888 79.1935 17.939 79.0771 18.0277C78.9606 18.1163 78.8061 18.1281 78.6786 18.0579L73.7532 15.342L68.8279 18.0587C68.7005 18.1291 68.5459 18.1176 68.4293 18.0289C68.3128 17.9403 68.2547 17.79 68.2796 17.6416L69.2201 11.887L65.2353 7.81313C65.1323 7.70782 65.0952 7.55057 65.1396 7.40724C65.184 7.26391 65.3022 7.15925 65.4448 7.1371L70.9511 6.29745L73.4154 1.06264C73.4782 0.927282 73.6094 0.841309 73.7532 0.841309C73.8971 0.841309 74.0283 0.927282 74.091 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M95.6691 1.06264L98.1324 6.29745L103.639 7.1371C103.781 7.15925 103.9 7.26391 103.944 7.40724C103.988 7.55057 103.951 7.70782 103.848 7.81313L99.8645 11.887L100.805 17.6405C100.83 17.7888 100.772 17.939 100.655 18.0277C100.539 18.1163 100.384 18.1281 100.257 18.0579L95.3314 15.342L90.406 18.0587C90.2786 18.1291 90.124 18.1176 90.0074 18.0289C89.8909 17.9403 89.8328 17.79 89.8577 17.6416L90.7982 11.887L86.8134 7.81313C86.7104 7.70782 86.6733 7.55057 86.7177 7.40724C86.7621 7.26391 86.8803 7.15925 87.0229 7.1371L92.5292 6.29745L94.9936 1.06264C95.0563 0.927282 95.1875 0.841309 95.3314 0.841309C95.4752 0.841309 95.6064 0.927282 95.6691 1.06264Z"
                                fill="#FFF0EB" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- testimonial--card  -->
                <div class="testimonial--card">
                    <p class="message">
                        Great experience, from the listing to the post auction
                        follow-up, I will definitely use Cars and Bids again and
                        recommend it to all my friends!
                    </p>
                    <div class="client">
                        <img src="{{ asset('frontend/images/client.png') }}" alt="" />
                        <div>
                            <p>Prateek Kukreja</p>
                            <span>28th May 2024</span>
                        </div>
                    </div>
                    <!-- rating  -->
                    <div class="rating">
                        5.0
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="19" viewBox="0 0 104 19"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.35274 1.06264L11.816 6.29745L17.3223 7.1371C17.4649 7.15925 17.5831 7.26391 17.6275 7.40724C17.6719 7.55057 17.6348 7.70782 17.5317 7.81313L13.5481 11.887L14.4886 17.6405C14.5134 17.7888 14.4553 17.939 14.3388 18.0277C14.2223 18.1163 14.0678 18.1281 13.9403 18.0579L9.01495 15.342L4.08961 18.0587C3.9622 18.1291 3.80757 18.1176 3.69104 18.0289C3.57451 17.9403 3.5164 17.79 3.54127 17.6416L4.48182 11.887L0.49704 7.81313C0.393979 7.70782 0.35688 7.55057 0.401282 7.40724C0.445684 7.26391 0.563921 7.15925 0.706469 7.1371L6.21281 6.29745L8.67717 1.06264C8.73988 0.927282 8.87109 0.841309 9.01495 0.841309C9.15882 0.841309 9.29003 0.927282 9.35274 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M30.9309 1.06264L33.3941 6.29745L38.9004 7.1371C39.043 7.15925 39.1612 7.26391 39.2056 7.40724C39.25 7.55057 39.2129 7.70782 39.1099 7.81313L35.1262 11.887L36.0668 17.6405C36.0915 17.7888 36.0334 17.939 35.9169 18.0277C35.8005 18.1163 35.6459 18.1281 35.5184 18.0579L30.5931 15.342L25.6677 18.0587C25.5403 18.1291 25.3857 18.1176 25.2692 18.0289C25.1526 17.9403 25.0945 17.79 25.1194 17.6416L26.0599 11.887L22.0752 7.81313C21.9721 7.70782 21.935 7.55057 21.9794 7.40724C22.0238 7.26391 22.142 7.15925 22.2846 7.1371L27.7909 6.29745L30.2553 1.06264C30.318 0.927282 30.4492 0.841309 30.5931 0.841309C30.7369 0.841309 30.8682 0.927282 30.9309 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M52.509 1.06264L54.9722 6.29745L60.4786 7.1371C60.6211 7.15925 60.7393 7.26391 60.7837 7.40724C60.8282 7.55057 60.7911 7.70782 60.688 7.81313L56.7043 11.887L57.6449 17.6405C57.6696 17.7888 57.6115 17.939 57.495 18.0277C57.3786 18.1163 57.224 18.1281 57.0965 18.0579L52.1712 15.342L47.2459 18.0587C47.1185 18.1291 46.9638 18.1176 46.8473 18.0289C46.7308 17.9403 46.6727 17.79 46.6975 17.6416L47.6381 11.887L43.6533 7.81313C43.5502 7.70782 43.5131 7.55057 43.5575 7.40724C43.6019 7.26391 43.7202 7.15925 43.8627 7.1371L49.3691 6.29745L51.8334 1.06264C51.8961 0.927282 52.0273 0.841309 52.1712 0.841309C52.3151 0.841309 52.4463 0.927282 52.509 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M74.091 1.06264L76.5543 6.29745L82.0606 7.1371C82.2031 7.15925 82.3214 7.26391 82.3658 7.40724C82.4102 7.55057 82.3731 7.70782 82.27 7.81313L78.2864 11.887L79.2269 17.6405C79.2516 17.7888 79.1935 17.939 79.0771 18.0277C78.9606 18.1163 78.8061 18.1281 78.6786 18.0579L73.7532 15.342L68.8279 18.0587C68.7005 18.1291 68.5459 18.1176 68.4293 18.0289C68.3128 17.9403 68.2547 17.79 68.2796 17.6416L69.2201 11.887L65.2353 7.81313C65.1323 7.70782 65.0952 7.55057 65.1396 7.40724C65.184 7.26391 65.3022 7.15925 65.4448 7.1371L70.9511 6.29745L73.4154 1.06264C73.4782 0.927282 73.6094 0.841309 73.7532 0.841309C73.8971 0.841309 74.0283 0.927282 74.091 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M95.6691 1.06264L98.1324 6.29745L103.639 7.1371C103.781 7.15925 103.9 7.26391 103.944 7.40724C103.988 7.55057 103.951 7.70782 103.848 7.81313L99.8645 11.887L100.805 17.6405C100.83 17.7888 100.772 17.939 100.655 18.0277C100.539 18.1163 100.384 18.1281 100.257 18.0579L95.3314 15.342L90.406 18.0587C90.2786 18.1291 90.124 18.1176 90.0074 18.0289C89.8909 17.9403 89.8328 17.79 89.8577 17.6416L90.7982 11.887L86.8134 7.81313C86.7104 7.70782 86.6733 7.55057 86.7177 7.40724C86.7621 7.26391 86.8803 7.15925 87.0229 7.1371L92.5292 6.29745L94.9936 1.06264C95.0563 0.927282 95.1875 0.841309 95.3314 0.841309C95.4752 0.841309 95.6064 0.927282 95.6691 1.06264Z"
                                fill="#FFF0EB" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- testimonial--card  -->
                <div class="testimonial--card">
                    <p class="message">
                        Great experience, from the listing to the post auction
                        follow-up, I will definitely use Cars and Bids again and
                        recommend it to all my friends!
                    </p>
                    <div class="client">
                        <img src="{{ asset('frontend/images/client.png') }}" alt="" />
                        <div>
                            <p>Prateek Kukreja</p>
                            <span>28th May 2024</span>
                        </div>
                    </div>
                    <!-- rating  -->
                    <div class="rating">
                        5.0
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="19" viewBox="0 0 104 19"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.35274 1.06264L11.816 6.29745L17.3223 7.1371C17.4649 7.15925 17.5831 7.26391 17.6275 7.40724C17.6719 7.55057 17.6348 7.70782 17.5317 7.81313L13.5481 11.887L14.4886 17.6405C14.5134 17.7888 14.4553 17.939 14.3388 18.0277C14.2223 18.1163 14.0678 18.1281 13.9403 18.0579L9.01495 15.342L4.08961 18.0587C3.9622 18.1291 3.80757 18.1176 3.69104 18.0289C3.57451 17.9403 3.5164 17.79 3.54127 17.6416L4.48182 11.887L0.49704 7.81313C0.393979 7.70782 0.35688 7.55057 0.401282 7.40724C0.445684 7.26391 0.563921 7.15925 0.706469 7.1371L6.21281 6.29745L8.67717 1.06264C8.73988 0.927282 8.87109 0.841309 9.01495 0.841309C9.15882 0.841309 9.29003 0.927282 9.35274 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M30.9309 1.06264L33.3941 6.29745L38.9004 7.1371C39.043 7.15925 39.1612 7.26391 39.2056 7.40724C39.25 7.55057 39.2129 7.70782 39.1099 7.81313L35.1262 11.887L36.0668 17.6405C36.0915 17.7888 36.0334 17.939 35.9169 18.0277C35.8005 18.1163 35.6459 18.1281 35.5184 18.0579L30.5931 15.342L25.6677 18.0587C25.5403 18.1291 25.3857 18.1176 25.2692 18.0289C25.1526 17.9403 25.0945 17.79 25.1194 17.6416L26.0599 11.887L22.0752 7.81313C21.9721 7.70782 21.935 7.55057 21.9794 7.40724C22.0238 7.26391 22.142 7.15925 22.2846 7.1371L27.7909 6.29745L30.2553 1.06264C30.318 0.927282 30.4492 0.841309 30.5931 0.841309C30.7369 0.841309 30.8682 0.927282 30.9309 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M52.509 1.06264L54.9722 6.29745L60.4786 7.1371C60.6211 7.15925 60.7393 7.26391 60.7837 7.40724C60.8282 7.55057 60.7911 7.70782 60.688 7.81313L56.7043 11.887L57.6449 17.6405C57.6696 17.7888 57.6115 17.939 57.495 18.0277C57.3786 18.1163 57.224 18.1281 57.0965 18.0579L52.1712 15.342L47.2459 18.0587C47.1185 18.1291 46.9638 18.1176 46.8473 18.0289C46.7308 17.9403 46.6727 17.79 46.6975 17.6416L47.6381 11.887L43.6533 7.81313C43.5502 7.70782 43.5131 7.55057 43.5575 7.40724C43.6019 7.26391 43.7202 7.15925 43.8627 7.1371L49.3691 6.29745L51.8334 1.06264C51.8961 0.927282 52.0273 0.841309 52.1712 0.841309C52.3151 0.841309 52.4463 0.927282 52.509 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M74.091 1.06264L76.5543 6.29745L82.0606 7.1371C82.2031 7.15925 82.3214 7.26391 82.3658 7.40724C82.4102 7.55057 82.3731 7.70782 82.27 7.81313L78.2864 11.887L79.2269 17.6405C79.2516 17.7888 79.1935 17.939 79.0771 18.0277C78.9606 18.1163 78.8061 18.1281 78.6786 18.0579L73.7532 15.342L68.8279 18.0587C68.7005 18.1291 68.5459 18.1176 68.4293 18.0289C68.3128 17.9403 68.2547 17.79 68.2796 17.6416L69.2201 11.887L65.2353 7.81313C65.1323 7.70782 65.0952 7.55057 65.1396 7.40724C65.184 7.26391 65.3022 7.15925 65.4448 7.1371L70.9511 6.29745L73.4154 1.06264C73.4782 0.927282 73.6094 0.841309 73.7532 0.841309C73.8971 0.841309 74.0283 0.927282 74.091 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M95.6691 1.06264L98.1324 6.29745L103.639 7.1371C103.781 7.15925 103.9 7.26391 103.944 7.40724C103.988 7.55057 103.951 7.70782 103.848 7.81313L99.8645 11.887L100.805 17.6405C100.83 17.7888 100.772 17.939 100.655 18.0277C100.539 18.1163 100.384 18.1281 100.257 18.0579L95.3314 15.342L90.406 18.0587C90.2786 18.1291 90.124 18.1176 90.0074 18.0289C89.8909 17.9403 89.8328 17.79 89.8577 17.6416L90.7982 11.887L86.8134 7.81313C86.7104 7.70782 86.6733 7.55057 86.7177 7.40724C86.7621 7.26391 86.8803 7.15925 87.0229 7.1371L92.5292 6.29745L94.9936 1.06264C95.0563 0.927282 95.1875 0.841309 95.3314 0.841309C95.4752 0.841309 95.6064 0.927282 95.6691 1.06264Z"
                                fill="#FFF0EB" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- testimonial--card  -->
                <div class="testimonial--card">
                    <p class="message">
                        Great experience, from the listing to the post auction
                        follow-up, I will definitely use Cars and Bids again and
                        recommend it to all my friends!
                    </p>
                    <div class="client">
                        <img src="{{ asset('frontend/images/client.png') }}" alt="" />
                        <div>
                            <p>Prateek Kukreja</p>
                            <span>28th May 2024</span>
                        </div>
                    </div>
                    <!-- rating  -->
                    <div class="rating">
                        5.0
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="19" viewBox="0 0 104 19"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.35274 1.06264L11.816 6.29745L17.3223 7.1371C17.4649 7.15925 17.5831 7.26391 17.6275 7.40724C17.6719 7.55057 17.6348 7.70782 17.5317 7.81313L13.5481 11.887L14.4886 17.6405C14.5134 17.7888 14.4553 17.939 14.3388 18.0277C14.2223 18.1163 14.0678 18.1281 13.9403 18.0579L9.01495 15.342L4.08961 18.0587C3.9622 18.1291 3.80757 18.1176 3.69104 18.0289C3.57451 17.9403 3.5164 17.79 3.54127 17.6416L4.48182 11.887L0.49704 7.81313C0.393979 7.70782 0.35688 7.55057 0.401282 7.40724C0.445684 7.26391 0.563921 7.15925 0.706469 7.1371L6.21281 6.29745L8.67717 1.06264C8.73988 0.927282 8.87109 0.841309 9.01495 0.841309C9.15882 0.841309 9.29003 0.927282 9.35274 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M30.9309 1.06264L33.3941 6.29745L38.9004 7.1371C39.043 7.15925 39.1612 7.26391 39.2056 7.40724C39.25 7.55057 39.2129 7.70782 39.1099 7.81313L35.1262 11.887L36.0668 17.6405C36.0915 17.7888 36.0334 17.939 35.9169 18.0277C35.8005 18.1163 35.6459 18.1281 35.5184 18.0579L30.5931 15.342L25.6677 18.0587C25.5403 18.1291 25.3857 18.1176 25.2692 18.0289C25.1526 17.9403 25.0945 17.79 25.1194 17.6416L26.0599 11.887L22.0752 7.81313C21.9721 7.70782 21.935 7.55057 21.9794 7.40724C22.0238 7.26391 22.142 7.15925 22.2846 7.1371L27.7909 6.29745L30.2553 1.06264C30.318 0.927282 30.4492 0.841309 30.5931 0.841309C30.7369 0.841309 30.8682 0.927282 30.9309 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M52.509 1.06264L54.9722 6.29745L60.4786 7.1371C60.6211 7.15925 60.7393 7.26391 60.7837 7.40724C60.8282 7.55057 60.7911 7.70782 60.688 7.81313L56.7043 11.887L57.6449 17.6405C57.6696 17.7888 57.6115 17.939 57.495 18.0277C57.3786 18.1163 57.224 18.1281 57.0965 18.0579L52.1712 15.342L47.2459 18.0587C47.1185 18.1291 46.9638 18.1176 46.8473 18.0289C46.7308 17.9403 46.6727 17.79 46.6975 17.6416L47.6381 11.887L43.6533 7.81313C43.5502 7.70782 43.5131 7.55057 43.5575 7.40724C43.6019 7.26391 43.7202 7.15925 43.8627 7.1371L49.3691 6.29745L51.8334 1.06264C51.8961 0.927282 52.0273 0.841309 52.1712 0.841309C52.3151 0.841309 52.4463 0.927282 52.509 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M74.091 1.06264L76.5543 6.29745L82.0606 7.1371C82.2031 7.15925 82.3214 7.26391 82.3658 7.40724C82.4102 7.55057 82.3731 7.70782 82.27 7.81313L78.2864 11.887L79.2269 17.6405C79.2516 17.7888 79.1935 17.939 79.0771 18.0277C78.9606 18.1163 78.8061 18.1281 78.6786 18.0579L73.7532 15.342L68.8279 18.0587C68.7005 18.1291 68.5459 18.1176 68.4293 18.0289C68.3128 17.9403 68.2547 17.79 68.2796 17.6416L69.2201 11.887L65.2353 7.81313C65.1323 7.70782 65.0952 7.55057 65.1396 7.40724C65.184 7.26391 65.3022 7.15925 65.4448 7.1371L70.9511 6.29745L73.4154 1.06264C73.4782 0.927282 73.6094 0.841309 73.7532 0.841309C73.8971 0.841309 74.0283 0.927282 74.091 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M95.6691 1.06264L98.1324 6.29745L103.639 7.1371C103.781 7.15925 103.9 7.26391 103.944 7.40724C103.988 7.55057 103.951 7.70782 103.848 7.81313L99.8645 11.887L100.805 17.6405C100.83 17.7888 100.772 17.939 100.655 18.0277C100.539 18.1163 100.384 18.1281 100.257 18.0579L95.3314 15.342L90.406 18.0587C90.2786 18.1291 90.124 18.1176 90.0074 18.0289C89.8909 17.9403 89.8328 17.79 89.8577 17.6416L90.7982 11.887L86.8134 7.81313C86.7104 7.70782 86.6733 7.55057 86.7177 7.40724C86.7621 7.26391 86.8803 7.15925 87.0229 7.1371L92.5292 6.29745L94.9936 1.06264C95.0563 0.927282 95.1875 0.841309 95.3314 0.841309C95.4752 0.841309 95.6064 0.927282 95.6691 1.06264Z"
                                fill="#FFF0EB" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="item">
                <!-- testimonial--card  -->
                <div class="testimonial--card">
                    <p class="message">
                        Great experience, from the listing to the post auction
                        follow-up, I will definitely use Cars and Bids again and
                        recommend it to all my friends!
                    </p>
                    <div class="client">
                        <img src="{{ asset('frontend/images/client.png') }}" alt="" />
                        <div>
                            <p>Prateek Kukreja</p>
                            <span>28th May 2024</span>
                        </div>
                    </div>
                    <!-- rating  -->
                    <div class="rating">
                        5.0
                        <svg xmlns="http://www.w3.org/2000/svg" width="104" height="19" viewBox="0 0 104 19"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.35274 1.06264L11.816 6.29745L17.3223 7.1371C17.4649 7.15925 17.5831 7.26391 17.6275 7.40724C17.6719 7.55057 17.6348 7.70782 17.5317 7.81313L13.5481 11.887L14.4886 17.6405C14.5134 17.7888 14.4553 17.939 14.3388 18.0277C14.2223 18.1163 14.0678 18.1281 13.9403 18.0579L9.01495 15.342L4.08961 18.0587C3.9622 18.1291 3.80757 18.1176 3.69104 18.0289C3.57451 17.9403 3.5164 17.79 3.54127 17.6416L4.48182 11.887L0.49704 7.81313C0.393979 7.70782 0.35688 7.55057 0.401282 7.40724C0.445684 7.26391 0.563921 7.15925 0.706469 7.1371L6.21281 6.29745L8.67717 1.06264C8.73988 0.927282 8.87109 0.841309 9.01495 0.841309C9.15882 0.841309 9.29003 0.927282 9.35274 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M30.9309 1.06264L33.3941 6.29745L38.9004 7.1371C39.043 7.15925 39.1612 7.26391 39.2056 7.40724C39.25 7.55057 39.2129 7.70782 39.1099 7.81313L35.1262 11.887L36.0668 17.6405C36.0915 17.7888 36.0334 17.939 35.9169 18.0277C35.8005 18.1163 35.6459 18.1281 35.5184 18.0579L30.5931 15.342L25.6677 18.0587C25.5403 18.1291 25.3857 18.1176 25.2692 18.0289C25.1526 17.9403 25.0945 17.79 25.1194 17.6416L26.0599 11.887L22.0752 7.81313C21.9721 7.70782 21.935 7.55057 21.9794 7.40724C22.0238 7.26391 22.142 7.15925 22.2846 7.1371L27.7909 6.29745L30.2553 1.06264C30.318 0.927282 30.4492 0.841309 30.5931 0.841309C30.7369 0.841309 30.8682 0.927282 30.9309 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M52.509 1.06264L54.9722 6.29745L60.4786 7.1371C60.6211 7.15925 60.7393 7.26391 60.7837 7.40724C60.8282 7.55057 60.7911 7.70782 60.688 7.81313L56.7043 11.887L57.6449 17.6405C57.6696 17.7888 57.6115 17.939 57.495 18.0277C57.3786 18.1163 57.224 18.1281 57.0965 18.0579L52.1712 15.342L47.2459 18.0587C47.1185 18.1291 46.9638 18.1176 46.8473 18.0289C46.7308 17.9403 46.6727 17.79 46.6975 17.6416L47.6381 11.887L43.6533 7.81313C43.5502 7.70782 43.5131 7.55057 43.5575 7.40724C43.6019 7.26391 43.7202 7.15925 43.8627 7.1371L49.3691 6.29745L51.8334 1.06264C51.8961 0.927282 52.0273 0.841309 52.1712 0.841309C52.3151 0.841309 52.4463 0.927282 52.509 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M74.091 1.06264L76.5543 6.29745L82.0606 7.1371C82.2031 7.15925 82.3214 7.26391 82.3658 7.40724C82.4102 7.55057 82.3731 7.70782 82.27 7.81313L78.2864 11.887L79.2269 17.6405C79.2516 17.7888 79.1935 17.939 79.0771 18.0277C78.9606 18.1163 78.8061 18.1281 78.6786 18.0579L73.7532 15.342L68.8279 18.0587C68.7005 18.1291 68.5459 18.1176 68.4293 18.0289C68.3128 17.9403 68.2547 17.79 68.2796 17.6416L69.2201 11.887L65.2353 7.81313C65.1323 7.70782 65.0952 7.55057 65.1396 7.40724C65.184 7.26391 65.3022 7.15925 65.4448 7.1371L70.9511 6.29745L73.4154 1.06264C73.4782 0.927282 73.6094 0.841309 73.7532 0.841309C73.8971 0.841309 74.0283 0.927282 74.091 1.06264Z"
                                fill="#FFF0EB" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M95.6691 1.06264L98.1324 6.29745L103.639 7.1371C103.781 7.15925 103.9 7.26391 103.944 7.40724C103.988 7.55057 103.951 7.70782 103.848 7.81313L99.8645 11.887L100.805 17.6405C100.83 17.7888 100.772 17.939 100.655 18.0277C100.539 18.1163 100.384 18.1281 100.257 18.0579L95.3314 15.342L90.406 18.0587C90.2786 18.1291 90.124 18.1176 90.0074 18.0289C89.8909 17.9403 89.8328 17.79 89.8577 17.6416L90.7982 11.887L86.8134 7.81313C86.7104 7.70782 86.6733 7.55057 86.7177 7.40724C86.7621 7.26391 86.8803 7.15925 87.0229 7.1371L92.5292 6.29745L94.9936 1.06264C95.0563 0.927282 95.1875 0.841309 95.3314 0.841309C95.4752 0.841309 95.6064 0.927282 95.6691 1.06264Z"
                                fill="#FFF0EB" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial area :: end  -->
</main>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Perform AJAX request to store in wishlist
        $('.wishlist-action').on('click', function() {
            var auctionId = $(this).data('auction-id');
            var $this = $(this);
            $.ajax({
                url: '{{ route('wishlist.add') }}',
                method: 'POST',
                data: {
                    auction_id: auctionId
                },
                success: (response) => {
                    // Toggle 'active' class based on response
                    $this.toggleClass('active', response.wished);

                    // Updating SVG path styles based on 'active' class
                    if (response.wished) {
                        $this.find('path').css({
                            'fill': 'var(--primary-color)',
                            'stroke': 'var(--primary-color)'
                        });
                    } else {
                        $this.find('path').css({
                            'fill': 'none',
                        });
                    }
                    toastr.success(response.message);
                },
                error: function(response) {
                    toastr.error('An error occurred while uploading the image.');
                }
            });
        });
    });
</script>


{{-- Google Translate  --}}
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
@endpush
