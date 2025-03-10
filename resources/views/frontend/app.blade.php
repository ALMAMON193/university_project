<!DOCTYPE html>
<html lang="en">
@php
    use App\Models\CMS_Content;

    $head_cms = CMS_Content::all();
@endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Saudi Car Hub</title>
    {{-- for ajax --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ==== Favicon ==== -->
    <link rel="icon"
        href="{{ $head_cms[1]->image_url ? $head_cms[1]->image_url : asset('frontend/images/logo.svg') }}" />
    <!-- ==== All Css Links ==== -->
    @include('frontend.partials.style')

    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    <!-- header :: start -->
    @include('frontend.partials.header')
    <!-- header :: end -->

    {{-- main :: start --}}
    @yield('main--content')
    {{-- main :: end --}}

    <!-- footer :: start  -->
    @include('frontend.partials.footer')
    <!-- footer :: end  -->
    {{-- script :: start --}}
    @include('frontend.partials.script')
    {{-- script :: end --}}

</body>

</html>
