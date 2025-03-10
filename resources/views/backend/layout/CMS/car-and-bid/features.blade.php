@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- features .......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Features</h2>
            <div class="row gap-4 justify-content-center">
                {{-- feature-1 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Feature-1</h4>
                    <form action="{{ route('create.features') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="2">
                        <div class="form-group">
                            <label class="">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $data[1]->title }}"
                                placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="feature-1">{{ $data[1]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- feature-2 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Feature-2</h4>
                    <form action="{{ route('create.features') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="3">
                        <div class="form-group">
                            <label class="">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $data[2]->title }}"
                                placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="feature-2">{{ $data[2]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- feature-3 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Feature-3</h4>
                    <form action="{{ route('create.features') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="4">
                        <div class="form-group">
                            <label class="">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $data[3]->title }}"
                                placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="feature-3">{{ $data[3]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- feature-4 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Feature-4</h4>
                    <form action="{{ route('create.features') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="5">
                        <div class="form-group">
                            <label class="">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $data[4]->title }}"
                                placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="feature-4">{{ $data[4]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Dropify
        $('.dropify').dropify();
    </script>
@endpush
