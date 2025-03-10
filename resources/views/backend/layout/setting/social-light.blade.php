@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row rounded" style="border: solid 1px gray; background: white;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Social Light Setting</h4>
                    <p class="card-description">Setup your system social light, please <code>provide your valid
                            data</code>.</p>
                    <div class="mt-4">
                        <form class="forms-sample" action="{{ route('social-light.setting.update') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label>Google Client ID:<span class="required">*</span></label></label>
                                    <input type="text"
                                        class="form-control form-control-md border-left-0 @error('google_client_id') is-invalid @enderror"
                                        placeholder="Google Client ID" name="google_client_id" value="{{ env('GOOGLE_CLIENT_ID') }}">
                                    @error('google_client_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Google Client Secret:<span class="required">*</span></label></label>
                                    <input type="text"
                                        class="form-control form-control-md border-left-0 @error('google_client_secret') is-invalid @enderror"
                                        placeholder="Google Client Secret" name="google_client_secret" value="{{ env('GOOGLE_CLIENT_SECRET') }}">
                                    @error('google_client_secret')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                {{-- <button type="button" class="btn btn-primary" id="sava">Save</button> --}}
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js"
        integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error(error.stack);
            });

        $('.dropify').dropify();
    </script>
@endpush
