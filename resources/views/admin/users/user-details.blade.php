@extends('app-admin')
@section('content')

    <div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-white fw-bolder my-1 fs-3">Users Details</h1>
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
                        <a href="{{route('users.index')}}" class="text-white text-hover-primary">Users</a>
                    </li>
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
                <!--begin::Sidebar-->
                <user-details-component id="{{ $id }}" causer_id="{{ Auth::user()->id }}"
                                        user_edit="{{ Auth::user()->can('user-edit') }}"></user-details-component>
                <!--end::Sidebar-->
{{--                <!--begin::Content-->--}}
{{--                <div class="flex-lg-row-fluid ms-lg-15">--}}
{{--                    <!--begin:::Tabs-->--}}
{{--                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8" role="tablist">--}}
{{--                        <!--begin:::Tab item-->--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#transaction_summary">Wallet History</a>--}}
{{--                        </li>--}}
{{--                        <!--end:::Tab item-->--}}
{{--                        <!--begin:::Tab item-->--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#buy_history">Buy History</a>--}}
{{--                        </li>--}}
{{--                        <!--end:::Tab item-->--}}
{{--                        <!--begin:::Tab item-->--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#sell_history">Sell History</a>--}}
{{--                        </li>--}}
{{--                        <!--end:::Tab item-->--}}


{{--                    </ul>--}}
{{--                    <!--end:::Tabs-->--}}

{{--                    <!--begin:::Tab content-->--}}
{{--                    <div class="tab-content" id="myTabContent">--}}
{{--                        <!--begin:::Tab pane-->--}}
{{--                        <div class="tab-pane fade show active" id="transaction_summary" role="tabpanel">--}}
{{--                        <!--begin:::Tab pane-->--}}
{{--                                <user-wallet-history-component id="{{ $id }}"></user-wallet-history-component>--}}
{{--                        <!--end:::Tab pane-->--}}
{{--                        </div>--}}
{{--                        <!--end:::Tab pane-->--}}

{{--                        <!--begin:::Tab pane-->--}}
{{--                        <div class="tab-pane fade" id="buy_history" role="tabpanel">--}}

{{--                            <!--begin::Card-->--}}
{{--                            <user-buy-history-component id="{{ $id }}"></user-buy-history-component>--}}
{{--                            <!--end::Card-->--}}
{{--                        </div>--}}
{{--                        <!--end:::Tab pane-->--}}

{{--                        <!--begin:::Tab pane-->--}}
{{--                        <div class="tab-pane fade show active" id="sell_history" role="tabpanel">--}}

{{--                        <user-sell-history-component id="{{ $id }}"></user-sell-history-component>--}}
{{--                        </div>--}}
{{--                        <!--end:::Tab pane-->--}}
{{--                    </div>--}}
{{--                    <!--end:::Tab content-->--}}
{{--                </div>--}}
{{--                <!--end::Content-->--}}
            </div>
            <!--end::Layout-->
            <!--begin::Modals-->


            <!--end::Modals-->
        </div>
        <!--end::Post-->
    </div>

@endsection
