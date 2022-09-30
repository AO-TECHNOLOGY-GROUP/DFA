@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Admin Tempalte</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">File Upload</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Uploads</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">File Upload</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('perform_uploads')
                                <a href="{{ route('uploads.create') }}" class="btn btn-sm btn-soft-primary float-right"
                                   data-toggle="tooltip" data-placement="top"
                                   title="Upload file">
                                    <i class="uil uil-file-upload"> New Upload</i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($uploads))
                        <table class="table-hover table m-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Stage</th>
                                <th>Total Records</th>
                                <th>Maker</th>
                                <th>Uploaded</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($uploads as $upload)
                                <tr>
                                    <td>
                                        <strong>{{ $upload->name }}</strong>
                                        <span class="d-block text-muted">{{ $upload->type }}</span>
                                    </td>
                                    <td>{{ formatSizeUnits($upload->size) }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Stage</th>
                                <th>Total Records</th>
                                <th>Maker</th>
                                <th>Uploaded</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $upload->links() !!}
                    @else
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-info container-fluid">
                                    No records found
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
