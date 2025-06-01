@extends('frontend.auth')

@section('main--content')
    <main>
        <!-- auth login area :: start  -->
        <section class="auth--area login--area">
            <div class="auth--row">
                <!-- auth img  -->
                <div class="auth--img">
                    <img class="w-100" src="{{ asset('frontend/images/auth.jpg') }}" alt="Authentication Image" />
                </div>
                <!-- auth form  -->
                <div class="auth--form login--form">
                    <!-- title  -->
                    <div class="auth--title mb-20">
                        <h1>OTP Verification</h1>
                        <p>Please enter the 6-digit OTP sent to <strong>{{ $email ?? session('email') }}</strong></p>
                    </div>
                    <!-- OTP Verification Form -->
                    <form method="POST" action="{{ route('email-otp-verification') }}" id="otp-form">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email ?? session('email') }}">

                        <!-- OTP Input Field -->
                        <div class="otp-input-group mb-4">
                            <label for="otp" class="form-label">Enter 6-digit OTP</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="Enter OTP" maxlength="6">
                                @error('otp')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="full_otp" id="full-otp">
                            @error('otp')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn w-100 button mt_40">
                            Verify OTP
                        </button>

                        <div class="text-center mt-3">
                            <p>Didn't receive OTP?
                                <a href="#" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                                    Resend OTP
                                </a>
                            </p>
                            <p class="mt-2">OTP expires in <span id="countdown" class="text-primary">00:00</span></p>

                            <script>
                                let countDownDate = new Date().getTime() + 600000;

                                let x = setInterval(function() {

                                    let now = new Date().getTime();
                                    let distance = countDownDate - now;

                                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    document.getElementById("countdown").innerHTML = minutes + ":" + seconds;

                                    if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById("countdown").innerHTML = "00:00";
                                    }
                                }, 1000);
                            </script>
                        </div>
                    </form>

                    <!-- Resend OTP Form (Hidden) -->
                    <form id="resend-form" action="{{ route('verification.resend-otp') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email ?? session('email') }}">
                    </form>
                </div>
            </div>
        </section>
        <!-- auth login area :: end  -->
    </main>
@endsection

@section('styles')
<style>
    /* OTP input styling */
    .otp-digit {
        width: 50px;
        height: 60px;
        font-size: 24px;
        text-align: center;
        border: 2px solid #ddd;
        border-radius: 8px;
    }

    .otp-digit:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Countdown timer styling */
    .text-danger {
        color: #dc3545;
        font-weight: bold;
    }

    .text-primary {
        color: #007bff;
        font-weight: bold;
    }

    /* Alert box styling */
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 5px;
    }

    .otp-input-group {
        margin-bottom: 20px;
    }
</style>
@endsection
