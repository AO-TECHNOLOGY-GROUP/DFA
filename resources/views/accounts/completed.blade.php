@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Account Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Account</h4>
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
                            <h4 class="header-title mt-0 mb-1">Account Management</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($data))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                                <tr>
                                    <th>Account Name</th>
                                    <th>ID No.</th>
                                    <th>Type</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Date of Birth</th>
                                    <th>City</th>
                                    <th>Employer</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $account)
                                    <tr>
                                        <td>{{ ucwords($account->name) }}</td>
                                        <td>{{ ucwords($account->idNumber) }}</td>
                                        <td>{{ ucwords($account->accountType) }}</td>
                                        <td>{{ ucwords($account->nationality) }}</td>
                                        <td>{{ ucwords($account->gender) }}</td>
                                        <td>{{ ucwords($account->phoneNumber) }}</td>
                                        <td>{{ ucwords($account->email) }}</td>
                                        <td>{{ ucwords($account->tinNo) }}</td>
                                        {{-- <td>{!! status_label($account->isActive) !!}</td> --}}
                                        <td>{{ ucwords($account->dob) }}</td>
                                        <td>{{ ucwords($account->city) }}</td>
                                        <td>{{ ucwords($account->employer) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Account Name</th>
                                    <th>ID No.</th>

                                    <th>Type</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Date of Birth</th>
                                    <th>City</th>
                                    <th>Employer</th>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- {!! $data->links() !!} --}}
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-secondary container-fluid">
                                No records found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection
