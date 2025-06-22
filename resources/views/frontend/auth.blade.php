<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Smart Car Aution</title>
    <!-- ==== Favicon ==== -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/logo-sm.svg') }}" />
    <!-- ==== All Css Links ==== -->
    @include('frontend.partials.style')
</head>

<body>

    {{-- main :: start --}}
    @yield('main--content')
    {{-- main :: end --}}

    {{-- script :: start --}}
    @include('frontend.partials.script')
    {{-- script :: end --}}

    <script>
        // password show
        $(document).ready(function() {
            console.log('tushar');
            $('#eye1').on('click', () => {
                // console.log('click');
                const passwordInput = $('#password');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                } else {
                    passwordInput.attr('type', 'password');
                }
            })

            $('#eye2').on('click', () => {
                // console.log('click');
                const passwordInput = $('#password_confirmation');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                } else {
                    passwordInput.attr('type', 'password');
                }
            })
        })
    </script>
</body>

</html>
