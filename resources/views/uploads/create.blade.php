@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Upload File</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">New Upload</h4>
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
                            <h4 class="header-title mt-0 mb-1">File Upload</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('uploads.index') }}" class="btn btn-sm btn-primary float-right"
                               rel="tooltip" data-placement="top"
                               title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back to Uploads</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('uploads.create') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row mb-3">
                                    <label for="name" class="col-2 col-form-label">Label</label>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="name" placeholder="Name"
                                               required value="{{ old('name') }}" name="name">
                                        <small class="text-muted">Leave blank to inherit the file name</small>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="" class="col-2 col-form-label"></label>
                                    <div class="alert alert-info col-10">
                                    <span
                                        style="font-weight: 100;">Excel sheet must have the following column headers:</span>
                                        <span class="d-block">First_Name,
                                              Last_Name, Phone_Number, ID_Number</span>

                                        <a class="text-white mt-2 d-block" href="{{route('sample-upload')}}"> <i
                                                class="fa fa-download"></i> Download Sample Excel</a>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="file" class="col-2 col-form-label">File</label>
                                    <div class="col-10">
                                        <input type="file" required class="form-control" id="file" placeholder="File">
                                    </div>
                                </div>
                                <br>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function () {
            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                var cleanNmae = fileName.substr(0, fileName.lastIndexOf('.'));

                var nameInput = $("#name").val();

                if (nameInput == '') {
                    $("#name").val(cleanNmae);
                }

            });
        });
    </script>

@endsection

