@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- How it works ......................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">How It works</h2>
            <div class="row gap-4 justify-content-center">
                {{-- step-1 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>step-1</h4>
                    <form action="{{ route('sell.car.how.it.works') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="4">
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="step-1">{{ $data[3]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- step-2 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Step-2</h4>
                    <form action="{{ route('sell.car.how.it.works') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="5">
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="step-2">{{ $data[4]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- step-3 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Step-3</h4>
                    <form action="{{ route('sell.car.how.it.works') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="6">
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="step-3">{{ $data[5]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
                {{-- step-4 --}}
                <div class="col-12 col-md-5 rounded p-4" style="border: solid 1px gray; background: white;">
                    {{-- update title & description --}}
                    <h4>Step-4</h4>
                    <form action="{{ route('sell.car.how.it.works') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="7">
                        <div class="form-group">
                            <label class="">Description</label>
                            <textarea class="form-control" name="description" id="step-4">{{ $data[6]->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
