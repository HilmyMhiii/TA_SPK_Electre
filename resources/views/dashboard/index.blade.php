@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12 mb-4 shadow p-3">
                    <img src="{{ asset('assets/images/rsnu.jpg') }}" alt="carousel" class="img-fluid" style="width: 1250px; height: 500px">
                </div>
            </div>
            @if (auth()->user()->role == 'admin')
                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card social-card card-colored twitter-card">
                            <div class="card-body d-flex flex-wrap align-items-center justify-content-center">
                                <i class="icon-social-twitter flex-shrink-0"></i>
                                <div class="wrapper ms-3">
                                    <h5 class="mb-0">Twitter Followers</h5>
                                    <h1 class="mb-0">3200+</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card social-card card-colored facebook-card">
                            <div class="card-body d-flex flex-wrap align-items-center justify-content-center">
                                <i class="icon-social-facebook flex-shrink-0"></i>
                                <div class="wrapper ms-3">
                                    <h5 class="mb-0">facebook likes</h5>
                                    <h1 class="mb-0">1500+</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card social-card card-colored instagram-card">
                            <div class="card-body d-flex flex-wrap align-items-center justify-content-center">
                                <i class="icon-social-instagram flex-shrink-0"></i>
                                <div class="wrapper ms-3">
                                    <h5 class="mb-0">Instagram Posts</h5>
                                    <h1 class="mb-0">2320+</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row quick-action-toolbar">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-header d-block d-md-flex">
                                <h5 class="mb-0">Quick Actions</h5>
                                <p class="ms-auto mb-0">How are your active users trending overtime?<i
                                        class="icon-bulb"></i></p>
                            </div>
                            <div class="d-md-flex row m-0 quick-action-btns" role="group"
                                aria-label="Quick action buttons">
                                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                    <button type="button" class="btn px-0"> <i class="icon-user me-2"></i> Add
                                        Client</button>
                                </div>
                                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                    <button type="button" class="btn px-0"><i class="icon-docs me-2"></i> Create
                                        Quote</button>
                                </div>
                                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                    <button type="button" class="btn px-0"><i class="icon-folder me-2"></i> Enter
                                        Payment</button>
                                </div>
                                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                                    <button type="button" class="btn px-0"><i class="icon-book-open me-2"></i>Create
                                        Invoice</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 grid-margin stretch-card">
                        <div class="card sales-report-country">
                            <div class="card-body">
                                <div class="d-md-flex">
                                    <h4 class="card-title">Sales Performance by Country</h4>
                                    <div class="mb-2 m-md-0 ms-md-auto">
                                        <a href="#" class="text-secondary me-3"><i class="icon-cloud-upload me-3"></i>
                                            Export File</a>
                                        <a href="#" class="text-secondary me-3"><i class="icon-printer me-3"></i>Print
                                            File</a>
                                    </div>
                                </div>
                                <div class="row my-xl-3">
                                    <div class="col-md-12 d-md-flex">
                                        <div>
                                            <h1 class="font-weight-bold mb-0">136,356.00</h1>
                                            <p class="text-muted">+23 since last year</p>
                                        </div>
                                        <div class="ml-md-3 ms-2">
                                            <p class="mb-0 mt-2">Sales performance of all states in the world</p>
                                            <p class="mb-0">This is your most recent earnings for today's date.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 pt-3">
                                        <div class="row">
                                            <div class="pb-xl-3 col-sm-6 col-xl-12 sales-activity">
                                                <p class="mb-1">Activations</p>
                                                <h1 class="font-weight-bold mb-0 text-info">156,123</h1>
                                                <p class="text-muted">Updated-6:16 pm</p>
                                            </div>
                                            <div class="pt-xl-3 col-sm-6 col-xl-12 sales-activity">
                                                <p class="mb-0">Net Revenue</p>
                                                <h1 class="font-weight-bold mb-0 text-primary">331,520</h1>
                                                <p class="text-muted pb-0">Updated-5:14 pm</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <div id="dashboard-vmap" class="vector-map"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex align-items-center">
                                    <h4 class="card-title mb-0">Latest Activity</h4>
                                    <a href="#"
                                        class="btn btn-outline-info border-0 font-weight-semibold ms-auto p-0 btn-no-hover-bg">View
                                        more</a>
                                </div>
                                <div class="d-flex mt-4 py-3 border-bottom">
                                    <img class="img-sm rounded-circle" src="assets/images/faces/face3.jpg"
                                        alt="profile image">
                                    <div class="wrapper ms-2">
                                        <p class="mb-1 font-weight-medium">Mobile Apps Redesign</p>
                                        <small class="text-muted">+23 since last year</small>
                                    </div>
                                    <small class="text-muted ms-auto">10:07PM</small>
                                </div>
                                <div class="d-flex py-3 border-bottom">
                                    <img class="img-sm rounded-circle" src="assets/images/faces/face2.jpg">
                                    <div class="wrapper ms-2">
                                        <p class="mb-1 font-weight-medium">Inviting Join Apps Cont...</p>
                                        <small class="text-muted">+23 since last year</small>
                                    </div>
                                    <small class="text-muted ms-auto">01:07AM</small>
                                </div>
                                <div class="d-flex py-3 border-bottom">
                                    <img class="img-sm rounded-circle" src="assets/images/faces/face4.jpg"
                                        alt="profile image">
                                    <div class="wrapper ms-2">
                                        <p class="mb-1 font-weight-medium">Website Redesign</p>
                                        <small class="text-muted">+23 since last year</small>
                                    </div>
                                    <small class="text-muted ms-auto">04:42AM</small>
                                </div>
                                <div class="d-flex py-3  border-bottom">
                                    <img class="img-sm rounded-circle" src="assets/images/faces/face8.jpg">
                                    <div class="wrapper ms-2">
                                        <p class="mb-1 font-weight-medium">Analytics Dashboard</p>
                                        <small class="text-muted">+23 since last year</small>
                                    </div>
                                    <small class="text-muted ms-auto">07:44PM</small>
                                </div>
                                <div class="d-flex pt-3">
                                    <img class="img-sm rounded-circle" src="assets/images/faces/face7.jpg">
                                    <div class="wrapper ms-2">
                                        <p class="mb-1 font-weight-medium">Great Logo Design</p>
                                        <small class="text-muted">+23 since last year</small>
                                    </div>
                                    <small class="text-muted ms-auto">10:49AM</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
        </div>
    </section>
@endsection
