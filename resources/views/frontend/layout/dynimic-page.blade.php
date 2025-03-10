@extends('frontend.app')

@section('main--content')
    <main>
        <section class="faq--area faq--page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="faq--contents">
                            {{-- <h2 class="content-title">{{ $pageData ? $pageData->page_title : 'Default Title' }}</h2> --}}
                            <h2 class="content-title" style="text-align: center; margin-bottom: 10px; margin-top:50px">Privacy Statement</h2>
                            <div class="accordion" id="accordionExample">
                                @if (isset($pageData->page_content))
                                    {!! preg_replace('/<h3\b[^>]*>(.*?)<\/h3>/', '<u>$1</u>', $pageData->page_content) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@push('script')
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
@endpush