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
                        <li class="breadcrumb-item " aria-current="page">Plan Edit</li>
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
                            <form action="{{ route('plan.update', $modelPlan->id) }}" method="post">
                                @csrf
                                @method('put')

                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Plan Name (English)</label>
                                    <input type="text" name="nameEN" value="{{ $modelPlan->nameEN }}"
                                        class="form-control mb-3" placeholder="Enter plan nameEN">
                                    @if ($errors->has('nameEN'))
                                        <div class="text-danger">
                                            {{ $errors->first('nameEN') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Plan Name (Arabic)</label>
                                    <input type="text" name="nameAR" value="{{ $modelPlan->nameAR }}"
                                        class="form-control mb-3" placeholder="Enter plan nameAR">
                                    @if ($errors->has('nameAR'))
                                        <div class="text-danger">
                                            {{ $errors->first('nameAR') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Price</label>
                                    <input type="number" name="price" value="{{ $modelPlan->price }}"
                                        class="form-control mb-3" placeholder="Enter price">
                                    @if ($errors->has('price'))
                                        <div class="text-danger">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Daily Transfer Amount</label>
                                    <input type="number" name="daily_transfer_amount"
                                        value="{{ $modelPlan->daily_transfer_amount }}" class="form-control mb-3"
                                        placeholder="Enter daily_transfer_amount">
                                    @if ($errors->has('daily_transfer_amount'))
                                        <div class="text-danger">
                                            {{ $errors->first('daily_transfer_amount') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Currency</label>
                                    <input type="text" name="currency" value="{{ $modelPlan->currency }}"
                                        class="form-control mb-3" placeholder="Enter Currency">
                                    @if ($errors->has('currency'))
                                        <div class="text-danger">
                                            {{ $errors->first('currency') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Package Duration</label>
                                    <input type="number" name="duration" value="{{ $modelPlan->duration }}"
                                        class="form-control mb-3" placeholder="Enter duration">
                                    @if ($errors->has('duration'))
                                        <div class="text-danger">
                                            {{ $errors->first('duration') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-3">Description (English) </label>
                                    <textarea type="text" name="descriptionEN" class="form-control mb-3" rows="3"
                                        placeholder="Enter DescriptionEN">{{ $modelPlan->descriptionEN }}</textarea>
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
                                        placeholder="Enter DescriptionAR">{{ $modelPlan->descriptionAR }}</textarea>
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
