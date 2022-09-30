@extends('layout.default')
<style>
    .contentText {
        font-size: 12px !important;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Loan Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Loans</h4>
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
                            <h4 class="header-title mt-0 mb-1">Loan Management</h4>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    @if (count($data))
                        <table class="table-hover table m-0 align-items-center table-flush table-sm table-small-font" width="100%">
                            <thead>
                                <tr class="contentText">
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>ID</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    <th>DOB</th>
                                    <th>Duration</th>
                                    <th>Interest</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Occupation</th>
                                    <th>City</th>
                                    <th>Employer</th>
                                    <th>Date Applied</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $loan)
                                    <tr class="contentText">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($loan->name) }}</td>
                                        <td>{{ ucwords($loan->idNumber) }}</td>
                                        <td>{{ ucwords($loan->nationality) }}</td>
                                        <td>{{ ucwords($loan->gender) }}</td>
                                        <td>{{ ucwords($loan->phoneNumber) }}</td>
                                        <td>{{ ucwords($loan->email) }}</td>
                                        <td>{{ ucwords($loan->tinNo) }}</td>
                                        <td>{{ ucwords($loan->dob) }}</td>
                                        <td>{{ ucwords($loan->duration) }}</td>
                                        <td>{{ ucwords($loan->interest) }}</td>
                                        <td>{{ ucwords($loan->amount) }}</td>
                                        <td>{{ ucwords($loan->type) }}</td>
                                        <td>{{ ucwords($loan->occupation) }}</td>
                                        <td>{{ ucwords($loan->city) }}</td>
                                        <td>{{ ucwords($loan->employer) }}</td>
                                        <td>{{ ucwords($loan->createdAt) }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                 <tr class="contentText">
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>ID</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    <th>DOB</th>
                                    <th>Duration</th>
                                    <th>Interest</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Occupation</th>
                                    <th>City</th>
                                    <th>Employer</th>
                                    <th>Date Applied</th>


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
