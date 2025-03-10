@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- about us .......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">About Us</h2>
                {{-- delete image --}}
                <form action="{{ route('destroy.about.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="1">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('create.about') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"
                        data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}"
                        name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Description</label>
                    <textarea class="form-control" name="description" id="about_text">{{ $data[0]->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    {{-- dropify --}}
    <script>
        // Dropify
        $('.dropify').dropify();
    </script>
@endpush
