@extends('layouts.non-auth')


@section('css')
@endsection

@section('content')
<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-8">
                <div class="text-center">

                    <div>
                        <img src="/assets/images/maintenance.svg" alt="" class="img-fluid" />
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <h4 class="mt-5">We are currently performing maintenance</h4>
                <p class="text-muted">We're making the system more awesome. <br /> We'll be back shortly.</p>
            </div>
        </div>

        <div class="row pt-5">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm rounded-circle bg-soft-primary mr-4">
                                <i class="uil-presentation-lines-alt font-size-20 avatar-title text-primary"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="font-size-16  mt-0">Why is the Site Down?</h5>
                                <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting
                                    language is more simple.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm rounded-circle bg-soft-primary mr-4">
                                <i class="uil-clock-eight font-size-20 avatar-title text-primary"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="font-size-16  mt-0">What is the Downtime?</h5>
                                <p class="text-muted mb-0">Everyone realizes why a new common language would be
                                    desirable one could refuse.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="avatar-sm rounded-circle bg-soft-primary mr-4">
                                <i class="uil-envelope font-size-20 avatar-title text-primary"></i>
                            </div>
                            <div class="media-body">
                                <h5 class="font-size-16  mt-0">Do you need Support?</h5>
                                <p class="text-muted mb-0">You need to be sure there isn't anything embar.. <a
                                        href="mailto:#" class="text-muted font-weight-semibold">no-reply@domain.com</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end account-pages -->
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection