@extends('app-admin')
@section('content')

    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Countries List</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Settings</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-white opacity-75">Countries</li>
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
            <div class="row g-0">
                <!--begin::Col-->
                <div class="col bg-light-warning px-20 py-12 rounded-2 me-7 mb-7">
                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
														</span><br>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-warning fw-bold fs-6">Total Countries</a>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col bg-light-warning px-20 py-12 rounded-2 me-7 mb-7">
                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
														</span><br>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-warning fw-bold fs-6">Current month</a>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col bg-light-warning px-20 py-12 rounded-2 me-7 mb-7">
                    <!--begin::Svg Icon | path: icons/duotone/Media/Equalizer.svg-->
                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
														</span><br>
                    <!--end::Svg Icon-->
                    <a href="#" class="text-warning fw-bold fs-6">This week</a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

<country-list-component causer_id="{{ Auth::user()->id }}"
                   country_details="{{ Auth::user()->can('country-details') }}"
                   country_list="{{ Auth::user()->can('country-list') }}"
                   country_create="{{ Auth::user()->can('country-create') }}"
                   country_delete="{{ Auth::user()->can('country-delete') }}"
                   country_edit="{{ Auth::user()->can('country-edit') }}"></country-list-component>

        </div>
        <!--end::Post-->
    </div>

@endsection
