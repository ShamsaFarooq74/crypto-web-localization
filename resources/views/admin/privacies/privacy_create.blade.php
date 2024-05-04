@extends('layouts.master')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                    <li class="breadcrumb-item " aria-current="page">Privacy Create</li>
                </ol>
            </nav>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->

            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <form action="{{ url('privacy-store') }}" method="post">
                            @csrf

                            <div class="col-md-12 mb-3">
                                <label for="" class="mb-3"> Name (English)</label>
                                <input type="text" name="nameEN" value="{{ old('nameEN') }}"
                                class="form-control mb-3" placeholder="Enter nameEN">
                                @if ($errors->has('nameEN'))
                                <div class="text-danger">
                                    {{ $errors->first('nameEN') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="mb-3">Name (Arabic)</label>
                                <input type="text" name="nameAR" value="{{ old('nameAR') }}"
                                class="form-control mb-3" placeholder="Enter nameAR">
                                @if ($errors->has('nameAR'))
                                <div class="text-danger">
                                    {{ $errors->first('nameAR') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="mb-3">Description (English) </label>
                                <textarea type="text" id="descriptionEN"  name="descriptionEN" class="form-control mb-3" rows="3"
                                placeholder="Enter DescriptionEN">{{ old('descriptionEN') }}</textarea>
                                <div class="d-flex justify-content-center my-3">
                                    @if ($errors->has('descriptionEN'))
                                    <div class="text-danger">
                                        {{ $errors->first('descriptionEN') }}
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="mb-3">Description (Arabic)</label>
                                <textarea type="text" name="descriptionAR" class="form-control mb-3" rows="3"
                                placeholder="Enter DescriptionAR">{{ old('descriptionAR') }}</textarea>
                                <div class="d-flex justify-content-center my-3">
                                    @if ($errors->has('descriptionAR'))
                                    <div class="text-danger">
                                        {{ $errors->first('descriptionAR') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-success">Submit</button>
                        </form>

                    </div>

                </div>

            </div>

            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection
@push('scripts')
<script>
    //   CKEDITOR.replace('descriptionEN');
//     $(document).ready(function() {
//   $('#summernote').summernote();
// });
</script>
@endpush

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
      CKEDITOR.replace('descriptionEN');
    </script>
