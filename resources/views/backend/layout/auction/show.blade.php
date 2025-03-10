@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}

@push('style')
    <style>
        .table--wrapper {
            display: flex;
            align-items: start;
        }

        .table--wrapper .table {
            border: 1px solid rgba(90, 92, 95, 0.4);
            width: 100%;
        }

        .table--wrapper .table .tr {
            display: flex;
            align-items: center;
        }

        .table--wrapper .table .tt,
        .table--wrapper .table .td {
            padding: 15px 20px;
            height: 54px;
        }

        .table--wrapper .table .tr:last-child .tt,
        .table--wrapper .table .tr:last-child .td {
            border-bottom: 0;
        }

        .table--wrapper .table .tt {
            border-bottom: 1px solid rgba(90, 92, 95, 0.4);
            border-right: 1px solid rgba(90, 92, 95, 0.4);
            width: 35%;
            font-weight: 600;
            white-space: nowrap;
        }

        .table--wrapper .table .td {
            width: 65%;
            border-bottom: 1px solid rgba(90, 92, 95, 0.4);
        }

        .table--wrapper .table .td a {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .table--wrapper .table .tr.seller .td {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .table--wrapper .table .tr.seller .td .s-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0;
        }

        .table--wrapper .table .tr.seller .td .s-profile img {
            height: 28px;
            width: 28px;
            object-fit: cover;
            border-radius: 50%;
        }

        .name--area h1 {
            font-size: 32px;
            font-style: normal;
            font-weight: 600;
            line-height: 49px;
            letter-spacing: -0.32px;
            margin-bottom: 12px;
        }

        .name--area p {
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 32.8px;
        }

        .btn--group {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 20px;
        }

        .name--area a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            padding: 8px 21px;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 26.24px;
            text-transform: capitalize;
            border: 1px solid var(--primary-color);
            gap: 10px;
            color: var(--primary-color);
        }

        .single--car--images .featured--car {
            padding: 0;
        }

        .single--car--images .featured--car img {
            height: 100%;
            width: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .slider-right-box img {
            height: 249px;
        }

        .more--photos--box {
            height: 250px;
            background-color: var(--primary-shade);
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            font-size: 25px;
            font-style: normal;
            font-weight: 600;
            line-height: 34px;
            color: var(--primary-color);
            text-align: center;
            cursor: pointer;
        }

        .place--bid--wrapper {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 48px;
            background-color: rgba(0, 0, 0, 0.04);
            padding: 18px 24px;
            position: relative;
        }

        .place--bid--wrapper .single--info {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 12px;
        }

        .place--bid--wrapper .single--info .icon {
            width: 48px;
            height: 48px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--primary-shade);
        }

        .place--bid--wrapper .single--info p strong {
            color: var(--heading-color);
        }

        .place--bid--wrapper .single--info .icon svg {
            width: 26px;
            height: 26px;
        }

        .place--bid--wrapper .button {
            position: absolute;
            right: 20px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .title {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .title h3 {
            font-size: 32px;
            font-style: normal;
            font-weight: 600;
            line-height: 49.92px;
            letter-spacing: -0.32px;
        }

        .title p {
            color: var(--heading-color);
        }
    </style>
@endpush


@section('main-panel')
    <div class="row rounded" style="border: solid 1px gray; background: white;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-5">Auction Details</h2>
                        </div>
                    </div>
                    @php
                        $images = $auction->auctionImageGallery ?? null;
                    @endphp

                    <div class="row">
                        <div class="col-12">
                            <!-- name--area  -->
                            <div class="name--area mb-4" data-aos="fade-in" data-aos-duration="1500">
                                <div>
                                    <h3 class="mb-2">{{ $auction->year ?? '' }} {{ ' ' }} {{ $auction->model }}
                                    </h3>
                                    <p>
                                        {{ $auction->engine ?? '' }}{{ ', ' }}
                                        {{ $auction->drivetrain ?? 'N/A' }}{{ ', ' }}
                                        {{ $auction->title_status ?? 'N/A' }} {{ ', ' }}
                                        {{ $auction->state->name ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- single car images  -->

                        <div class="single--car--images mb_40">
                            <div class="slider--box">
                                <div class="row">
                                    @for ($i = 0; $i < count($images); $i++)
                                        <div class="col-md-4 mt-2">
                                            <a>
                                                <img class="w-100"
                                                    src="{{ $images[$i]->url ?? 'frontend/images/placeholder/image_placeholder.png' }}"
                                                    alt="" />
                                            </a>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- place bid  -->
                    <div class="place--bid--wrapper mt-4 mb-4" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="800" data-aos-offset="0">
                        <!-- single info  -->
                        <div class="single--info">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                    fill="none">
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
                            <p>Time Left <strong>2 Days</strong></p>
                        </div>
                        <!-- single info  -->
                        <div class="single--info">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                    fill="none">
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
                            <p>High Bid <strong>${{ $auction->maxBid() ?? 0 }}</strong></p>
                        </div>
                        <!-- single info  -->
                        <div class="single--info">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                    fill="none">
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
                        <div class="single--info">
                            
                            @if ($bid &&  $bid->winn != '0')
                                <p style="color:green;">Winner: <a href={{ route('bidder.profile', ['id' => $bid->user, 'slug' => Str::slug($bid->user->full_name ?? '')]) }}> <strong>{{$bid->user->full_name ?? 'User Not Found...!'}}</strong></a></p>
                            @else
                                <p style="color:red;"><strong>No Winner</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="title">
                <h3>Carfax Car Center</h3>
                <p>Ending May 10th at 11:42 PM</p>
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

            <div class="row mt-4">
                <div class="col-md-6">
                    <!-- highlights  -->
                    <div class="highlights details mt-4" data-aos="fade-up" data-aos-duration="1000">
                        <h4>Highlights</h4>
                        @if ($auction->flaw)
                            {!! $auction->flaw_text !!}
                        @else
                            <p>N/A</p>
                        @endif
                    </div>

                    <!-- Equipment  -->
                    <div class="equipment details mt-4" data-aos="fade-up" data-aos-duration="1000">
                        <h4>Equipment</h4>
                        @if ($auction->equipment)
                            {!! $auction->equipment !!}
                        @else
                            <p>N/A</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 text-md-end">
                    <!-- rent--history  -->
                    <div class="rent--history details mt-4" data-aos="fade-up" data-aos-duration="1000">
                        <h4>Recent Service History</h4>
                        @if ($auction->modify)
                            {!! $auction->modify_text !!}
                        @else
                            <p>No History...</p>
                        @endif
                    </div>

                    <!-- ownership history  -->
                    <div class="ownership--history details mt-4" data-aos="fade-up" data-aos-duration="1000">
                        <h4>Ownership History</h4>
                        @if ($auction->ownership_history)
                            {!! $auction->ownership_history !!}
                        @else
                            <p>No history added....!</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- car videos  -->
            <div class="car--videos mt-5 mb-4" data-aos="fade-up" data-aos-duration="1000">
                <h4>Videos</h4>
                <div class="row">
                    {{-- showing all the videos available --}}
                    @foreach ($auction->auctionVideoGallery as $video)
                        <div class="col-md-6">
                            <div class="single--video mt-5">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" width="600" height="400" controls>
                                        <source src="{{ $video->url ?? '' }}">
                                    </video>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
