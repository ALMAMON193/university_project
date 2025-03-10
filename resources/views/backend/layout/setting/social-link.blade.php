@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{--  Social Links .......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Social Links</h2>
            <div class="row gap-4 justify-content-center">
                {{-- twitter --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update link --}}
                    <form action="{{ route('set.link') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="3">
                        <div class="form-group">
                            <label class="">Twitter</label>
                            <input class="form-control" type="text" name="link" value="{{ $data[2]->link }}"
                                placeholder="Link">
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- facebook --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update link --}}
                    <form action="{{ route('set.link') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="4">
                        <div class="form-group">
                            <label class="">Facebook</label>
                            <input class="form-control" type="text" name="link" value="{{ $data[3]->link }}"
                                placeholder="Link">
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- Instagram --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update link --}}
                    <form action="{{ route('set.link') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="5">
                        <div class="form-group">
                            <label class="">Instagram</label>
                            <input class="form-control" type="text" name="link" value="{{ $data[4]->link }}"
                                placeholder="Link">
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- git --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update link --}}
                    <form action="{{ route('set.link') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="6">
                        <div class="form-group">
                            <label class="">GitHub</label>
                            <input class="form-control" type="text" name="link" value="{{ $data[5]->link }}"
                                placeholder="Link">
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
