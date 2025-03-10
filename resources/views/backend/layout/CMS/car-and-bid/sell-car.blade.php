@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- selling a car ..................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Selling a Car</h2>
                {{-- delete image --}}
                <form action="{{ route('sell.car.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="8">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('sell.car') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="8">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"
                        data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}"
                        name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Description</label>
                    <textarea class="form-control" name="description" id="selling_a_car_text">{{ $data[7]->description }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" id="selling-car-submit">Save</button>
                </div>
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
