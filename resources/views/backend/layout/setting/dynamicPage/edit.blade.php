@extends('backend.app')

@section('title', 'Create Dynamic Page')

@push('style')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 150px;
        }

        label .required {
            color: #ff0000;
            /* Red color */
        }
    </style>
@endpush

@section('main-panel')
    <div class="row rounded" style="border: solid 1px gray; background: white;">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Page</h4>
                    <p class="card-description">Setup your dynamic page, please <code> provide your valid
                            data</code>.</p>
                    <div class="mt-4">
                        <form class="forms-sample" action="{{ route('dynamic.page.update', ['id' => $data->id]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Title:<span class="required">*</span></label>
                                <input type="text" class="form-control @error('page_title') is-invalid @enderror"
                                    id="page_title" name="page_title" value="{{ $data->page_title }}">
                                @error('page_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="content" class="form-label">Content:<span class="required">*</span></label>
                                    <textarea class="form-control @error('page_content') is-invalid @enderror"" id="content" name="page_content"
                                        rows="5">{{ $data->page_content }}</textarea>
                                    @error('page_content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('dynamic.page') }}" class="btn btn-danger ">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#content'), {
                    height: '500px'
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
