@extends('frontend.app')

@section('main--content')
    <main>
        <!-- About Us Area :: Start  -->
        <section class="about--us--area">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-7 col-lg-6 mt_30">
                        <div class="about--content">
                            <h1 data-aos="fade-up" data-aos-duration="1000">About US</h1>
                            @if ($data[0]->description)
                                {!! $data[0]->description !!}
                            @else
                                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                    Over the last few years, many car enthusiasts have started
                                    turning their attention to recent vehicles – cars from the
                                    1980s, 1990s, and beyond. Automotive reviewer <a
                                        href="https://www.youtube.com/channel/UCsqjHFMB_JYTaEnf_vmTNqg" target="_blank">Doug
                                        DeMuro</a> realized there isn’t yet a specific place that’s focused
                                    solely on buying and selling these modern enthusiast cars, but
                                    there should be – so he and a team created Cars & Bids, with
                                    its simple name modeled after Doug’s famous pursuit of “quirks
                                    and features.
                                </p>
                                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                                    Over the last few years, many car enthusiasts have started
                                    turning their attention to recent vehicles – cars from the
                                    1980s, 1990s, and beyond. Automotive reviewer <a
                                        href="https://www.youtube.com/channel/UCsqjHFMB_JYTaEnf_vmTNqg" target="_blank">Doug
                                        DeMuro</a> realized there isn’t yet a specific place that’s focused
                                    solely on buying and selling these modern enthusiast cars..
                                </p>
                                <ul>
                                    <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                        <strong>We’re focused on modern enthusiast cars:</strong> the 1980s to the 2020s.
                                        That
                                        means anyone interested in
                                        the next era of exciting cars will come here first to buy
                                        and sell.
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                                        <strong>We’re focused on modern enthusiast cars:</strong> the 1980s to the 2020s.
                                        That
                                        means anyone interested in
                                        the next era of exciting cars will come here first to buy
                                        and sell.
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                        <strong>We’re focused on modern enthusiast cars:</strong> the 1980s to the 2020s.
                                        That
                                        means anyone interested in
                                        the next era of exciting cars will come here first to buy
                                        and sell.
                                    </li>
                                    <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350">
                                        <strong>We’re focused on modern enthusiast cars:</strong> the 1980s to the 2020s.
                                        That
                                        means anyone interested in
                                        the next era of exciting cars will come here first to buy
                                        and sell.
                                    </li>
                                </ul>
                            @endif

                        </div>
                    </div>
                    <div class="col-xxl-5 col-lg-6 mt_30" data-aos="fade-up" data-aos-duration="1000">
                        <div class="img--area">
                            <img class="w-100"
                                src="{{ $data[0]->image_url ? $data[0]->image_url : asset('frontend/images/about.png') }}"
                                alt="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="100">
                        <!-- car review  -->
                        <div class="car--review">
                            <img src="{{ $data[5]->image_url ? $data[5]->image_url : asset('frontend/images/about.png') }}"
                                alt="" />
                            <div>
                                <h4>
                                    @if ($data[5]->title)
                                        {!! $data[5]->title !!}
                                    @else
                                        Smart Car Auctions
                                    @endif
                                </h4>
                                @if ($data[5]->description)
                                    {!! $data[5]->description !!}
                                @else
                                    <p>
                                        Car reviewer Doug DeMuro brings a huge audience to
                                        <strong>Smart Car Auctions</strong> — along with his
                                        commentary.
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-12 advantages">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000">
                                <div class="advantage--card">
                                    <!-- icon  -->
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41"
                                            viewBox="0 0 40 41" fill="none">
                                            <path
                                                d="M30.7827 28.5502L31.4327 33.8168C31.5993 35.2002 30.116 36.1668 28.9327 35.4502L23.166 32.0168C22.766 31.7835 22.666 31.2835 22.8827 30.8835C23.716 29.3502 24.166 27.6168 24.166 25.8835C24.166 19.7835 18.9327 14.8168 12.4993 14.8168C11.1827 14.8168 9.89933 15.0168 8.69933 15.4168C8.08267 15.6168 7.48267 15.0502 7.63267 14.4168C9.14933 8.35016 14.9827 3.8335 21.9493 3.8335C30.0827 3.8335 36.666 9.9835 36.666 17.5668C36.666 22.0668 34.3493 26.0502 30.7827 28.5502Z"
                                                fill="#5459AC" />
                                            <path
                                                d="M21.6654 25.8831C21.6654 27.8664 20.932 29.6997 19.6987 31.1497C18.0487 33.1497 15.432 34.4331 12.4987 34.4331L8.1487 37.0164C7.41536 37.4664 6.48203 36.8497 6.58203 35.9997L6.9987 32.7164C4.76536 31.1664 3.33203 28.6831 3.33203 25.8831C3.33203 22.9497 4.8987 20.3664 7.2987 18.8331C8.78203 17.8664 10.5654 17.3164 12.4987 17.3164C17.5654 17.3164 21.6654 21.1497 21.6654 25.8831Z"
                                                fill="#5459AC" />
                                        </svg>
                                    </div>
                                    <h4>
                                        @if ($data[1]->title)
                                            {{ $data[1]->title }}
                                        @else
                                            Cool Car Auctions
                                        @endif

                                    </h4>
                                    @if ($data[1]->description)
                                        {!! $data[1]->description !!}
                                    @else
                                        <p>
                                            Auction your modern enthusiast<br />
                                            car — anything cool and exciting<br />
                                            from the 1980s to the 2020s.
                                        </p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="100">
                                <div class="advantage--card">
                                    <!-- icon  -->
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41"
                                            viewBox="0 0 40 41" fill="none">
                                            <path
                                                d="M30.7827 28.5502L31.4327 33.8168C31.5993 35.2002 30.116 36.1668 28.9327 35.4502L23.166 32.0168C22.766 31.7835 22.666 31.2835 22.8827 30.8835C23.716 29.3502 24.166 27.6168 24.166 25.8835C24.166 19.7835 18.9327 14.8168 12.4993 14.8168C11.1827 14.8168 9.89933 15.0168 8.69933 15.4168C8.08267 15.6168 7.48267 15.0502 7.63267 14.4168C9.14933 8.35016 14.9827 3.8335 21.9493 3.8335C30.0827 3.8335 36.666 9.9835 36.666 17.5668C36.666 22.0668 34.3493 26.0502 30.7827 28.5502Z"
                                                fill="#5459AC" />
                                            <path
                                                d="M21.6654 25.8831C21.6654 27.8664 20.932 29.6997 19.6987 31.1497C18.0487 33.1497 15.432 34.4331 12.4987 34.4331L8.1487 37.0164C7.41536 37.4664 6.48203 36.8497 6.58203 35.9997L6.9987 32.7164C4.76536 31.1664 3.33203 28.6831 3.33203 25.8831C3.33203 22.9497 4.8987 20.3664 7.2987 18.8331C8.78203 17.8664 10.5654 17.3164 12.4987 17.3164C17.5654 17.3164 21.6654 21.1497 21.6654 25.8831Z"
                                                fill="#5459AC" />
                                        </svg>
                                    </div>
                                    <h4>
                                        @if ($data[2]->title)
                                            {{ $data[2]->title }}
                                        @else
                                            Low Fees
                                        @endif
                                    </h4>

                                    @if ($data[2]->description)
                                        {!! $data[2]->description !!}
                                    @else
                                        <p>
                                            Buyers pay a 4.5% commission,<br />
                                            capped at $4,500. Sellers list for<br />
                                            free and receive 100% of the sale.
                                        </p>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="200">
                                <div class="advantage--card">
                                    <!-- icon  -->
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41"
                                            viewBox="0 0 40 41" fill="none">
                                            <path
                                                d="M30.7827 28.5502L31.4327 33.8168C31.5993 35.2002 30.116 36.1668 28.9327 35.4502L23.166 32.0168C22.766 31.7835 22.666 31.2835 22.8827 30.8835C23.716 29.3502 24.166 27.6168 24.166 25.8835C24.166 19.7835 18.9327 14.8168 12.4993 14.8168C11.1827 14.8168 9.89933 15.0168 8.69933 15.4168C8.08267 15.6168 7.48267 15.0502 7.63267 14.4168C9.14933 8.35016 14.9827 3.8335 21.9493 3.8335C30.0827 3.8335 36.666 9.9835 36.666 17.5668C36.666 22.0668 34.3493 26.0502 30.7827 28.5502Z"
                                                fill="#5459AC" />
                                            <path
                                                d="M21.6654 25.8831C21.6654 27.8664 20.932 29.6997 19.6987 31.1497C18.0487 33.1497 15.432 34.4331 12.4987 34.4331L8.1487 37.0164C7.41536 37.4664 6.48203 36.8497 6.58203 35.9997L6.9987 32.7164C4.76536 31.1664 3.33203 28.6831 3.33203 25.8831C3.33203 22.9497 4.8987 20.3664 7.2987 18.8331C8.78203 17.8664 10.5654 17.3164 12.4987 17.3164C17.5654 17.3164 21.6654 21.1497 21.6654 25.8831Z"
                                                fill="#5459AC" />
                                        </svg>
                                    </div>
                                    <h4>
                                        @if ($data[2]->title)
                                            {{ $data[2]->title }}
                                        @else
                                            More Information
                                        @endif
                                    </h4>
                                    @if ($data[3]->description)
                                        {!! $data[3]->description !!}
                                    @else
                                        <p>
                                            We provide vehicle history reports<br />
                                            for every vehicle listed on Cars &<br />
                                            Bids — for free.
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mt_20" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="300">
                                <div class="advantage--card">
                                    <!-- icon  -->
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41"
                                            viewBox="0 0 40 41" fill="none">
                                            <path
                                                d="M30.7827 28.5502L31.4327 33.8168C31.5993 35.2002 30.116 36.1668 28.9327 35.4502L23.166 32.0168C22.766 31.7835 22.666 31.2835 22.8827 30.8835C23.716 29.3502 24.166 27.6168 24.166 25.8835C24.166 19.7835 18.9327 14.8168 12.4993 14.8168C11.1827 14.8168 9.89933 15.0168 8.69933 15.4168C8.08267 15.6168 7.48267 15.0502 7.63267 14.4168C9.14933 8.35016 14.9827 3.8335 21.9493 3.8335C30.0827 3.8335 36.666 9.9835 36.666 17.5668C36.666 22.0668 34.3493 26.0502 30.7827 28.5502Z"
                                                fill="#5459AC" />
                                            <path
                                                d="M21.6654 25.8831C21.6654 27.8664 20.932 29.6997 19.6987 31.1497C18.0487 33.1497 15.432 34.4331 12.4987 34.4331L8.1487 37.0164C7.41536 37.4664 6.48203 36.8497 6.58203 35.9997L6.9987 32.7164C4.76536 31.1664 3.33203 28.6831 3.33203 25.8831C3.33203 22.9497 4.8987 20.3664 7.2987 18.8331C8.78203 17.8664 10.5654 17.3164 12.4987 17.3164C17.5654 17.3164 21.6654 21.1497 21.6654 25.8831Z"
                                                fill="#5459AC" />
                                        </svg>
                                    </div>
                                    <h4>
                                        @if ($data[4]->title)
                                            {{ $data[4]->title }}
                                        @else
                                            Easy to Use
                                        @endif
                                    </h4>
                                    @if ($data[4]->description)
                                        {!! $data[4]->description !!}
                                    @else
                                        <p>
                                            We’ve developed several new<br />
                                            features that innovate buying and<br />
                                            selling enthusiast cars online.
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Area :: End  -->

        <!-- Working Process Area :: Start  -->
        <section class="working--process--area">
            <div class="container">
                <!-- section title  -->
                <div class="section--title text-center" data-aos="fade-in" data-aos-duration="1500">
                    <p>How It Works</p>
                    <h3 class="sec--title">
                        @if ($data[9]->description)
                            {{ $data[9]->description }}
                        @else
                            Here's how we make selling, buying, or finalizing the car sale easier and hassle-free.
                        @endif
                    </h3>
                </div>
                <div class="row">
                    <div class="tab--area">
                        <!-- nav link  -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" data-aos="fade-in"
                            data-aos-duration="1500">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-car-buy-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-car-buy" type="button" role="tab"
                                    aria-controls="pills-car-buy" aria-selected="true">
                                    {{-- @if ($data[6]->title)
                                        {!! $data[6]->title !!}
                                    @else --}}
                                    Buying a Car
                                    {{-- @endif --}}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-sell-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-sell" type="button" role="tab"
                                    aria-controls="pills-sell" aria-selected="false">
                                    {{-- @if ($data[7]->title)
                                        {!! $data[7]->title !!}
                                    @else --}}
                                    Selling a Car
                                    {{-- @endif --}}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-finalize-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-finalize" type="button" role="tab"
                                    aria-controls="pills-finalize" aria-selected="false">
                                    {{-- @if ($data[8]->title)
                                        {!! $data[8]->title !!}
                                    @else --}}
                                    Finalizing the Sale
                                    {{-- @endif --}}
                                </button>
                            </li>
                        </ul>
                        <!-- tab content  -->
                        <div class="tab-content mt_65" id="pills-tabContent">
                            {{-- tab one --}}
                            <div class="tab-pane fade show active" id="pills-car-buy" role="tabpanel"
                                aria-labelledby="pills-car-buy-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 mt_30" data-aos="fade-up" data-aos-duration="1000">
                                        <!-- img--area   -->
                                        <div class="img--area">
                                            <img class="w-100"
                                                src="{{ $data[6]->image_url ? $data[6]->image_url : asset('frontend/images/about.png') }}"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mt_30">
                                        <div class="car--contents">
                                            <h3 data-aos="fade-up" data-aos-duration="1000">
                                                {{-- @if ($data[6]->title)
                                                    {!! $data[6]->title !!}
                                                @else --}}
                                                Buying a Car
                                                {{-- @endif --}}

                                            </h3>
                                            @if ($data[6]->description)
                                                {!! $data[6]->description !!}
                                            @else
                                                <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                                                    Once you’ve found a car you’re interested in, here are
                                                    the steps you should take to bid confidently and, with
                                                    any luck, win the auction!
                                                </p>
                                                <!-- register  -->
                                                <div class="register mt_20" data-aos="fade-up" data-aos-duration="1000">
                                                    <h4>1. Register to Bid</h4>
                                                    <p>
                                                        To contact the seller directly and place bids, you
                                                        must first Register to Bid with a valid credit card
                                                        and phone number. Winning bidders pay Cars & Bids
                                                        a 4.5% buyer’s fee on top of the winning bid amount
                                                        (minimum of $225, maximum of $4,500).
                                                    </p>
                                                </div>
                                                <!-- diligance  -->
                                                <div class="daligance mt_20" data-aos="fade-up" data-aos-duration="1000">
                                                    <h4>2. Perform Due Diligence</h4>
                                                    <p>
                                                        While we’ve tried to make buying a car online as
                                                        safe and easy as possible, it’s ultimately your
                                                        responsibility to perform your own due diligence and
                                                        make sure that the car you’re considering is right
                                                        for you prior to placing a bid.
                                                    </p>
                                                    <ul>
                                                        <li>
                                                            Review the listing thoroughly, including known
                                                            flaws, the vehicle history report, the vehicle
                                                            inspection report (if applicable), recent
                                                            maintenance, photos, etc.
                                                        </li>
                                                        <li>
                                                            Ask the seller – via comments, Seller Q&A, or the
                                                            “Contact” feature – any questions that you may
                                                            have about the vehicle.
                                                        </li>
                                                        <li>
                                                            Arrange to inspect the vehicle in person, or work
                                                            with the seller to schedule a detailed
                                                            pre-purchase inspection (“PPI”) at a reputable
                                                            shop in their area (at your cost).
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- financing  -->
                                                <div class="financing mt_20" data-aos="fade-up" data-aos-duration="1000">
                                                    <h4>3. Arrange Financing and Logistics</h4>
                                                    <p>
                                                        To ensure a smooth transaction, you should have the
                                                        following organized prior to placing a bid.
                                                    </p>
                                                    <ul>
                                                        <li>
                                                            To facilitate your purchase, we’ve teamed up with
                                                            LightStream to make financing easy and fast for
                                                            users with good to excellent credit. You can check
                                                            out rates and payments - and apply for a loan -
                                                            directly from each auction! LightStream financing
                                                            is not tied to a specific vehicle, and you can get
                                                            your loan funded - and money deposited into your
                                                            account - as soon as the same day you apply.**
                                                        </li>
                                                        <li>
                                                            As a reminder, if you plan to finance this
                                                            purchase, work with your lender to get your
                                                            financing approved ahead of time - and keep in
                                                            mind that some lenders may require specific
                                                            vehicle information and may have year and mileage
                                                            restrictions.
                                                        </li>
                                                        <li>
                                                            Discuss transportation and storage timelines (if
                                                            applicable) with the seller, and if you’ll be
                                                            shipping the vehicle, get a quick and easy
                                                            shipping quote directly on the auction page before
                                                            bidding.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Bid  -->
                                                <div class="bid mt_20" data-aos="fade-up" data-aos-duration="1000">
                                                    <h4>4. Bid</h4>
                                                    <p>
                                                        We’ve made bidding easy, and we’ve explained it in a
                                                        short video tutorial:
                                                    </p>
                                                    <!-- video popup -->
                                                    <div class="video--popup"
                                                        style="background-image: url({{ asset('frontend/images/play-banner.png') }});">
                                                        >

                                                        <a href="https://www.youtube.com/watch?v=dqrn8BaY9-s">
                                                            <svg width="88" height="88" viewBox="0 0 88 88"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="44" cy="44" r="44"
                                                                    fill="#5459AC" />
                                                                <path
                                                                    d="M64 41.6906C65.7778 42.717 65.7778 45.283 64 46.3094L36 62.4752C34.2222 63.5016 32 62.2186 32 60.1658V27.8342C32 25.7814 34.2222 24.4984 36 25.5248L64 41.6906Z"
                                                                    fill="#FAF9F6" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            When you bid, we place a hold on your credit card
                                                            for the buyer's fee – if you win, your card will
                                                            be charged and you will pay the seller directly
                                                            for the vehicle, otherwise, the hold will be
                                                            released at the auction’s end.
                                                        </li>
                                                        <li>
                                                            Bids are binding, so only bid if you fully intend
                                                            to purchase the car and you have performed the
                                                            requisite due diligence, because you might end up
                                                            as the high bidder and there are no refunds.
                                                        </li>
                                                        <li>
                                                            To ensure the bidding process is fair for
                                                            everyone, bids placed within the final minute of
                                                            the auction will reset the auction’s time
                                                            remaining back to 1 minute – giving others the
                                                            opportunity to bid.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- auction  -->
                                                <div class="auction mt_30" data-aos="fade-up" data-aos-duration="1000">
                                                    <h4>5. Win the Auction</h4>
                                                    <p>
                                                        To buy a car on Cars & Bids, you must win the
                                                        auction by ultimately being the highest bidder –
                                                        and, if the auction has a “Reserve,” by placing a
                                                        bid that meets or exceeds the seller’s hidden
                                                        “Reserve” price. If the auction has “No Reserve,”
                                                        then the highest bidder wins it regardless of the
                                                        amount they bid.
                                                    </p>
                                                    <p>
                                                        After the auction closes, we’ll provide you with a
                                                        step-by-step checklist to complete your purchase.
                                                        You’ll also receive the seller’s contact information
                                                        (and vice-versa) in order to finalize the details
                                                        and logistics of the transaction. Buyers are
                                                        expected to pay for the vehicle in-full within a
                                                        week of the auction closing.  <br /><a href="#">Learn more
                                                            about
                                                            Finalizing the Sale</a>.
                                                    </p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- tab tow --}}
                            <div class="tab-pane fade" id="pills-sell" role="tabpanel" aria-labelledby="pills-sell-tab"
                                tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 mt_30">
                                        <!-- img--area   -->
                                        <div class="img--area">
                                            <img class="w-100"
                                                src="{{ $data[7]->image_url ? $data[7]->image_url : asset('frontend/images/cal-sell.png') }}"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mt_30">
                                        <div class="car--contents">
                                            <h3>
                                                {{-- @if ($data[7]->title)
                                                    {!! $data[7]->title !!}
                                                @else --}}
                                                Selling a Car
                                                {{-- @endif --}}
                                            </h3>

                                            @if ($data[7]->description)
                                                {!! $data[7]->description !!}
                                            @else
                                                <p>
                                                    Cars & Bids is the best place to sell your modern
                                                    enthusiast car – and we’ve made the process easy.
                                                </p>
                                                <!-- submit car  -->
                                                <div class="submit--car mt_20">
                                                    <h4>1. Submit Your Car</h4>
                                                    <p>
                                                        It’s free to <a href="#">submit your car</a>. We
                                                        simply ask you for a few details – including the
                                                        VIN, some photos, and a brief description of the
                                                        car. You can also choose whether you want to set a
                                                        reserve price, or if you want your vehicle to be
                                                        sold with no reserve. A reserve price is a minimum
                                                        value you’ll accept in order to sell your car – and
                                                        while a reserve auction may seem like an appealing
                                                        choice, we’ve found that vehicles offered with no
                                                        reserve get more bids, more interest, and more
                                                        attention.
                                                    </p>
                                                    <p>
                                                        If you choose a reserve auction, we’ll ask you to
                                                        suggest a reserve price – but, based on market
                                                        conditions, we may ask for a lower one before
                                                        accepting your car. Keep in mind that all of our
                                                        auctions start from $0, regardless of whether or not
                                                        they have a reserve.
                                                    </p>
                                                    <p>
                                                        Our experienced auction team will review your
                                                        submission and may ask you some follow-up questions.
                                                        We will do our best to give you an answer within a
                                                        business day. Not every car is right for Cars &
                                                        Bids, but we always appreciate you taking the time
                                                        to submit your car to us!
                                                    </p>
                                                </div>
                                                <!-- Prepare Your Listing  -->
                                                <div class="prepare--car mt_20">
                                                    <h4>2. Prepare Your Listing</h4>
                                                    <p>
                                                        Once your submission is accepted, we’ll need some
                                                        additional information from you – like detailed
                                                        photos, service and ownership history, etc. Don’t
                                                        worry – we’re here to help you throughout the
                                                        process!
                                                    </p>
                                                    <ul>
                                                        <li>
                                                            Before you can sell on Cars & Bids, your car must
                                                            not be listed for sale elsewhere – meaning you’ll
                                                            have to remove any other advertisement for your
                                                            car and you cannot accept offers outside of the
                                                            auction.
                                                        </li>
                                                        <li>
                                                            Take excellent photos of your car to get top
                                                            dollar – <a href="#">hire a professional
                                                                photographer</a> or <a href="#">review our photo
                                                                guide</a> before
                                                            snapping your own pics.
                                                        </li>
                                                        <li>
                                                            Film a quick video <a href="#">walk-around and
                                                                cold-start</a> – just shoot them on your
                                                            phone in landscape
                                                            mode and upload to YouTube or Vimeo.
                                                        </li>
                                                        <li>
                                                            Have your car inspected to get top dollar – you
                                                            can order your inspection after your submission is
                                                            accepted, and once you approve your inspection
                                                            report we can include it with your listing.
                                                        </li>
                                                        <li>
                                                            Review the process for transferring vehicle titles
                                                            in your state – and, if you have a loan on the
                                                            vehicle, review the process and timeline for
                                                            paying it off with your lender.
                                                        </li>
                                                        <li>
                                                            Get ready for a thrilling 7-day auction and be
                                                            prepared to engage with the community and answer
                                                            questions as they arise.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--  Finalize Your Auction  -->
                                                <div class="finalise mt_20">
                                                    <h4>3. Finalize Your Auction</h4>
                                                    <p>
                                                        Once you’ve provided us with all of the necessary
                                                        information and photos, we’ll create a draft of your
                                                        listing for you to approve. Once you’ve reviewed and
                                                        approved it, we’ll work with you to schedule your
                                                        auction, and it will go live shortly thereafter!
                                                    </p>
                                                </div>
                                                <!-- Participate in the Auction  -->
                                                <div class="participate mt_20">
                                                    <h4>4. Participate in the Auction</h4>
                                                    <ul>
                                                        <li>
                                                            Timely and positive seller participation in the
                                                            auction – responding to comments and questions,
                                                            providing additional pictures or videos as needed,
                                                            etc – is crucial to a successful auction. Good
                                                            seller participation will result in additional
                                                            interest, more bids, and a higher final sale
                                                            price.
                                                        </li>
                                                        <li>
                                                            Interested bidders may contact you directly via
                                                            email using the “Contact Seller” feature, allowing
                                                            them to schedule test drives, pre-purchase
                                                            inspections (at their cost), and ask additional
                                                            questions.
                                                        </li>
                                                        <li>
                                                            Enjoy the final minutes – many of our auctions end
                                                            with thrilling bidding wars, so get ready!
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--  Auction End  -->
                                                <div class="auction mt_30">
                                                    <h4>5. Auction End</h4>
                                                    <p>
                                                        After the auction closes, we’ll provide you with a
                                                        step-by-step checklist to complete your sale. You’ll
                                                        also receive the buyer’s contact information (and
                                                        vice-versa) in order to finalize the details and
                                                        logistics of the transaction. <a href="#">Learn more about
                                                            Finalizing the Sale.</a>
                                                    </p>
                                                    <p>
                                                        If your auction had a reserve and it was not met,
                                                        we’ll reach out to you and the highest bidder to see
                                                        if we can help make a deal!
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- tab three --}}
                            <div class="tab-pane fade" id="pills-finalize" role="tabpanel"
                                aria-labelledby="pills-finalize-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 mt_30">
                                        <!-- img--area   -->
                                        <div class="img--area">
                                            <img class="w-100"
                                                src="{{ $data[8]->image_url ? $data[8]->image_url : asset('frontend/images/cal-sell.png') }}"
                                                alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mt_30">
                                        <div class="car--contents">
                                            <h3>
                                                {{-- @if ($data[8]->title)
                                                    {!! $data[8]->title !!}
                                                @else --}}
                                                Finalizing the Sale
                                                {{-- @endif --}}
                                            </h3>

                                            @if ($data[8]->description)
                                                {!! $data[8]->description !!}
                                            @else
                                                <p>
                                                    Immediately after the auction closes we connect the
                                                    buyer and seller so they can complete their sale. They
                                                    can either use our custom checklist to ensure a smooth
                                                    transaction or use our partner, KeySavvy, to handle
                                                    everything from payment processing to documentation
                                                    and licensing for a nominal fee. Here are our
                                                    recommendations and tips for a successful post-auction
                                                    sale – and remember, we’re here to help!
                                                </p>
                                                <!-- submit car  -->
                                                <div class="submit--car mt_20">
                                                    <h4>1. Submit Your Car</h4>
                                                    <p>
                                                        It’s free to <a href="#">submit your car</a>. We
                                                        simply ask you for a few details – including the
                                                        VIN, some photos, and a brief description of the
                                                        car. You can also choose whether you want to set a
                                                        reserve price, or if you want your vehicle to be
                                                        sold with no reserve. A reserve price is a minimum
                                                        value you’ll accept in order to sell your car – and
                                                        while a reserve auction may seem like an appealing
                                                        choice, we’ve found that vehicles offered with no
                                                        reserve get more bids, more interest, and more
                                                        attention.
                                                    </p>
                                                    <p>
                                                        If you choose a reserve auction, we’ll ask you to
                                                        suggest a reserve price – but, based on market
                                                        conditions, we may ask for a lower one before
                                                        accepting your car. Keep in mind that all of our
                                                        auctions start from $0, regardless of whether or not
                                                        they have a reserve.
                                                    </p>
                                                    <p>
                                                        Our experienced auction team will review your
                                                        submission and may ask you some follow-up questions.
                                                        We will do our best to give you an answer within a
                                                        business day. Not every car is right for Cars &
                                                        Bids, but we always appreciate you taking the time
                                                        to submit your car to us!
                                                    </p>
                                                </div>
                                                <!-- Payment & Documentation  -->
                                                <div class="payment mt_20">
                                                    <h4>2. Payment & Documentation</h4>
                                                    <ul>
                                                        <li>
                                                            Buyers are expected to pay for the vehicle in-full
                                                            within a week of the auction closing.
                                                        </li>
                                                        <li>
                                                            If there’s an outstanding loan on the vehicle, the
                                                            buyer and seller should discuss how it will be
                                                            paid off and the specific next steps, so that the
                                                            buyer can complete the transaction safely.
                                                        </li>
                                                        <li>
                                                            An accurate Bill of Sale should be created,
                                                            including the terms of the transaction, to be
                                                            signed by both parties; we recommend checking with
                                                            your state DMV for Bill of Sale templates and
                                                            requirements.
                                                        </li>
                                                        <li>
                                                            We recommend wire transfers or cashier’s checks
                                                            for payment, but there are many possible options –
                                                            including meeting at the buyer’s/seller’s bank to
                                                            draft up a cashier's check, withdrawing the funds
                                                            directly, or completing an electronic money
                                                            transfer.
                                                        </li>
                                                        <li>
                                                            Arrange for the car to be picked up and finalize
                                                            the transaction. If the buyer plans to ship the
                                                            vehicle, they can book shipping directly through
                                                            the winner’s page or by contacting our shipping
                                                            team at <a
                                                                href="mailto:shipping@carsandbids.com">shipping@carsandbids.com</a> or <a
                                                                href="tel:9789552355">(978) 955-2355</a>.
                                                            The vehicle and title should only be released once
                                                            the seller has the full payment in hand. If the
                                                            transaction is happening remotely, the seller
                                                            should mail the signed-over title to the buyer via
                                                            courier service with a tracking number once
                                                            payment is in hand.
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--  Share your Success Story  -->
                                                <div class="auction mt_30">
                                                    <h4>5. Share your Success Story</h4>
                                                    <p>
                                                        <a href="#">Email the Cars & Bids team</a> a photo
                                                        of the handoff to share your success story – we’d
                                                        love to hear about it!
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Working Process Area :: end  -->

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
@endsection
