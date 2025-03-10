@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{--  statistics Banner .......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Statistics Banner</h2>
                {{-- delete image --}}
                <form action="{{ route('statistics.banner.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="1">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & title --}}
            <form action="{{ route('statistics.banner') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"  data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}" name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Title</label>
                    <input class="form-control" placeholder="Banner Title" type="text" name="title"
                        value={{ $data[0]->title }}>
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>

        {{--  statistics Banner .......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Logo</h2>
                {{-- delete image --}}
                <form action="{{ route('logo.destroy') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="2">
                    <button class="btn btn-danger">Delete Current Logo</button>
                </form>
            </div>
            {{-- update image & title --}}
            <form action="{{ route('logo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="2">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"  data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}" name="image_url">
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>

    </div>
@endsection


@push('script')
    <script>
        // Dropify
        $('.dropify').dropify();
    </script>
@endpush
