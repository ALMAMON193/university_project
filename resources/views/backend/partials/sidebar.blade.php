<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                {{-- <i class="mdi mdi-grid-large menu-icon"></i> --}}
                <i class="menu-icon fa fa-tachometer" aria-hidden="true"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>


        <li class="nav-item nav-category">Users</li>

        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#usersSetup" aria-expanded="false"
            aria-controls="Users Setup">
            <i class="menu-icon fa fa-user" aria-hidden="true"></i>
            <span class="menu-title">User</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="usersSetup">
            <ul class="nav flex-column sub-menu">
                {{-- Auction page --}}
                <li class="nav-item {{ Request::routeIs('backend.user-list.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('backend.user-list.index') }}">Users</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item nav-category">Auctions</li>

        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#auctionMenueSetup" aria-expanded="false"
                aria-controls="Auction Menue Setup">
                <i class="menu-icon fa fa-gavel" aria-hidden="true"></i>
                <span class="menu-title">Auction</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auctionMenueSetup">
                <ul class="nav flex-column sub-menu">
                    {{-- Auction page --}}
                    <li class="nav-item {{ Request::routeIs('backend.auction.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('backend.auction.index') }}">Auctions</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('backend.auction.bidwinner.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('backend.auction.bidwinner.index') }}">Winner</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item nav-category">CMS</li>

        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#sellSetup" aria-expanded="false"
                aria-controls="Sell Setup">
                <i class="menu-icon fa fa-car" aria-hidden="true"></i>
                <span class="menu-title">Sell Car Page</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sellSetup">
                <ul class="nav flex-column sub-menu">
                    {{-- sell car page --}}
                    <li class="nav-item {{ Request::routeIs('cms.car.page.header') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.header') }}">Header Text</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('cms.car.page.auction') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.auction') }}">Auction</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cms.car.page.how-works') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.how-works') }}">How it Works</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cms.car.page.features') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.features') }}">Features</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('cms.car.page.faq') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.faq.index') }}">FAQ</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cms.car.page.contact') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.car.page.contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#carSetup" aria-expanded="false"
                aria-controls="Car Setup">
                <i class="menu-icon fa fa-gavel" aria-hidden="true"></i>
                <span class="menu-title">Cars And Bids</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="carSetup">
                <ul class="nav flex-column sub-menu">
                    {{-- sell car page --}}
                    <li class="nav-item {{ Request::routeIs('cab.cms.header') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.header') }}">Header Text</a>
                    </li>

                    <li class="nav-item {{ Request::routeIs('cab.cms.about-us') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cab.cms.my-word') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.my-word') }}">My Words</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cab.cms.features') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.features') }}">Features</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cab.cms.bid-car') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.bid-car') }}">Bidding a Car</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cab.cms.sell-car') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.sell-car') }}">Selling a Car</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('cab.cms.finalize-sell') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cab.cms.finalize-sell') }}">Finalizing The
                            Sale</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- CMS Menu --}}
        {{-- <li class="nav-item nav-category">CMS</li> --}}
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#auctionSetup" aria-expanded="false"
                aria-controls="Auction Setup">
                <i class="menu-icon fa fa-gavel" aria-hidden="true"></i>
                <span class="menu-title">Auction Page</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auctionSetup">
                <ul class="nav flex-column sub-menu">
                    {{-- auction page --}}
                    <li class="nav-item {{ Request::routeIs('cms.auction.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('cms.auction.index') }}">Auction</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Accounts</li>

        {{-- Account Settings --}}
        <li
            class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#accountSetup" aria-expanded="false"
                aria-controls="Account Setup">
                <i class="menu-icon fa fa-money" aria-hidden="true"></i>
                <span class="menu-title">Payment</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="accountSetup">
                <ul class="nav flex-column sub-menu">
                    {{-- Transaction List --}}
                    <li class="nav-item {{ Request::routeIs('backend.account.transaction.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('backend.account.transaction.index') }}">Transactions</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('backend.account.withdraw.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('backend.account.withdraw.index') }}">Withdraws</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Settings</li>

        {{-- Website Social Link --}}

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('social-link') ? 'active' : '' }}"
                href="{{ route('social-link') }}">
                <i class="menu-icon fa fa-share-square-o" aria-hidden="true"></i>
                <span class="menu-title">Social Links</span>
            </a>
        </li>

        {{-- Website Setting --}}
        <li
            class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#setting" aria-expanded="false"
                aria-controls="setting">
                <i class="fa fa-gears menu-icon"></i>
                <span class="menu-title">Setting</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ Request::routeIs('system.page') ? 'active' : '' }} "> <a class="nav-link"
                            href={{ route('system.page') }}> System </a></li>
                    <li class="nav-item {{ Request::routeIs('mail.page') ? 'active' : '' }} "> <a class="nav-link"
                            href={{ route('mail.page') }}> Mail </a></li>
                    <li class="nav-item {{ Request::routeIs('stripe-page') ? 'active' : '' }} "> <a class="nav-link"
                            href={{ route('stripe-page') }}> Stripe </a></li>
                    <li class="nav-item {{ Request::routeIs('social-light-page') ? 'active' : '' }} "> <a
                            class="nav-link" href={{ route('social-light-page') }}> Social Light </a></li>
                    <li
                        class="nav-item {{ Request::routeIs('dynamic.page') ? 'active' : '' }} ">
                        <a class="nav-link" href="{{ route('dynamic.page') }}"> Add Dynamic Page </a>
                    </li>
                    <li>

                    </li>
                </ul>
            </div>
        </li>


    </ul>
</nav>
