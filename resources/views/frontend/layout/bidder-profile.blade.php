@extends('frontend.app')

@section('main--content')
    @php
        use Carbon\Carbon;
        $bidder = $data['bidder'];
        $comments = $data['comments'];
        $totalComments = $data['totalComments'];
        $profile = $bidder->profile;
        $bids = $bidder->bids;

    @endphp
    <main>
        <!-- Profile Area :: Start  -->
        <section class="profile--area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile--contents--wrap" data-aos="fade-in" data-aos-duration="1500">
                            <!-- profile--contents  -->
                            <div class="profile--contents">
                                <!-- preview--img  -->
                                <form action="#" data-aos="fade-up" data-aos-duration="1000">
                                    <div class="preview--img">
                                        <img id="image-preview"
                                            src="{{ $profile->avatar ? $profile->avatar : asset('frontend/images/user_placeholder.png') }}"
                                            alt="" />
                                    </div>
                                </form>
                                <!-- profile--name  -->
                                <div class="profile--name">
                                    <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                        {{ $bidder->full_name ?? 'Unknone' }}
                                    </h1>
                                    <ul data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                        <li>Contact Number : {{ $profile->phone ?? 'Unknone' }}</li>
                                        <li>Address : {{ $profile->address ?? 'Unknone' }}</li>
                                    </ul>
                                    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                        {{ $profile->bio ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Profile Area :: End  -->

        <!-- Bidder Profile History Area :: Start  -->
        <section class="bidder--profile--history">
            <div class="container">
                <!-- car--auctioned  -->
                <div class="car--auctioned">
                    <h4 data-aos="fade-up" data-aos-duration="1000" data-aos-offset="0">
                        Cars Auctioned
                        {{-- <span>(Listed 3 car, Sold 1) </span> --}}
                    </h4>
                    <div class="row">
                        @foreach ($bidder->auctions as $auction)
                            <div class="col-xxl-3 col-lg-4 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="100" data-aos-offset="0">
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                        viewBox="0 0 23 23" fill="none">
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
                                                    {{ $auction->maxBid() ?? '' }}
                                                </p>
                                            @endif

                                            {{-- add to wishlist --}}
                                            @auth
                                                <svg class="wishlist-action star {{ $auction->isWished() ? 'active' : '' }}"
                                                    data-auction-id="{{ $auction->id }}" width="24px" height="24px"
                                                    viewBox="0 0 24 24" fill='none' xmlns="http://www.w3.org/2000/svg">
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

                                                @if ($auction->status === 'approve' && $auction->end > now())
                                                    <a href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}"
                                                        class="buttonv2 button">Place a Bid</a>
                                                @else
                                                    <a href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}"
                                                        class="buttonv2 button">Visit</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- bid--history -->
                <div class="bid--history mt_60">
                    <h4 data-aos="fade-up" data-aos-duration="1000">
                        Bid History
                        {{-- <span>(Bid on 2 cars, 1 win)</span> --}}
                    </h4>
                    <div class="row">
                        @foreach ($bids as $bid)
                            @php
                                $auction = $bid->auction;
                            @endphp
                            <div class="col-xxl-3 col-lg-4 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="50">
                                <!-- car card  -->
                                <div class="car--card">
                                    <div class="img--area">
                                        <img class="w-100" src="{{ $auction->auctionImageGallery[0]->url }}"
                                            alt="" />
                                    </div>
                                    <div class="car--info">
                                        @if ($auction->maxBid() == $bid->bid && $auction->end < now())
                                            <div class="bid--info" style="background-color: #fd7f54;">
                                                <p style=" color:white;">Bid {{ $bid->bid }}</p>
                                                <p style=" color:white;">Winner</p>
                                            </div>
                                        @else
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
                                                        {{ $auction->maxBid() ?? '' }}
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
                                        @endif

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

                                                @if ($auction->status === 'approve' && $auction->end > now())
                                                    <a href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}"
                                                        class="buttonv2 button">Place a Bid</a>
                                                @else
                                                    <a href="{{ route('show.auction', ['auction' => $auction, 'slug' => Str::slug(($auction->year ?? '') . '-' . ($auction->model ?? 'auction-car-model'))]) }}"
                                                        class="buttonv2 button">Visit</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- auction--comments  -->
                <div class="auction--comments mt_45">
                    <h4 data-aos="fade-up" data-aos-duration="1000">
                        Auction Comments
                        {{-- <span>(25 comments)</span> --}}
                    </h4>
                    <div class="col-12">
                        @foreach ($comments as $comment)
                            @php
                                $auction = $comment->commentable;
                            @endphp
                            <!-- single auction comments card  -->
                            <div class="auction--comment--card" data-aos="fade-up" data-aos-duration="1000">
                                <!-- img area  -->
                                <div class="img--area">
                                    <img src="{{ $auction->auctionImageGallery[0]->url }}" alt="" />
                                    <div class="bid--info">
                                        <p>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22"
                                                viewBox="0 0 23 22" fill="none">
                                                <path
                                                    d="M11.7334 19.9131C6.7677 19.9131 2.74219 15.8876 2.74219 10.9219C2.74219 5.95617 6.7677 1.93066 11.7334 1.93066C16.6991 1.93066 20.7246 5.95617 20.7246 10.9219C20.7246 15.8876 16.6991 19.9131 11.7334 19.9131ZM11.7334 18.1149C15.706 18.1149 18.9264 14.8945 18.9264 10.9219C18.9264 6.94932 15.706 3.72891 11.7334 3.72891C7.76084 3.72891 4.54043 6.94932 4.54043 10.9219C4.54043 14.8945 7.76084 18.1149 11.7334 18.1149ZM12.6325 10.9219H16.229V12.7201H10.8343V6.42628H12.6325V10.9219Z"
                                                    fill="#141414" />
                                            </svg>
                                            End in {{ $end->diffForHumans($now) ?? '' }}
                                        </p>
                                        <p><span>Bid:</span> {{ $auction->maxBid() ?? 0 }}</p>
                                    </div>
                                </div>
                                <!-- details area  -->
                                <div class="details--area">
                                    <h3>{{ $auction->year ?? '' }}{{ ' ' }}{{ $auction->model ?? '' }}</h3>
                                    <p class="date">{{ Carbon::parse($auction->created_at)->format('d/m/Y H:i:s') }}</p>
                                    <span>Re: {{ $comment->body }}</span>
                                    <div class="replay">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                                viewBox="0 0 27 27" fill="none">
                                                <path
                                                    d="M19.2266 10.3289C19.2266 14.5214 15.5866 17.9123 11.1016 17.9123L10.0941 19.1256L9.49823 19.8406C8.98907 20.4473 8.01406 20.3173 7.67823 19.5914L6.22656 16.3956C4.2549 15.0089 2.97656 12.8098 2.97656 10.3289C2.97656 6.13644 6.61656 2.74561 11.1016 2.74561C14.3732 2.74561 17.2007 4.55478 18.4682 7.15478C18.9557 8.11895 19.2266 9.19144 19.2266 10.3289Z"
                                                    stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M24.6429 14.5106C24.6429 16.9914 23.3646 19.1906 21.3929 20.5773L19.9412 23.7731C19.6054 24.4989 18.6304 24.6398 18.1212 24.0223L16.5179 22.0939C13.8962 22.0939 11.5562 20.9348 10.0938 19.1256L11.1012 17.9123C15.5862 17.9123 19.2262 14.5214 19.2262 10.3289C19.2262 9.19144 18.9554 8.11895 18.4679 7.15479C22.0104 7.96729 24.6429 10.9573 24.6429 14.5106Z"
                                                    stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M8.39844 10.3291H13.8151" stroke="#FD7F54" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <p>Replay <span>{{ count($comment->children) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($totalComments > 4)
                            {{-- Lode all --}}
                            <div class="buttons mt_55" data-aos="fade-in" data-aos-duration="1500">
                                <a href="{{ route('bidder.profile.all', ['id' => $bidder, 'slug' => Str::slug($bidder->full_name ?? '')]) }}"
                                    class="button">Load More Comments</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- Bidder Profile History Area :: End  -->
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
