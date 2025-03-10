@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- my word ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">My Words</h2>
                {{-- delete image --}}
                <form action="{{ route('cms.auction.words.delete.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="7">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('cms.auction.words.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="7">
                <div class="form-group">
                    <label class="">Title</label>
                    <input class="form-control" type="text" name="title" value="{{ $data[6]->title }}"
                           placeholder="Title">
                </div>
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"
                           data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}"
                           name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Description</label>
                    <textarea class="form-control" name="sub_title" id="my_words">{{ $data[6]->sub_title }}</textarea>
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
