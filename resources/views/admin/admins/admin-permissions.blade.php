@extends('app-admin')
@section('content')
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Card-->
        <div class="card card-custom card-transparent">
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                    <!--begin::Card-->
                    <div class="card card-custom card-shadowless rounded-top-0">
                        <!--begin::Body-->
                        <div class="card-body p-0">

                            <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-10">

                                    <form method="POST" action="{{ route('administrators.permissions.edit', [$id]) }}">
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
                                                        @foreach (array_chunk($permissions, 3) as $chunk)
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
                                                            {{--                                                                <label class="checkbox">--}}
                                                            {{--                                                                    @if($permission['has_permission'] == 1)--}}
                                                            {{--                                                                        <input type="checkbox" name="user_permissions[]" value="{{ $permission['name'] }}" checked/>{{ $permission['name'] }}--}}
                                                            {{--                                                                    @else--}}
                                                            {{--                                                                        <input type="checkbox" name="user_permissions[]" value="{{ $permission['name'] }}" />{{ $permission['name'] }}--}}
                                                            {{--                                                                    @endif--}}
                                                            {{--                                                                    <span></span>--}}
                                                            {{--                                                                </label>--}}
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <!--begin::Wizard Actions-->
                                                <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                    <div>
                                                        <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" data-wizard-type="action-submit">Edit Permissions</button>
                                                    </div>
                                                </div>
                                                <!--end::Wizard Actions-->


                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Wizard-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
@endsection
