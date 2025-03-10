@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- finalizing the sale ............... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Finalizing the Sale</h2>
                {{-- delete image --}}
                <form action="{{ route('finalize.car.image') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="9">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('finalize.car') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="9">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"
                        data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}"
                        name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Description</label>
                    <textarea class="form-control" name="description" id="finalizing_a_car_text">{{ $data[8]->description }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary" id="finalizing-car-submit">Save</button>
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
