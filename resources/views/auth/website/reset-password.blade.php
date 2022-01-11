<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>Digital Advocacy - Reset Password</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <link rel="canonical" href=""/>
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/favicon.ico') }}"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - Sign-in -->
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        >
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" method="POST"
                      action="{{ route('website.reset.password.submit') }}">
                {{ csrf_field() }}
                <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-dark mb-3">Reset Password ?</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Enter reset code sent on email.</div>
                        <!--end::Link-->
                    </div>

                    @if(session()->has('message'))
                        <div class="alert alert-danger">
                            <p style="color:#000;"> {{ session()->get('message') }}</p>
                        </div>
                @endif

                <!--begin::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">Reset Code</label>
                        <input class="form-control form-control-solid" type="number" placeholder=""
                               value="{{ old('reset_code') }}" name="reset_code" autocomplete="off"/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <label class="form-label fw-bolder text-gray-900 fs-6">New Password</label>
                        <input class="form-control form-control-solid" type="password" placeholder=""
                               value="{{ old('password') }}" name="password" autocomplete="off"/>
                    </div>

                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" id="kt_password_reset_submit"
                                class="btn btn-lg btn-primary fw-bolder me-4">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="#" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="d-flex flex-center flex-column-auto p-10">
            <!--begin::Links-->
            <div class="d-flex align-items-center fw-bold fs-6">
                <a href="#" class="text-muted text-hover-primary px-2">About</a>
                <a href="#" class="text-muted text-hover-primary px-2">Contact</a>
            </div>
            <!--end::Links-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/admin/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
