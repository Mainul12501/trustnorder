@extends('backend.master')
@section('title')
    Dashboard
@endsection
@section('breadcrumb')
    Dashboard
@endsection

@section('body')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="ri-emotion-line fs-6 text-info"></i>
                                <p class="fs-4 mb-1">Total Categories</p>
                            </div>
                            <div class="col-5">
                                <h1 class="fw-light text-end mb-0">{{ $total_categories }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="ri-image-fill fs-6 text-success"></i>
                                <p class="fs-4 mb-1">Total Users</p>
                            </div>
                            <div class="col-5">
                                <h1 class="fw-light text-end mb-0">{{ $total_users }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="ri-money-euro-circle-line fs-6 text-purple"></i>
                                <p class="fs-4 mb-1">Active Products</p>
                            </div>
                            <div class="col-5">
                                <h1 class="fw-light text-end mb-0">{{ $total_products }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="ri-bar-chart-fill fs-6 text-danger"></i>
                                <p class="fs-4 mb-1">Total Orders</p>
                            </div>
                            <div class="col-5">
                                <h1 class="fw-light text-end mb-0">{{ $total_orders }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <i class="ri-bar-chart-fill fs-6 text-danger"></i>
                                <p class="fs-4 mb-1">Total Pending Orders</p>
                            </div>
                            <div class="col-5">
                                <h1 class="fw-light text-end mb-0">{{ $pending_orders }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Email campaign chart -->
        <!-- ============================================================== -->
{{--        <div class="row">--}}
{{--            <div class="col-lg-8 col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h4 class="card-title">Sales Ratio</h4>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <div class="">--}}
{{--                                    <select class="form-select">--}}
{{--                                        <option value="0" selected="">August 2021</option>--}}
{{--                                        <option value="1">May 2021</option>--}}
{{--                                        <option value="2">March 2021</option>--}}
{{--                                        <option value="3">June 2021</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="sales-ratio" class="mt-4"></div>--}}
{{--                        <ul class="list-inline mt-4 text-center fs-2">--}}
{{--                            <li class="list-inline-item text-muted">--}}
{{--                                <i class="--}}
{{--                          ri-checkbox-blank-circle-fill--}}
{{--                          fs-3--}}
{{--                          align-middle--}}
{{--                          text-info--}}
{{--                          me-1--}}
{{--                        "></i>--}}
{{--                                Xtreme Admin--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item text-muted">--}}
{{--                                <i class="--}}
{{--                          ri-checkbox-blank-circle-fill--}}
{{--                          fs-3--}}
{{--                          align-middle--}}
{{--                          text-success--}}
{{--                          me-1--}}
{{--                        "></i>--}}
{{--                                MaterialPro Admin--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-12">--}}
{{--                <div class="card bg-info">--}}
{{--                    <div class="card-body mb-0">--}}
{{--                        <h4 class="card-title text-white">--}}
{{--                            Thursday--}}
{{--                            <span class="fs-3 fw-normal text-white op-5">12th April, 2021</span>--}}
{{--                        </h4>--}}
{{--                        <div class="d-flex align-items-center flex-row mt-4">--}}
{{--                            <h1 class="fw-light text-white">--}}
{{--                                <i class="wi wi-day-sleet"></i>--}}
{{--                                <span>35<sup>°</sup></span>--}}
{{--                            </h1>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="weather-report"></div>--}}
{{--                </div>--}}
{{--                <div class="card bg-success">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h4 class="card-title text-white">Users</h4>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <h2 class="fw-light text-white">35,658</h2>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mt-4 mb-2">--}}
{{--                            <ul class="list-style-none mt-2">--}}
{{--                                <li>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div>--}}
{{--                                            <h4 class="mb-0 font-weight-medium text-white">--}}
{{--                                                58%--}}
{{--                                                <span class="fw-normal fs-3 text-white op-5 ms-1">New Users</span>--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="progress mt-2 user-progress-bg">--}}
{{--                                        <div class="progress-bar bg-white" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="mt-4">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div>--}}
{{--                                            <h4 class="mb-0 font-weight-medium text-white">--}}
{{--                                                16%--}}
{{--                                                <span class="fw-normal fs-3 text-white op-5 ms-1">Repeat Users</span>--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="progress mt-2 user-progress-bg">--}}
{{--                                        <div class="progress-bar bg-white" role="progressbar" style="width: 16%" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ============================================================== -->
        <!-- Email campaign chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Ravenue - page-view-bounce rate -->
        <!-- ============================================================== -->
{{--        <div class="row">--}}
{{--            <div class="col-sm-12 col-lg-4 d-flex align-items-stretch">--}}
{{--                <div class="card w-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="card-title">Campaign Status</h4>--}}
{{--                        <div id="campaign-status" class="status mt-4"></div>--}}

{{--                        <div class="row mt-4">--}}
{{--                            <div class="col-4 border-end">--}}
{{--                                <i class="ri-checkbox-blank-circle-fill fs-4 text-primary"></i>--}}
{{--                                <h4 class="mb-0 font-weight-medium">5489</h4>--}}
{{--                                <span>Success</span>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 border-end">--}}
{{--                                <i class="ri-checkbox-blank-circle-fill fs-4 text-info"></i>--}}
{{--                                <h4 class="mb-0 font-weight-medium">954</h4>--}}
{{--                                <span>Pending</span>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 p-l-20">--}}
{{--                                <i class="ri-checkbox-blank-circle-fill fs-4 text-success"></i>--}}
{{--                                <h4 class="mb-0 font-weight-medium">736</h4>--}}
{{--                                <span>Failed</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-12 col-lg-8 d-flex align-items-stretch">--}}
{{--                <div class="card w-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h4 class="card-title">Yearly Comparison</h4>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <div class="">--}}
{{--                                    <select class="form-select">--}}
{{--                                        <option value="0" selected="">2021</option>--}}
{{--                                        <option value="1">2015</option>--}}
{{--                                        <option value="2">2016</option>--}}
{{--                                        <option value="3">2017</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="yearly-comparison" class="mt-4"></div>--}}
{{--                        <ul class="list-inline mt-4 text-center fs-2">--}}
{{--                            <li class="list-inline-item text-muted">--}}
{{--                                <i class="--}}
{{--                          ri-checkbox-blank-circle-fill--}}
{{--                          fs-3--}}
{{--                          align-middle--}}
{{--                          text-info--}}
{{--                          me-1--}}
{{--                        "></i>--}}
{{--                                This Year--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item text-muted">--}}
{{--                                <i class="--}}
{{--                          ri-checkbox-blank-circle-fill--}}
{{--                          fs-3--}}
{{--                          align-middle--}}
{{--                          text-light--}}
{{--                          me-1--}}
{{--                        "></i>--}}
{{--                                Last Year--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ============================================================== -->
        <!-- Ravenue - page-view-bounce rate -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Recent comment and todo -->
        <!-- ============================================================== -->
{{--        <div class="row">--}}
{{--            <!-- column -->--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="card-title">Recent Comments</h4>--}}
{{--                    </div>--}}
{{--                    <div class="comment-widgets scrollable mb-2 common-widget" style="height: 450px">--}}
{{--                        <!-- Comment Row -->--}}
{{--                        <div class="d-flex flex-row comment-row p-3">--}}
{{--                            <div class="p-2">--}}
{{--                                <span><img src="{{ asset('/') }}backend/assets/images/users/1.jpg" class="rounded-circle" alt="user" width="50"></span>--}}
{{--                            </div>--}}
{{--                            <div class="comment-text w-100 p-3">--}}
{{--                                <h5 class="text-nowrap font-weight-medium">--}}
{{--                                    James Anderson--}}
{{--                                </h5>--}}
{{--                                <p class="mb-1 fs-3 fw-normal text-muted">--}}
{{--                                    Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                    type setting industry.--}}
{{--                                </p>--}}
{{--                                <div class="comment-footer d-md-flex align-items-center mt-2">--}}
{{--                        <span class="--}}
{{--                            badge--}}
{{--                            bg-light-info--}}
{{--                            text-info--}}
{{--                            font-weight-medium--}}
{{--                            py-1--}}
{{--                          ">Pending</span>--}}
{{--                                    <span class="action-icons">--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-edit-box-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-check-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-heart-line fs-6"></i></a>--}}
{{--                        </span>--}}
{{--                                    <div class="ms-auto">--}}
{{--                                        <span class="text-muted fs-2">April 14, 2021</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Comment Row -->--}}
{{--                        <div class="d-flex flex-row comment-row active p-3">--}}
{{--                            <div class="p-2">--}}
{{--                      <span class="--}}
{{--                          round--}}
{{--                          text-white--}}
{{--                          d-inline-block--}}
{{--                          text-center--}}
{{--                        "><img src="{{ asset('/') }}backend/assets/images/users/2.jpg" class="rounded-circle" alt="user" width="50"></span>--}}
{{--                            </div>--}}
{{--                            <div class="comment-text active w-100 p-3">--}}
{{--                                <h5 class="text-nowrap font-weight-medium">--}}
{{--                                    Michael Jorden--}}
{{--                                </h5>--}}
{{--                                <p class="mb-1 fs-3 text-muted fw-normal">--}}
{{--                                    Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                    type setting industry.--}}
{{--                                </p>--}}
{{--                                <div class="comment-footer d-md-flex align-items-center mt-2">--}}
{{--                        <span class="--}}
{{--                            badge--}}
{{--                            bg-light-success--}}
{{--                            text-success--}}
{{--                            font-weight-medium--}}
{{--                            py-1--}}
{{--                          ">Approved</span>--}}
{{--                                    <span class="action-icons">--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-edit-box-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-check-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-heart-line fs-6"></i></a>--}}
{{--                        </span>--}}
{{--                                    <div class="ms-auto">--}}
{{--                                        <span class="text-muted fs-2">April 14, 2021</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Comment Row -->--}}
{{--                        <div class="d-flex flex-row comment-row p-3">--}}
{{--                            <div class="p-2">--}}
{{--                      <span class="--}}
{{--                          round--}}
{{--                          text-white--}}
{{--                          d-inline-block--}}
{{--                          text-center--}}
{{--                        "><img src="{{ asset('/') }}backend/assets/images/users/3.jpg" class="rounded-circle" alt="user" width="50"></span>--}}
{{--                            </div>--}}
{{--                            <div class="comment-text w-100 p-3">--}}
{{--                                <h5 class="text-nowrap font-weight-medium">--}}
{{--                                    Johnathan Doeting--}}
{{--                                </h5>--}}
{{--                                <p class="mb-1 fs-3 fw-normal text-muted">--}}
{{--                                    Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                    type setting industry.--}}
{{--                                </p>--}}
{{--                                <div class="comment-footer d-md-flex align-items-center mt-2">--}}
{{--                        <span class="--}}
{{--                            badge--}}
{{--                            bg-light-danger--}}
{{--                            text-danger--}}
{{--                            font-weight-medium--}}
{{--                            py-1--}}
{{--                          ">Rejected</span>--}}
{{--                                    <span class="action-icons">--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-edit-box-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-check-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-heart-line fs-6"></i></a>--}}
{{--                        </span>--}}
{{--                                    <div class="ms-auto">--}}
{{--                                        <span class="text-muted fs-2">April 14, 2021</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Comment Row -->--}}
{{--                        <div class="d-flex flex-row comment-row p-3">--}}
{{--                            <div class="p-2">--}}
{{--                                <span class=""><img src="{{ asset('/') }}backend/assets/images/users/4.jpg" class="rounded-circle" alt="user" width="50"></span>--}}
{{--                            </div>--}}
{{--                            <div class="comment-text w-100 p-3">--}}
{{--                                <h5 class="text-nowrap font-weight-medium">--}}
{{--                                    James Anderson--}}
{{--                                </h5>--}}
{{--                                <p class="mb-1 fs-3 text-muted fw-normal">--}}
{{--                                    Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                    type setting industry.--}}
{{--                                </p>--}}
{{--                                <div class="comment-footer d-md-flex align-items-center mt-2">--}}
{{--                        <span class="--}}
{{--                            badge--}}
{{--                            bg-light-info--}}
{{--                            text-info--}}
{{--                            font-weight-medium--}}
{{--                            py-1--}}
{{--                          ">Pending</span>--}}
{{--                                    <span class="action-icons">--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-edit-box-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-check-line fs-6"></i></a>--}}
{{--                          <a href="javascript:void(0)" class="ps-3"><i class="ri-heart-line fs-6"></i></a>--}}
{{--                        </span>--}}
{{--                                    <div class="ms-auto">--}}
{{--                                        <span class="text-muted fs-2">April 14, 2021</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- column -->--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center p-b-15">--}}
{{--                            <div>--}}
{{--                                <h4 class="card-title mb-0">To Do List</h4>--}}
{{--                            </div>--}}
{{--                            <div class="ms-auto">--}}
{{--                                <div class="dl">--}}
{{--                                    <select class="form-select">--}}
{{--                                        <option value="0" selected="">August 2021</option>--}}
{{--                                        <option value="1">May 2021</option>--}}
{{--                                        <option value="2">March 2021</option>--}}
{{--                                        <option value="3">June 2021</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="to-do-widget mt-3 common-widget scrollable" style="height: 438px">--}}
{{--                            <ul class="list-task todo-list list-group mb-0" data-role="tasklist">--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" class="form-check-input danger check-light-danger" id="inputSchedule" name="inputCheckboxesSchedule">--}}
{{--                                        <label for="inputSchedule" class="form-check-label">--}}
{{--                                            <span>Schedule meeting with</span><span class="badge bg-danger badge-pill ms-1">Today</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <ul class="assignedto list-style-none m-0 ps-4 ms-1 mt-1">--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Steave" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Jessica" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Selina" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" id="inputCall" class="form-check-input info check-light-info" name="inputCheckboxesCall">--}}
{{--                                        <label for="inputCall" class="form-check-label">--}}
{{--                                            <span>Give Purchase report to</span>--}}
{{--                                            <span class="badge bg-info badge-pill ms-1">Yesterday</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <ul class="assignedto m-0 ps-4 ms-1 mt-1">--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Selina" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" id="inputBook" class="form-check-input primary check-light-primary" name="inputCheckboxesBook">--}}
{{--                                        <label for="inputBook" class="form-check-label">--}}
{{--                                            <span>Book flight for holiday</span><span class="badge bg-primary badge-pill ms-1">1 week</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="fs-2 ps-3 d-inline-block ms-2">--}}
{{--                                        26 jun 2021--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" id="inputForward" class="form-check-input warning check-light-warning" name="inputCheckboxesForward">--}}
{{--                                        <label for="inputForward" class="form-check-label">--}}
{{--                                            <span>Forward all tasks</span>--}}
{{--                                            <span class="badge bg-warning badge-pill ms-1">2 weeks</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="fs-2 ps-3 d-inline-block ms-2">--}}
{{--                                        26 jun 2021--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" id="inputRecieve" class="form-check-input success check-light-success" name="inputCheckboxesRecieve">--}}
{{--                                        <label for="inputRecieve" class="form-check-label">--}}
{{--                                            <span>Recieve shipment</span><span class="badge bg-success badge-pill ms-1">2 weeks</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <ul class="assignedto list-style-none m-0 ps-4 ms-1 mt-1">--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Steave" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Jessica" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">--}}
{{--                                    <div class="form-check form-check-inline w-100">--}}
{{--                                        <input type="checkbox" class="form-check-input danger check-light-danger" id="inputSchedule" name="inputCheckboxesSchedule">--}}
{{--                                        <label for="inputSchedule" class="form-check-label">--}}
{{--                                            <span>Schedule meeting with</span><span class="badge bg-danger badge-pill ms-1">Today</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <ul class="assignedto list-style-none m-0 ps-4 ms-1 mt-1">--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Steave" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Jessica" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                        <li class="d-inline-block border-0 me-1">--}}
{{--                                            <img src="{{ asset('/') }}backend/assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Selina" class="rounded-circle">--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>
@endsection

@push('script')
    <!--This page JavaScript -->
    <script src="{{ asset('/') }}backend/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="{{ asset('/') }}backend/dist/js/pages/dashboards/dashboard3.js"></script>
@endpush
