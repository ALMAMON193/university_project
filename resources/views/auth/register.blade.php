@extends('frontend.auth')

@section('main--content')
    <main>
        <!-- auth login area :: start  -->
        <section class="auth--area login--area">
            <div class="auth--row">
                <!-- auth img  -->
                <div class="auth--img">
                    <img class="w-100" src="{{ asset('frontend/images/auth.png') }}" alt="" />
                </div>
                <!-- auth form  -->
                <div class="auth--form login--form">
                    <!-- title  -->
                    <div class="auth--title mb-20">
                        <h1>Sign Up</h1>
                        <p>To Create Account, Please Fill in the From Below.</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf
                        <!-- input--group  -->
                        <div class="input--group">
                            <label for="full_name">Full Name</label>
                            <input type="text" id="full_name" name="full_name"
                                class="form-control @error('full_name') border border-danger @enderror"
                                placeholder="" value="{{ old('full_name') }}" />
                            <div class="invalid-feedback">Please enter your full name.</div>
                            @error('full_name')
                                <p class="text-danger" style="font-size: 12px">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- input--group  -->
                        <div class="input--group">
                            <label for="email">Email Address</label>
                            <input type="" id="email" name="email"
                                class="form-control @error('email') border border-danger @enderror"
                                placeholder="" value="{{ old('email') }}" />
                            @error('email')
                                <p class="text-danger" style="font-size: 12px">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- input--group  -->
                        <div class="input--group password">
                            <label for="password">Password</label>
                            <div class="feild">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') border border-danger @enderror"
                                    placeholder="" autocomplete="new-password" />
                                <svg class="eye" id="eye1" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="18" viewBox="0 0 20 18" fill="none" class="eye">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.80327 12.2526C8.42774 12.6759 9.18882 12.9319 9.99868 12.9319C12.1453 12.9319 13.8919 11.1696 13.8919 9.00369C13.8919 8.18655 13.6382 7.41863 13.2186 6.78855L12.1551 7.86166C12.3307 8.1964 12.4283 8.5902 12.4283 9.00369C12.4283 10.3525 11.3354 11.4551 9.99868 11.4551C9.58887 11.4551 9.19858 11.3567 8.86683 11.1795L7.80327 12.2526ZM16.4288 3.54952C17.8436 4.84907 19.0438 6.60149 19.9415 8.70834C20.0195 8.8954 20.0195 9.11199 19.9415 9.2892C17.8534 14.1921 14.1358 17.1259 9.99868 17.1259H9.98893C8.10575 17.1259 6.30063 16.5056 4.71018 15.3735L2.81725 17.2834C2.67089 17.4311 2.4855 17.5 2.30011 17.5C2.11472 17.5 1.91957 17.4311 1.78297 17.2834C1.53903 17.0373 1.5 16.6435 1.69515 16.358L1.72442 16.3186L16.1556 1.75771C16.1751 1.73802 16.1946 1.71833 16.2044 1.69864L16.2044 1.69863C16.2239 1.67894 16.2434 1.65925 16.2532 1.63957L17.1704 0.714131C17.4631 0.428623 17.9217 0.428623 18.2046 0.714131C18.4974 0.999638 18.4974 1.4722 18.2046 1.75771L16.4288 3.54952ZM6.09836 9.00753C6.09836 9.2635 6.12764 9.51948 6.16667 9.75576L2.55643 13.3984C1.5807 12.2564 0.731804 10.8781 0.0585443 9.29304C-0.0195148 9.11583 -0.0195148 8.89924 0.0585443 8.71218C2.14662 3.80933 5.86419 0.885337 9.99156 0.885337H10.0013C11.3966 0.885337 12.7529 1.22007 14.0018 1.85015L10.7429 5.13841C10.5087 5.09903 10.255 5.0695 10.0013 5.0695C7.84494 5.0695 6.09836 6.83177 6.09836 9.00753Z"
                                        fill="#97A0AF" />
                                </svg>
                            </div>
                            @error('password')
                                <p class="text-danger" style="font-size: 12px">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- input--group  -->
                        <div class="input--group password">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="feild">
                                <input type="password"
                                    class="form-control @error('password') border border-danger @enderror"
                                    id="password_confirmation" name="password_confirmation" placeholder=""
                                    autocomplete="new-password" />
                                <svg class="eye" id="eye2" xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="18" viewBox="0 0 20 18" fill="none" class="eye">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.80327 12.2526C8.42774 12.6759 9.18882 12.9319 9.99868 12.9319C12.1453 12.9319 13.8919 11.1696 13.8919 9.00369C13.8919 8.18655 13.6382 7.41863 13.2186 6.78855L12.1551 7.86166C12.3307 8.1964 12.4283 8.5902 12.4283 9.00369C12.4283 10.3525 11.3354 11.4551 9.99868 11.4551C9.58887 11.4551 9.19858 11.3567 8.86683 11.1795L7.80327 12.2526ZM16.4288 3.54952C17.8436 4.84907 19.0438 6.60149 19.9415 8.70834C20.0195 8.8954 20.0195 9.11199 19.9415 9.2892C17.8534 14.1921 14.1358 17.1259 9.99868 17.1259H9.98893C8.10575 17.1259 6.30063 16.5056 4.71018 15.3735L2.81725 17.2834C2.67089 17.4311 2.4855 17.5 2.30011 17.5C2.11472 17.5 1.91957 17.4311 1.78297 17.2834C1.53903 17.0373 1.5 16.6435 1.69515 16.358L1.72442 16.3186L16.1556 1.75771C16.1751 1.73802 16.1946 1.71833 16.2044 1.69864L16.2044 1.69863C16.2239 1.67894 16.2434 1.65925 16.2532 1.63957L17.1704 0.714131C17.4631 0.428623 17.9217 0.428623 18.2046 0.714131C18.4974 0.999638 18.4974 1.4722 18.2046 1.75771L16.4288 3.54952ZM6.09836 9.00753C6.09836 9.2635 6.12764 9.51948 6.16667 9.75576L2.55643 13.3984C1.5807 12.2564 0.731804 10.8781 0.0585443 9.29304C-0.0195148 9.11583 -0.0195148 8.89924 0.0585443 8.71218C2.14662 3.80933 5.86419 0.885337 9.99156 0.885337H10.0013C11.3966 0.885337 12.7529 1.22007 14.0018 1.85015L10.7429 5.13841C10.5087 5.09903 10.255 5.0695 10.0013 5.0695C7.84494 5.0695 6.09836 6.83177 6.09836 9.00753Z"
                                        fill="#97A0AF" />
                                </svg>
                                <div class="invalid-feedback">
                                    Please retype your password.
                                </div>
                            </div>
                            @error('password')
                                <p class="text-danger" style="font-size: 12px">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <!-- forgot pass area  -->
                        <div class="forgot--pass--area mt_5">
                            <div class="form-group">
                                <input type="checkbox" id="terms" name="terms" />

                                <label for="terms">I have read and agree to the Terms of Services</label>
                                @error('terms')
                                    <p class="text-danger" style="font-size: 12px">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="submit-btn w-100 button mt_40">
                            Sign Up
                        </button>
                        <!-- divider  -->
                        <div class="divider">
                            <p>Or</p>
                        </div>
                        <!-- ssl login  -->
                        <a href="{{route('socialite', 'google')}}"  class="ssl--login">
                            <img src="{{ asset('frontend/images/google.svg') }}" alt="google" />
                            Sign Up with Google
                        </a>
                    </form>
                    <!-- account--reminder  -->
                    <p class="account--reminder">
                        Already have an account? <a href="{{ route('login') }}"> Log In</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- auth login area :: end  -->
    </main>
@endsection
