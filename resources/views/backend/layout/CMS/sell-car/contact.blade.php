@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- hero text ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Contact</h2>
            {{-- update hero text --}}
            <form action="{{ route('sell.car.contact') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="8">
                <div class="form-group">
                    <label class="">Email</label>
                    <input class="form-control" type="text" name="title" value="{{ $data[7]->title }}"
                        placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label class="">Contact Number</label>
                    <input class="form-control" type="text" name="sub_title" value="{{ $data[7]->sub_title }}"
                        placeholder="Enter your contact number">
                </div>
                <div class="form-group">
                    <label class="">Address</label>
                    <input class="form-control" type="text" name="description" value="{{ $data[7]->description }}"
                        placeholder="Enter your address">
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>
    </div>
@endsection