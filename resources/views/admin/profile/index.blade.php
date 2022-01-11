@extends('app-admin')
@section('content')
    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Profile</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{route('admin.dashboard')}}" class="text-white text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">My Profile</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
{{--                <!--begin::Sidebar-->--}}
{{--                <user-details-component {{ $id ?? '' }} causer_id="{{ Auth::user()->id }}" user_list="{{ Auth::user()->can('user-list') }}"></user-details-component>--}}
{{--                <!--end::Sidebar-->--}}
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#account">Account</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#password">Change Password</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#logs">Logs</a>
                        </li>
                        <!--end:::Tab item-->


                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="account" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>My Profile</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <admin-account-profile-component id="{{ Auth::user()->id }}"></admin-account-profile-component>
                                    <!--end::Row-->

                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="password" role="tabpanel">

                            <admin-password-component id="{{ Auth::user()->id }}"></admin-password-component>

                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="logs" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Activity Logs</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="row justify-content-center">
                                    <div class="col-9">
                                        <table class="datatable datatable-bordered datatable-head-custom table-striped" id="kt_datatable">
                                            <thead>
                                            <tr>
                                                <th class="min-w-125px">No</th>
                                                <th class="min-w-125px">Activity</th>
                                                <th class="min-w-125px">Description</th>
                                                <th class="min-w-125px">Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td>{{ $loop->iteration  }}</td>
                                                    <td><a href="#">{{ strtoupper($log->log_name) }}</a></td>
                                                    <td>{{ $log->description }}</td>
                                                    <td>{{ $log->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
            <!--begin::Modals-->


            <!--end::Modals-->
        </div>
        <!--end::Post-->
    </div>
@endsection
