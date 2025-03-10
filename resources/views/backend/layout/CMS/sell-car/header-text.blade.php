@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}


@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- hero text ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Header Hero Text</h2>
            {{-- update hero text --}}
            <form action="{{ route('sell.car.hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                    <label class="">Title</label>
                    <input class="form-control" type="text" name="description" value="{{ $data[0]->description }}"
                        placeholder="Title">
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>
    </div>
@endsection
