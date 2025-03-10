@extends('frontend.app')

@push('style')
    <style>
        .error-page-body {
            margin-top: 150px;
            height: 70%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .full-screen-image {
            width: 450px;
        }
    </style>
@endpush

@section('main--content')
    <main>
        <div class="error-page-body">
            <img class="full-screen-image" src="{{ asset('./errors/500.svg') }}" alt="">
        </div>
    </main>
@endsection


@push('script')
   
@endpush
