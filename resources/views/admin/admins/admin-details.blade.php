@extends('app-admin')
@section('content')

    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Admin Details</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Human Resource</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="{{route('administrators.index')}}" class="text-white text-hover-primary">Admins</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>

{{--    <admin-details-component id="{{ $id }}" causer_id="{{ Auth::user()->id }}"></admin-details-component>--}}

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">

                    <admin-details-component id="{{ $id }}" causer_id="{{ Auth::user()->id }}"
                                             admin_edit="{{ Auth::user()->can('admin-edit') }}"
                                             admin_permission="{{ Auth::user()->can('admin-permission') }}"
                    ></admin-details-component>

                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#events_and_logs_tab">Logs</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#user_view_permissions">Permissions</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="user_view_permissions" role="tabpanel">
                                <!--begin::Tasks-->
                                <div class="card card-flush mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header mt-6">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Admin Permissions</h2>
                                            <div class="fs-6 fw-bold text-muted">Total admin permissions</div>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin::Row-->
                                        <form method="post" action="{{ route('administrators.permissions.edit', [$id]) }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-xl-2"></div>
                                                <div class="col-xl-7">

                                                    <!--begin::Row-->
                                                    <div class="row">
                                                        <label class="col-3"></label>
                                                        <div class="col-9">
                                                            <h6 class="text-dark font-weight-bold mb-10">Update Permissions:</h6>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="checkbox-list">
                                                            @foreach (array_chunk($permissions, 4) as $chunk)
                                                                <div class="row">
                                                                    @foreach($chunk as $permission)
                                                                        <div class="col-md-4">
                                                                            <label class="checkbox">
                                                                                @if($permission['has_permission'] == 1)
                                                                                    <input type="checkbox" name="user_permissions[]" value="{{ $permission['name'] }}" checked/>{{ $permission['name'] }}
                                                                                @else
                                                                                    <input type="checkbox" name="user_permissions[]" value="{{ $permission['name'] }}" />{{ $permission['name'] }}
                                                                                @endif
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!--begin::Wizard Actions-->
                                                    <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                        <div>
                                                            <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4">Edit Permissions</button>
                                                        </div>
                                                    </div>
                                                    <!--end::Wizard Actions-->

                                                </div>
                                            </div>
                                        </form>

                                        <!--end::Row-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Tasks-->
                            </div>
                            <!--end:::Tab pane-->

                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="events_and_logs_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Logs</h2>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5" >
                                                <!--begin::Table head-->
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                                <!--begin::Table row-->
                                                <tr class="text-start text-muted text-uppercase gs-0">
                                                    <th class="min-w-100px">No #</th>
                                                    <th>ACTIVITY</th>
                                                    <th>DESCRIPTION</th>
                                                    <th class="min-w-125px">DATE</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                @foreach ($logs as $log)
                                                    <tr>
                                                        <td>{{ $loop->iteration  }}</td>
                                                        <td><a href="#">{{ strtoupper($log->log_name) }}</a></td>
                                                        <td>{{ $log->description }}</td>
                                                        <td>{{ $log->created_at }}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
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
