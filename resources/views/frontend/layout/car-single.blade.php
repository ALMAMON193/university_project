@extends('frontend.app')

@push('style')
    <style>
        .watch-star {
            right: 25px;
            opacity: 1;
        }

        .watch-star.active path {
            fill: var(--primary-color);
            stroke: var(--primary-color);
        }
    </style>
@endpush

@section('main--content')
    @php
        $now = \Carbon\Carbon::now();
        $auctions = $data['auctions'];
        $auction = $data['auction'];
        $cms = $data['cms'];
        $images = $auction->auctionImageGallery ?? null;
    @endphp
    <main>
        <!-- Single Car Hero Area :: Start  -->
        <section class="single--car--hero hero--slider">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- name--area  -->
                        <div class="name--area" data-aos="fade-in" data-aos-duration="1500">
                            <div>
                                <h1>{{ $auction->year ?? '' }} {{ ' ' }} {{ $auction->model }}</h1>
                                <p>
                                    {{ $auction->engine ?? '' }}{{ ', ' }}
                                    {{ $auction->drivetrain ?? 'N/A' }}{{ ', ' }}
                                    {{ $auction->title_status ?? 'N/A' }} {{ ', ' }}
                                    {{ $auction->state->name ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="btn--group">
                                @if ($auction->end > now())
                                    @auth
                                        <a class="wishlist-action" data-auction-id="{{ $auction->id }}">
                                            <svg class="watch-star {{ $auction->isWished() ? 'active' : '' }}"
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.421 18.7C3.685 19.193 4.2 19.501 4.76 19.5C4.996 19.501 5.23 19.446 5.44 19.34L9.992 16.96C10.004 16.953 10.018 16.949 10.032 16.95L14.553 19.31C14.772 19.428 15.017 19.489 15.265 19.488C15.344 19.488 15.424 19.481 15.502 19.47C16.316 19.337 16.872 18.575 16.752 17.76L15.872 12.75C15.8671 12.7429 15.8656 12.7424 15.8652 12.7416C15.865 12.7412 15.865 12.7409 15.865 12.74C15.865 12.737 15.872 12.73 15.872 12.73L19.542 9.18C20.084 8.657 20.153 7.814 19.702 7.21C19.457 6.894 19.098 6.686 18.702 6.63L13.64 5.9C13.631 5.9 13.621 5.89 13.611 5.88L11.35 1.34C11.095 0.827 10.573 0.503 10 0.5C9.834 0.5 9.668 0.526 9.51 0.58C9.131 0.709 8.818 0.981 8.64 1.34L6.382 5.867C6.382 5.888 6.361 5.897 6.341 5.897L1.291 6.627C0.982 6.679 0.694 6.817 0.461 7.027C0.166 7.316 0 7.713 0 8.127C0.001 8.52 0.159 8.896 0.44 9.17L4.14 12.73C4.148 12.738 4.151 12.749 4.151 12.76L3.26 17.75C3.207 18.076 3.264 18.41 3.421 18.7ZM9.971 1.967L9.981 1.96H10L10.009 1.969C10.018 1.969 10.026 1.971 10.033 1.977C10.039 1.983 10.042 1.991 10.041 2L12.301 6.519C12.518 6.964 12.94 7.274 13.43 7.349L18.492 8.085C18.501 8.085 18.51 8.087 18.518 8.091C18.523 8.092 18.527 8.092 18.532 8.091L18.542 8.1L18.532 8.122L14.862 11.681C14.497 12.023 14.334 12.529 14.431 13.02L15.312 18.001L15.292 18.02H15.271C15.267 18.022 15.263 18.022 15.259 18.02C15.249 18.019 15.239 18.015 15.23 18.01H15.221L10.721 15.66C10.505 15.548 10.265 15.488 10.021 15.489C9.77 15.489 9.522 15.552 9.3 15.67L4.771 18.045C4.766 18.046 4.76 18.046 4.755 18.045C4.734 18.045 4.716 18.031 4.711 18.011V17.991L5.591 13.011C5.673 12.524 5.513 12.027 5.161 11.681L1.461 8.131C1.46 8.116 1.462 8.103 1.47 8.09L1.531 8.07L6.561 7.349C7.051 7.273 7.472 6.964 7.69 6.519L9.951 1.989C9.956 1.98 9.962 1.972 9.971 1.967Z"
                                                    fill="#FD7F54" />
                                            </svg>
                                            Watch
                                        </a>
                                    @endauth
                                @endif
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                        viewBox="0 0 21 20" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.2048 2.59154C20.5164 1.18588 19.2092 -0.0825198 17.7939 0.327077L2.13738 4.88281L1.98628 4.93304C0.516697 5.48611 0.291214 7.53286 1.66768 8.38023L8.14322 12.3661L12.039 18.8202L12.1265 18.9534C13.0398 20.2329 15.062 19.923 15.5231 18.372L20.1682 2.73251L20.2048 2.59154ZM18.2849 1.75323C18.5737 1.72222 18.8204 2.00312 18.7305 2.30473L14.0852 17.9448L14.0547 18.0214C13.9096 18.3069 13.4988 18.336 13.3232 18.0451L9.63522 11.9361L14.8877 6.64975L14.9601 6.56539C15.1769 6.27106 15.1513 5.85447 14.8842 5.5891L14.7998 5.51676C14.5055 5.29988 14.0889 5.32548 13.8235 5.59263L8.57822 10.8721L2.45398 7.10284L2.38786 7.05318C2.15003 6.83652 2.23008 6.41781 2.55598 6.32322L18.2119 1.76765L18.2849 1.75323Z"
                                            fill="#FD7F54" />
                                    </svg>
                                    Share
                                </a>
                            </div>
                        </div>
                        <!-- single car images  -->
                        <div class="single--car--images mt_25 mb_40">
                            <div class="slider--box">
                                <div class="row">
                                    <div class="col-lg-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                        data-aos-delay="300" data-aos-offset="0">
                                        {{-- showing the first image --}}
                                        <a href="#" class="featured--car">
                                            <img src="{{ $images[0]->url ?? 'frontend/images/placeholder/image_placeholder.png' }}"
                                                alt="banner-image" />
                                        </a>
                                    </div>
                                    <div class="col-lg-6 slider-right-box">
                                        <div class="row">
                                            {{-- showing image 2 to 4 --}}
                                            @for ($i = 1; $i < count($images) && $i <= 3; $i++)
                                                <div class="col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                                    data-aos-delay="400" data-aos-offset="0">
                                                    <a>
                                                        <img class="w-100"
                                                            src="{{ $images[$i]->url ?? 'frontend/images/placeholder/image_placeholder.png' }}"
                                                            alt="" />
                                                    </a>
                                                </div>
                                            @endfor
                                            <!-- By clicking this things on the lightbox gallery will show -->
                                            <div class="col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                                data-aos-delay="700">
                                                <a href="#" class="more--photos--box" id="morePhotosBox">
                                                    {{ count($images) - 4 }}+<br />
                                                    Photos
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- place bid  -->
                        <div class="place--bid--wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800"
                            data-aos-offset="0">
                            <!-- single info  -->
                            <div class="single--info">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path
                                            d="M23.8346 13.0001C23.8346 18.9801 18.9813 23.8334 13.0013 23.8334C7.0213 23.8334 2.16797 18.9801 2.16797 13.0001C2.16797 7.02008 7.0213 2.16675 13.0013 2.16675C18.9813 2.16675 23.8346 7.02008 23.8346 13.0001Z"
                                            stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17.0177 16.4449L13.6593 14.4407C13.0743 14.0941 12.5977 13.2599 12.5977 12.5774V8.13574"
                                            stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                {{-- {{dd($auction->end)}} --}}
                                @php
                                    $end = \Carbon\Carbon::parse($auction->end);
                                    $now = \Carbon\Carbon::now();
                                @endphp
                                <p>End in <strong>{{ $end->diffForHumans($now) ?? '' }}</strong></p>
                            </div>
                            <!-- single info  -->
                            <div class="single--info">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path d="M9.76255 22.2083L4.32422 16.7808" stroke="#FD7F54" stroke-opacity="0.47"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.76172 3.79175V22.2084" stroke="#FD7F54" stroke-opacity="0.47"
                                            stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16.2383 3.79175L21.6766 9.21925" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16.2383 22.2084V3.79175" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <p>High Bid <strong class="auction_price_{{ $auction->id }}">${{ $auction->maxBid() ?? 0 }}</strong></p>
                            </div>
                            <!-- single info  -->
                            <div class="single--info">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path d="M18.5785 14.9717L15.2852 18.265" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.42188 14.9717H18.5802" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M7.42188 11.0284L10.7152 7.73511" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18.5802 11.0283H7.42188" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M13.0013 23.8334C18.9844 23.8334 23.8346 18.9832 23.8346 13.0001C23.8346 7.017 18.9844 2.16675 13.0013 2.16675C7.01822 2.16675 2.16797 7.017 2.16797 13.0001C2.16797 18.9832 7.01822 23.8334 13.0013 23.8334Z"
                                            stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <p>Total Bids <strong>{{ count($auction->bids) ?? 0 }}</strong></p>
                            </div>
                            <!-- single info  -->
                            <div class="single--info">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 26 26" fill="none">
                                        <path
                                            d="M18.418 9.75008C18.418 13.9426 14.778 17.3334 10.293 17.3334L9.28548 18.5467L8.68964 19.2618C8.18047 19.8684 7.20546 19.7384 6.86963 19.0126L5.41797 15.8167C3.4463 14.4301 2.16797 12.2309 2.16797 9.75008C2.16797 5.55758 5.80797 2.16675 10.293 2.16675C13.5646 2.16675 16.3921 3.97592 17.6596 6.57592C18.1471 7.54009 18.418 8.61258 18.418 9.75008Z"
                                            stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M23.8343 13.9317C23.8343 16.4126 22.556 18.6118 20.5843 19.9984L19.1327 23.1942C18.7968 23.9201 17.8218 24.0609 17.3126 23.4434L15.7093 21.5151C13.0876 21.5151 10.7477 20.3559 9.28516 18.5467L10.2926 17.3334C14.7776 17.3334 18.4176 13.9426 18.4176 9.75009C18.4176 8.61259 18.1468 7.54009 17.6593 6.57593C21.2018 7.38843 23.8343 10.3784 23.8343 13.9317Z"
                                            stroke="#FD7F54" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7.58203 9.75H12.9987" stroke="#FD7F54" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <p>Comments <strong>{{ count($auction->comments) ?? 0 }}</strong></p>
                            </div>
                            <!-- place button  -->
                            @auth
                                @if ($auction->end >= now() && $auction->status == 'approve')
                                    <a href="#" class="button place-bid-button">Place Bid</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!-- lightbox gallery  -->
            <div class="gallery">
                {{-- showing image 4 to all other images --}}
                @for ($i = 4; $i < count($images); $i++)
                    <a href="{{ $images[$i]->url ?? 'frontend/images/placeholder/image_placeholder.png' }}"> </a>
                @endfor
            </div>
        </section>
        <!-- Single Car Hero Area :: End  -->

        <!-- Details and More Area :: Start  -->
        <section class="details--and--morearea">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 col-lg-5 mt_30">
                        <!-- car-details-table--wrapper  -->
                        <div class="car-details-table--wrapper" data-aos="fade-up" data-aos-duration="1000">
                            <!-- title  -->
                            <div class="title">
                                <h3>Carfax Car Center</h3>
                                <p>Ending {{ $auction->end }}</p>
                            </div>
                            <!-- table  -->
                            <div class="table--wrapper">
                                <!-- table  -->
                                <div class="table">
                                    <div class="tr">
                                        <div class="tt">Make</div>
                                        <div class="td">{{ $auction->make ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Model</div>
                                        <div class="td">{{ $auction->model ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Mileage</div>
                                        <div class="td">{{ $auction->mileage ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">VIN Number</div>
                                        <div class="td">{{ $auction->vin_number ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Title Status</div>
                                        <div class="td">{{ $auction->title_status ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Location</div>
                                        <div class="td">{{ $auction->title_status ?? 'N/A' }} {{ ', ' }}
                                            {{ $auction->state->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr seller">
                                        <div class="tt">Seller</div>
                                        <div class="td">
                                            <div class="s-profile">
                                                <img src="{{ $auction->user->profile->avatar ?? asset('/frontend/images/user_placeholder.png') }}"
                                                    alt="{{ $auction->user->full_name ?? 'User' }}" />
                                                {{ $auction->user->full_name ?? 'User' }}
                                            </div>
                                            {{-- redirect to the user profile --}}
                                            <a
                                                href="{{ route('bidder.profile', ['id' => $auction->user, 'slug' => Str::slug($auction->user->full_name ?? '')]) }}">Contact</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- table  -->
                                <div class="table">
                                    <div class="tr">
                                        <div class="tt">Engine</div>
                                        <div class="td">{{ $auction->engine ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Drivetrain</div>
                                        <div class="td">{{ $auction->drivetrain ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Transmission</div>
                                        <div class="td">{{ $auction->transmission ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Body Style</div>
                                        <div class="td">{{ $auction->body_style ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Exterior color</div>
                                        <div class="td">{{ $auction->exterior_color ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Interior Color</div>
                                        <div class="td">{{ $auction->enterior_color ?? 'N/A' }}</div>
                                    </div>
                                    <div class="tr">
                                        <div class="tt">Seller Type</div>
                                        <div class="td">{{ $auction->user->profile->type ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- single review  -->
                            <div class="single--review details" data-aos="fade-up" data-aos-duration="1000">
                                <!-- profile  -->
                                <div class="profile">
                                    <img src="{{ $cms[6]->image_url ?? asset('frontend/images/about.png') }}"
                                        alt="" />
                                    <p>{{ $cms[6]->title ?? 'Smart Car Auction' }}</p>
                                </div>
                                @if ($cms[6]->sub_title)
                                    {!! $cms[6]->sub_title !!}
                                @else
                                    <p class="message">

                                        Now THIS is really cool – it's our first Lotus Emira on Cars
                                        & Bids! I reviewed the Emira last year and I loved its
                                        exotic styling, its nimble handling, and its potent
                                        400-horsepower supercharged V6. This particular Emira is
                                        equipped with the desirable 6-speed manual transmission, and
                                        it's finished in a handsome color combination that's
                                        enhanced by the Full Black Pack and gloss black 20-inch
                                        forged wheels. It also features some great equipment like a
                                        sport suspension system, titanium exhaust tips, heated front
                                        seats, Alcantara upholstery, and a KEF Uni-Q audio system.
                                        Plus, this Emira is essentially brand new with under 30
                                        miles on the odometer.
                                        miles on the odometer.
                                    </p>
                                @endif
                            </div>
                            <!-- highlights  -->
                            <div class="highlights details mt_65" data-aos="fade-up" data-aos-duration="1000">
                                <h4>Highlights</h4>
                                @if ($auction->flaw)
                                    {!! $auction->flaw_text !!}
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <!-- Equipment  -->
                            <div class="equipment details mt_35" data-aos="fade-up" data-aos-duration="1000">
                                <h4>Equipment</h4>
                                @if ($auction->equipment)
                                    {!! $auction->equipment !!}
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <!-- rent--history  -->
                            <div class="rent--history details mt_35" data-aos="fade-up" data-aos-duration="1000">
                                <h4>Recent Service History</h4>
                                @if ($auction->modify)
                                    {!! $auction->modify_text !!}
                                @else
                                    <p>No History...</p>
                                @endif
                            </div>
                            <!-- other items  -->
                            {{-- <div class="other--items details mt_35" data-aos="fade-up" data-aos-duration="1000">
                                 <h4>Other Items Included in Sale</h4>
                                 <ul>
                                     <li>2 keys</li>
                                     <li>Owner's manuals</li>
                                     <li>Window sticker</li>
                                 </ul>
                             </div >  --}}
                            <!-- ownership history  -->
                            <div class="ownership--history details mt_35" data-aos="fade-up" data-aos-duration="1000">
                                <h4>Ownership History</h4>
                                @if ($auction->ownership_history)
                                    {!! $auction->ownership_history !!}
                                @else
                                    <p>No history added....!</p>
                                @endif
                            </div>
                            <!-- car videos  -->
                            <div class="car--videos mt_35" data-aos="fade-up" data-aos-duration="1000">
                                <h4>Videos</h4>
                                <div class="row">
                                    {{-- showing all the videos available --}}
                                    @foreach ($auction->auctionVideoGallery as $video)
                                        <div class="col-md-6">
                                            <div class="single--video mt-15">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <video class="embed-responsive-item" width="320" height="240"
                                                        controls>
                                                        <source src="{{ $video->url }}">
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <livewire:comments :model="$auction" />
                        </div>
                    </div>
                    <div class="col-xxl-6 col-lg-7 mt_30">
                        <!-- action--ending--soon  -->
                        <div class="action--ending--soon">
                            <h3 data-aos="fade-in" data-aos-duration="1500">
                                Auctions Ending Soon
                            </h3>
                            <div class="row">
                                @foreach ($auctions as $auction_e_s)
                                    <div class="col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000">
                                        <div class="car--card">
                                            <div class="img--area">
                                                <img class="w-100" src="{{ $auction_e_s->auctionImageGallery[0]->url }}"
                                                    alt="" />
                                            </div>
                                            <div class="car--info">
                                                <div class="bid--info">
                                                    {{-- if status is approve then end time will show --}}
                                                    @if ($auction_e_s->status === 'approve')
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
                                                    @if ($auction_e_s->status === 'pending')
                                                        <p>
                                                            <span style="color:red">Pending</span>
                                                        </p>
                                                    @else
                                                        <p>
                                                            <span>Bid</span>
                                                            {{ $auction_e_s->maxBid() ?? '' }}
                                                        </p>
                                                    @endif

                                                    {{-- add to wishlist --}}
                                                    @auth
                                                        <svg class="wishlist-action star {{ $auction_e_s->isWished() ? 'active' : '' }}"
                                                            data-auction-id="{{ $auction->id }}" width="24px"
                                                            height="24px" viewBox="0 0 24 24" fill='none'
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
                                                        href="{{ route('show.auction', ['auction' => $auction_e_s, 'slug' => Str::slug(($auction_e_s->year ?? '') . '-' . ($auction_e_s->model ?? 'auction-car-model'))]) }}">
                                                        {{ $auction_e_s->year ?? '' }}{{ ' ' }}{{ $auction_e_s->model ?? '' }}</a>
                                                    <p>
                                                        {{ $auction_e_s->engine ?? '' }}{{ ', ' }}
                                                        {{ $auction_e_s->drivetrain ?? 'N/A' }}{{ ', ' }}
                                                        {{ $auction_e_s->title_status ?? 'N/A' }} {{ ', ' }}
                                                        {{ $auction_e_s->state->name ?? 'N/A' }}
                                                        {{--                                            1 Owner, Dual-Motor AWD, Florida-Owned, Mostly Unmodified --}}

                                                    </p>
                                                    <div class="card--footer">
                                                        <p>{{ $auction_e_s->user->profile->city ?? '' }},{{ ' ' }}{{ $auction_e_s->user->profile->state->name ?? '' }},{{ ' ' }}
                                                            {{ $auction_e_s->user->profile->zip ?? '' }}</p>

                                                        @if ($auction_e_s->status === 'approve')
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
                    </div>
                </div>
            </div>
        </section>
        <!-- Details and More Area :: End  -->

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

        <!-- popup start  -->
        <div class="register--bid--popup bid--popup common-input">
            <!-- top title  -->
            <div class="top--title">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
                    </a>
                </div>
                <h3>Bid</h3>
                <p>
                    To place a bid, you must deposit 2% of your bid amount.
                    If you win, this deposit will be charged automatically.
                    You can withdraw any remaining funds from your account at any time.
                </p>
            </div>
            <!-- credit card info  -->
            <div class="credit--card--information">
                <form action="{{ route('bid.create') }}" method="post" class="needs-validation" id="bidForm"
                    novalidate>
                    @csrf
                    @method('POST')
                    <h4>Credit Card Information</h4>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="input--group">
                                <label for="bid">Amount</label>
                                <input type="number" class="form-control" name="bid" id="bid"
                                       value="{{ (float)$auction->maxBid() + 50 ?? 0 }}"
                                    placeholder="Next Bid ${{ (float)$auction->maxBid() + 50 ?? 0 }}" />
                                <div class="invalid-feedback">
                                    Please enter the bid amount.
                                </div>
                                @error('bid')
                                    <p class="text-danger" style="font-size: 12px">
                                        {{-- Please enter a valid email address. --}}
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">


                            <input value="{{ $auction->id }}" name="auction_id" hidden>

                            <button type="submit" class="button w-100 mt_45">
                                Bid
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16"
                                    viewBox="0 0 18 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.707159 7.17715C0.307804 7.23213 0 7.57953 0 7.99989C0 8.45846 0.366312 8.83021 0.818182 8.83021L15.1999 8.83021L10.0047 14.0813L9.92528 14.1743C9.68696 14.4989 9.71243 14.9602 10.0023 15.2556C10.3212 15.5805 10.8392 15.5816 11.1594 15.258L17.7477 8.59955C17.787 8.56142 17.8224 8.51937 17.8536 8.47401C18.0766 8.14976 18.0452 7.69994 17.7593 7.41106L11.1593 0.741932L11.0674 0.661737C10.7466 0.421253 10.2921 0.449045 10.0023 0.744461C9.68342 1.06942 9.68454 1.59515 10.0047 1.91871L15.2012 7.16957L0.818182 7.16957L0.707159 7.17715Z"
                                        fill="white" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- close popup  -->
            <div class="close--pop">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 37 37"
                    fill="none">
                    <path
                        d="M18.4986 16.3209L26.1295 8.68994L28.3098 10.8702L20.6788 18.5011L28.3098 26.1319L26.1295 28.3121L18.4986 20.6813L10.8678 28.3121L8.6875 26.1319L16.3184 18.5011L8.6875 10.8702L10.8678 8.68994L18.4986 16.3209Z"
                        fill="#141414" />
                </svg>
            </div>
        </div>
        <!-- popup end  -->
        <div class="step-bid--popup bid--popup common-input">
            <form action="#" id="bid-form">
                <!-- step  -->
                <div class="step">
                    <!-- logo  -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('frontend/images/logo.svg') }}" alt="" />
                        </a>
                    </div>
                    <!-- car image area  -->
                    <div class="car--details">
                        <img src="{{ asset('frontend/images/car6.png') }}" alt="" />
                        <!-- car title  -->
                        <div class="common-car--title">
                            <h3>1996 Nissan Skyline GT-R</h3>
                            <ul>
                                <li>3 Days</li>
                                <li>Current Bid $25,000</li>
                            </ul>
                        </div>
                        <div class="input--group">
                            <label for="current-bid">Current Bid
                                <span>(Minimum bid increment is $250. All bids in USD)</span></label>
                            <!-- usd  -->
                            <div class="usd">
                                <input type="text" placeholder="USD ($)" />
                                <input type="text" value="25,0000" />
                            </div>
                        </div>
                    </div>
                    <!-- buttons  -->
                    @auth
                        <div class="buttons">
                            <a href="#" class="button bid-next-button w-100 mt_45">
                                Place Bid
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 19 16"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1.20716 7.17715C0.807804 7.23213 0.5 7.57953 0.5 7.99989C0.5 8.45846 0.866312 8.83021 1.31818 8.83021L15.6999 8.83021L10.5047 14.0813L10.4253 14.1743C10.187 14.4989 10.2124 14.9602 10.5023 15.2556C10.8212 15.5805 11.3392 15.5816 11.6594 15.258L18.2477 8.59955C18.287 8.56142 18.3224 8.51937 18.3536 8.47401C18.5766 8.14976 18.5452 7.69994 18.2593 7.41106L11.6593 0.741932L11.5674 0.661737C11.2466 0.421253 10.7921 0.449045 10.5023 0.744461C10.1834 1.06942 10.1845 1.59515 10.5047 1.91871L15.7012 7.16957L1.31818 7.16957L1.20716 7.17715Z"
                                        fill="white" />
                                </svg>
                            </a>
                        </div>
                    @endauth
                </div>
                <div class="step">
                    <!-- common-car--title  -->
                    <div class="common-car--title">
                        <h3>1996 Nissan Skyline GT-R</h3>
                        <ul>
                            <li>3 Days</li>
                            <li>Current Bid $25,000</li>
                        </ul>
                    </div>
                    <!-- biding information  -->
                    <div class="biding--information">
                        <h4>Biding Information</h4>
                        <ul>
                            <li>
                                <p>Your Bid :</p>
                                <p>$25,750 USD</p>
                            </li>
                            <li>
                                <p>C&B Buyer’s Fee :</p>
                                <p>$1,158.75 USD</p>
                            </li>
                        </ul>
                        <!-- more--info -->
                        <div class="more--info">
                            <p>
                                <strong>Bidding will instantly reach $25,750</strong>. The
                                winning bidder pays Saudi Car Hub a 2% buyer's fee on top of
                                the winning bid.
                            </p>
                            <p class="mt_20">
                                We will place a hold on your credit card for the buyer's fee.
                                If you win, your card will be charged the fee at the end of
                                the auction, and you will pay the seller directly for the
                                vehicle. If you don't win, your hold will be released at
                                auction end.
                            </p>
                            <p class="mt_20">
                                <strong> Bids are binding and cannot be retracted</strong>.
                                You are responsible for completing all due diligence prior to
                                bidding. By placing this bid, you agree to the Saudi Car Hub
                                <a href="#">Terms of Use</a>.
                            </p>
                        </div>
                    </div>
                    <!-- button  -->
                    <div class="buttons">
                        <button class="button w-100 bid-submit-button mt_50">
                            Confirm Bid
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 19 16"
                                fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.20716 7.17715C0.807804 7.23213 0.5 7.57953 0.5 7.99989C0.5 8.45846 0.866312 8.83021 1.31818 8.83021L15.6999 8.83021L10.5047 14.0813L10.4253 14.1743C10.187 14.4989 10.2124 14.9602 10.5023 15.2556C10.8212 15.5805 11.3392 15.5816 11.6594 15.258L18.2477 8.59955C18.287 8.56142 18.3224 8.51937 18.3536 8.47401C18.5766 8.14976 18.5452 7.69994 18.2593 7.41106L11.6593 0.741932L11.5674 0.661737C11.2466 0.421253 10.7921 0.449045 10.5023 0.744461C10.1834 1.06942 10.1845 1.59515 10.5047 1.91871L15.7012 7.16957L1.31818 7.16957L1.20716 7.17715Z"
                                    fill="white" />
                            </svg>
                        </button>
                        <a href="#" class="button w-100 mt_25 bid-cancle">Cancle</a>
                    </div>
                </div>
            </form>
            <!-- close popup  -->
            <div class="close--pop">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" viewBox="0 0 37 37"
                    fill="none">
                    <path
                        d="M18.4986 16.3209L26.1295 8.68994L28.3098 10.8702L20.6788 18.5011L28.3098 26.1319L26.1295 28.3121L18.4986 20.6813L10.8678 28.3121L8.6875 26.1319L16.3184 18.5011L8.6875 10.8702L10.8678 8.68994L18.4986 16.3209Z"
                        fill="#141414" />
                </svg>
            </div>
        </div>
        <!-- overlay black  -->
        <div class="overlay--black"></div>
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
                                'fill': '#FD7F54',
                                'stroke': 'none'
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

        // Preventing the bid model when when bid amount is empty or 0

        document.getElementById('bidForm').addEventListener('submit', function(event) {
            let bidInput = document.getElementById('bid');
            let bidValue = bidInput.value;

            //  checking if bid value is empty or 0

            if (bidValue === '' || bidValue <= 0) {
                bidInput.classList.add('is-invalid');
                event.preventDefault();
            } else {
                bidInput.classList.remove('is-invalid');
            }
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
