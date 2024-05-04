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
                        <li class="breadcrumb-item " aria-current="page">Users</li>
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
                    <!--begin::Tables Widget 9-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">All Registerd Users</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="fw-bold">#</th>
                                            <th class="min-w-100px">Name</th>
                                            <th class="min-w-100px">Email</th>
                                            <th class="min-w-100px">Date Of Birth</th>
                                            <th class="min-w-100px">Phone No</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                        <tr>
                                            <td>
                                                <p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
                                                    {{ ++$key }}.
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
                                                    {{ $user->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
                                                    {{ $user->email }}
                                                </p>
                                            </td> 
                                             <td>
                                                <p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
                                                    {{ $user->birth_date }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-dark fw-bolder text-hover-primary d-block fs-6 ">
                                                    {{ $user->phone_number }}
                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>					
    @endsection