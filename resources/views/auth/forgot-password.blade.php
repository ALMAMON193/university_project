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
                        <h1>Reset Password</h1>
                        <p>Send Password Reset Link</p>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('password.request') }}" class="needs-validation" novalidate>
                        @csrf
                        <!-- input--group email -->
                        <div class="input--group">
                            <label for="email">Your Email Address</label>
                            <input type="text" id="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') border border-danger @enderror"
                                placeholder="" />
                            @error('email')
                                <p class="text-danger" style="font-size: 12px">
                                    {{-- Please enter a valid email address. --}}
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <button type="submit" class="submit-btn w-100 button mt_40">
                            Email Password Reset Link
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <!-- auth login area :: end  -->
    </main>
@endsection
