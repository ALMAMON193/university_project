@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}

@push('style')
    <style>
        .profile--area {
            padding: 20px 0 48px;
        }

        .profile--area .profile--contents--wrap {
            border-bottom: 1px solid rgb(90 92 95 / 20%);
        }

        .profile--area .profile--contents {
            width: 948px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .profile--area .profile--contents form {
            min-width: 220px;
            min-height: 220px;
            max-width: 220px;
            max-height: 220px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }

        .profile--area .profile--contents .preview--img img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .profile--area .profile--contents input {
            display: none;
        }

        .profile--contents label {
            position: absolute;
            bottom: 14px;
            right: 10px;
            height: 42px;
            width: 42px;
            border-radius: 50%;
            background-color: #5459AC;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            border: 4px solid #ffffff;
            cursor: pointer;
        }

        .profile--area .profile--name {
            margin-top: 24px;
        }

        .profile--area .profile--name h1 {
            font-size: 32px;
            font-style: normal;
            font-weight: 700;
            line-height: 48px;
            letter-spacing: 0.64px;
        }

        .profile--area .profile--name ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            gap: 30px;
        }

        .profile--area [tel] {
            color: var(--heading-color);
        }

        .profile--area .profile--name p {
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
            margin-top: 24px;
            padding-bottom: 64px;
        }

        .profile--history--area h5 {
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 30px;
            letter-spacing: 0.4px;
            margin-bottom: 16px;
        }

        .info--box,
        .profile--history--area .box--info {
            padding: 0 25px 25px;
            border: 1px solid #d2d8da;
        }

        .radio--box h5,
        .profile--history--area form label {
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
            margin-bottom: 12px;
        }


        .profile--history--area {
            padding-bottom: 120px;
            overflow: hidden;
        }

        .profile--history--area .nav-link {
            font-size: 22px;
            font-style: normal;
            font-weight: 600;
            line-height: 28px;
            color: var(--paragraph-color-light);
            padding: 16px 24px;
            border-bottom: 2px solid transparent;
            border-radius: 0;
        }

        .profile--history--area .nav-link.active {
            background-color: transparent;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .profile--history--area h3 {
            font-size: 20px;
            font-style: normal;
            font-weight: 500;
            line-height: 24px;
            margin: 36px 0 0;
        }

        .profile--history--area .mt_20 {
            margin-top: 35px;
        }

        .profile--history--area form {
            padding: 0 24px;
        }

        ul {
            list-style-type: none;
        }

    </style>
@endpush


@section('main-panel')
    @php
        $user = $data['user'];
        $profile = $user->profile;
        $states = $data['states'];
    @endphp
    <div class="row rounded" style="border: solid 1px gray; background: white;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">My Profile</h4>
                        </div>
                    </div>

                    <!-- Profile Area :: Start  -->
                    <section class="profile--area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="profile--contents--wrap">
                                        <!-- profile--contents  -->
                                        <div class="profile--contents">

                                            <form method="POST" id="avatar-form" action="{{ route('image.update') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <!-- preview--img  -->
                                                <div class="preview--img">
                                                    <img id="avatar-preview"
                                                        src="{{ $profile->avatar ? $profile->avatar : asset('backend/images/faces/face8.jpg') }}"
                                                        alt="" />
                                                </div>
                                                <label for="upload">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 18 18" fill="none">
                                                        <path
                                                            d="M15.75 16.5H2.25C1.9425 16.5 1.6875 16.245 1.6875 15.9375C1.6875 15.63 1.9425 15.375 2.25 15.375H15.75C16.0575 15.375 16.3125 15.63 16.3125 15.9375C16.3125 16.245 16.0575 16.5 15.75 16.5Z"
                                                            fill="white" />
                                                        <path
                                                            d="M14.2649 2.61C12.8099 1.155 11.3849 1.1175 9.89243 2.61L8.98493 3.5175C8.90993 3.5925 8.87993 3.7125 8.90993 3.8175C9.47993 5.805 11.0699 7.395 13.0574 7.965C13.0874 7.9725 13.1174 7.98 13.1474 7.98C13.2299 7.98 13.3049 7.95 13.3649 7.89L14.2649 6.9825C15.0074 6.2475 15.3674 5.535 15.3674 4.815C15.3749 4.0725 15.0149 3.3525 14.2649 2.61Z"
                                                            fill="white" />
                                                        <path
                                                            d="M11.7043 8.6476C11.4868 8.5426 11.2768 8.4376 11.0743 8.3176C10.9093 8.2201 10.7518 8.1151 10.5943 8.0026C10.4668 7.9201 10.3168 7.8001 10.1743 7.6801C10.1593 7.6726 10.1068 7.6276 10.0468 7.5676C9.79932 7.3576 9.52182 7.0876 9.27432 6.7876C9.25182 6.7726 9.21432 6.7201 9.16182 6.6526C9.08682 6.5626 8.95932 6.4126 8.84682 6.2401C8.75682 6.1276 8.65182 5.9626 8.55432 5.7976C8.43432 5.5951 8.32932 5.3926 8.22432 5.1826C8.19277 5.11499 8.16325 5.04807 8.13536 4.98202C8.0486 4.77659 7.7821 4.71731 7.62442 4.875L3.25182 9.2476C3.15432 9.3451 3.06432 9.5326 3.04182 9.6601L2.63682 12.5326C2.56182 13.0426 2.70432 13.5226 3.01932 13.8451C3.28932 14.1076 3.66432 14.2501 4.06932 14.2501C4.15932 14.2501 4.24932 14.2426 4.33932 14.2276L7.21932 13.8226C7.35432 13.8001 7.54182 13.7101 7.63182 13.6126L12 9.24437C12.1588 9.08559 12.0987 8.81377 11.8915 8.72729C11.8304 8.70182 11.7683 8.67532 11.7043 8.6476Z"
                                                            fill="white" />
                                                    </svg>
                                                </label>
                                                {{-- <input type="file" id="upload" name="avatar" /> --}}
                                                <input type="file" name="avatar" id="upload">
                                            </form>

                                            <!-- profile--name  -->
                                            <div class="profile--name">
                                                <h1>
                                                    {{ $user->full_name ?? 'Unknone' }}
                                                </h1>
                                                <ul>
                                                    <li>Contact Number : {{ $profile->phone ?? 'Unknone' }}</li>
                                                    <li>Address : {{ $profile->address ?? 'Unknone' }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Profile Area :: End  -->

                    <!-- Profile History Area :: Start  -->
                    <section class="profile--history--area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    {{-- Public info form --}}
                                    <form action="{{ route('backend.public.info') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <!-- public info  -->
                                        <div class="public--info mt_35">
                                            <h5>Public Info</h5>
                                            <!-- box--info  -->
                                            <div class="box--info">
                                                <div class="row m-3">
                                                    <div class="col-md-4 mt_25">
                                                        <div class="input--group">
                                                            <label for="fname">Full
                                                                Name<samp>*</samp></label>
                                                            <input
                                                                class="form-control @error('full_name') border border-danger @enderror"
                                                                type="text" id="fname" name="full_name"
                                                                value="{{ $user->full_name }}" />
                                                            @error('full_name')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt_25">
                                                        <div class="input--group">
                                                            <label for="number">Contact
                                                                Number<samp>*</samp></label>
                                                            <input
                                                                class="form-control @error('phone') border border-danger @enderror"
                                                                type="tel" id="number" name="phone"
                                                                value="{{ $profile->phone }}" />
                                                            @error('phone')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt_25">
                                                        <div class="input--group">
                                                            <label for="address">Address<samp>*</samp></label>
                                                            <input
                                                                class="form-control @error('address') border border-danger @enderror"
                                                                type="text" id="address" name="address"
                                                                value="{{ $profile->address }}" />
                                                            @error('address')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="buttons mt_30">
                                                            <button class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- Private info form --}}
                                    <form action="{{ route('backend.private.info') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <!-- private info  -->
                                        <div class="private--info mt-4">
                                            <h5>Private Info</h5>
                                            <!-- box--info  -->
                                            <div class="box--info">
                                                <div class="row m-3">
                                                    <div class="col-md-4 mt_25">
                                                        <div class="input--group">
                                                            <label for="email">Email
                                                                Address<samp>*</samp></label>
                                                            <input
                                                                class="form-control @error('email') border border-danger @enderror"
                                                                type="text" id="email" name="email"
                                                                value="{{ $user->email }}" />
                                                            @error('email')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt_25">
                                                        <div class="input--group">
                                                            <label for="password">Password<samp>*</samp></label>
                                                            <div class="feild">
                                                                <input
                                                                    class="form-control @error('password') border border-danger @enderror"
                                                                    type="password" id="password" name="password"
                                                                    placeholder="Enter Your New Password" />

                                                            </div>
                                                            @error('password')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{-- Please enter a valid email address. --}}
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input--group">
                                                            <label for="city">City<samp>*</samp></label>
                                                            <input
                                                                class="form-control @error('city') border border-danger @enderror"
                                                                type="text" id="city" name="city"
                                                                value="{{ $profile->city }}" />
                                                            @error('city')
                                                                <p class="text-danger" style="font-size: 12px">
                                                                    {{-- Please enter a valid email address. --}}
                                                                    {{ $message }}
                                                                </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
{{--                                                        <div class="col-md-6">--}}
{{--                                                            <div class="input--group">--}}
{{--                                                                <label for="state">State<samp>*</samp></label>--}}
{{--                                                                <select--}}
{{--                                                                    class="form-control @error('state') border border-danger @enderror"--}}
{{--                                                                    name="state" id="state">--}}
{{--                                                                    <option disabled--}}
{{--                                                                        {{ $profile->state->name == 'null' ? 'selected' : '' }}--}}
{{--                                                                        value="null">Select States</option>--}}
{{--                                                                    @foreach ($states as $key => $state)--}}
{{--                                                                        @if ($key != 0)--}}
{{--                                                                            <option value="{{ $state->id }}"--}}
{{--                                                                                {{ $profile->state->name === $state->name ? 'selected' : '' }}>--}}
{{--                                                                                {{ $state->name }}</option>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endforeach--}}
{{--                                                                </select>--}}
{{--                                                                @error('state')--}}
{{--                                                                    <p class="text-danger" style="font-size: 12px">--}}
{{--                                                                        --}}{{-- Please enter a valid email address. --}}
{{--                                                                        {{ $message }}--}}
{{--                                                                    </p>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <div class="col-md-6 mt_25">
                                                            <div class="input--group">
                                                                <label for="zip">Zip
                                                                    Code<samp>*</samp></label>
                                                                <input
                                                                    class="form-control @error('zip') border border-danger @enderror"
                                                                    type="number" name="zip" id="zip"
                                                                    value="{{ $profile->zip }}" />
                                                                @error('zip')
                                                                    <p class="text-danger" style="font-size: 12px">
                                                                        {{-- Please enter a valid email address. --}}
                                                                        {{ $message }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <div class="buttons mt_30">
                                                            <button class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Profile History Area :: End  -->
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            // password show
            $('#eye').on('click', () => {
                // console.log('click');
                const passwordInput = $('#password');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                } else {
                    passwordInput.attr('type', 'password');
                }
            })
            // ----------------------------------------------------------------

            // ----------------------------------------------------------------

            // upload user avatar
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#upload').on('change', () => {
                // let formData = new FormData($('#avatar-form')[0]);
                let formData = new FormData($('#avatar-form')[0]);
                console.log(formData.get('avatar'));

                $.ajax({
                    url: '{{ route('image.update') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        toastr.error('An error occurred while uploading the image.');
                    }
                })


                let preview = document.getElementById('avatar-preview');
                let file = document.getElementById('upload').files[0];
                let reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            })
            // ----------------------------------------------------------------
        });
    </script>
@endpush
