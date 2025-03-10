@extends('backend.app') {{-- estending the back-end app.blade.php file  --}}

@section('main-panel')
    <div class="row gap-4 rounded">
        {{-- hero text ........................... --}}
        <div class="col-12 p-4 rounded" style="border: solid 1px gray; background: white;">
            <h2 class="mb-4">Create FAQ</h2>
            {{-- update hero text --}}
            <form action="{{ route('cms.car.page.faq.update', $faq) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group" data-select2-id="7">
                    <label>Place Section</label>
                    <select name='place' class="form-control" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option value="one" {{ $faq->place === 'one' ? 'selected' : '' }}>One</option>
                        <option value="two" {{ $faq->place === 'two' ? 'selected' : '' }}>Two</option>
                        <option value="three" {{ $faq->place === 'three' ? 'selected' : '' }}>Three</option>
                    </select>
                    @error('place')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="">Question</label>
                    <input class="form-control" type="text" name="question" value="{{ $faq->question }}"
                        placeholder="Question">
                    @error('question')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea style="height: 100px" class="form-control" id="answer" name="answer" placeholder="Answer">{{ $faq->answer }}</textarea>
                    @error('answer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" id="binding-car-submit">Save</button>
            </form>
        </div>
    </div>
@endsection
