@extends('app-admin')
@section('content')

    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Accounts</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Finance</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">Accounts</li>
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

            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotone/Shopping/Chart-bar1.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
														<rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
														<path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
														<rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
													</g>
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-success fw-bolder fs-2 mb-2 mt-5">{{$total_accounts}}</div>
                            <div class="fw-bold text-inverse-success fs-7">Total Accounts</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotone/Home/Building.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
														<rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
														<path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
														<rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
													</g>
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-primary fw-bolder fs-2 mb-2 mt-5">{{$total_active}}</div>
                            <div class="fw-bold text-inverse-primary fs-7">Total Active Accounts</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotone/Shopping/Cart3.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
														<rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
														<path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
														<rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
													</g>
												</svg>
											</span>
                            <!--end::Svg Icon-->
                            <div class="text-inverse-danger fw-bolder fs-2 mb-2 mt-5">{{$total_inactive}}</div>
                            <div class="fw-bold text-inverse-danger fs-7">Total inactive</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            </div>
            <!--end::Row-->

            <!---component-->
            <acccounts-component causer_id="{{ Auth::user()->id }}"
                                 account_details="{{ Auth::user()->can('account-details') }}"
                                 account_list="{{ Auth::user()->can('account-list') }}"
                                 account_create="{{ Auth::user()->can('account-create') }}"
                                 account_delete="{{ Auth::user()->can('account-delete') }}"
                                 account_edit="{{ Auth::user()->can('account-edit') }}"></acccounts-component>
            <!---end component-->

        </div>
        <!--end::Post-->
    </div>

@endsection

