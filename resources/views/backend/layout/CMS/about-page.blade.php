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

        {{-- my word ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">My Words</h2>
                {{-- delete image --}}
                <form action="{{ route('mywords.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="6">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('mywords') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="6">
                <div class="form-group">
                    <label class="">Title</label>
                    <input class="form-control" type="text" name="title" value="{{ $data[5]->title }}"
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
                    <textarea class="form-control" name="description" id="my_words">{{ $data[5]->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>

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

        {{-- hero text ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Hero Text</h2>
            {{-- update hero text --}}
            <form action="{{ route('hero.text') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="10">
                <div class="form-group">
                    <label class="">Title</label>
                    <input class="form-control" type="text" name="description" value="{{ $data[9]->description }}"
                        placeholder="Title">
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>

        {{-- binding a car ..................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <div class="d-flex justify-content-between">
                <h2 class="mb-4">Binding a Car</h2>
                {{-- delete image --}}
                <form action="{{ route('binding.car.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="7">
                    <button class="btn btn-danger">Delete Current Image</button>
                </form>
            </div>
            {{-- update image & description --}}
            <form action="{{ route('binding.car') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="7">
                <div class="form-group">
                    <label class="">Image</label>
                    <input class="form-control dropify" type="file"
                        data-default-file="{{ asset('backend/images/placeholder/image_placeholder.png') }}"
                        name="image_url">
                </div>
                <div class="form-group">
                    <label class="">Description</label>
                    <textarea class="form-control" name="description" id="binging_a_car_text">{{ $data[6]->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>

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
