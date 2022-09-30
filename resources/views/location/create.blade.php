@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Locations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Location Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Create Location</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">New Location</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('location.index') }}" class="btn btn-sm btn-soft-primary float-right">
                                <i class="uil uil-arrow-left"> Back to Location</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('location.create') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="locationName" class="col-3 col-form-label">Location Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="locationName" placeholder="nairobi"
                                               required value="{{ old('name') }}" name="name">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="longitude" class="col-3 col-form-label">Longitude</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="longitude" placeholder=""
                                               required value="{{ old('longitude') }}" name="longitude">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="latitude" class="col-3 col-form-label">Latitude</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="longitude" placeholder=""
                                               required value="{{ old('latitude') }}" name="latitude">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="address" class="col-3 col-form-label">Address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="address" placeholder="6548-00200"
                                               required value="{{ old('address') }}" name="address">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
