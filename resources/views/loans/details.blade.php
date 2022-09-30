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
            <h4 class="mb-1 mt-0">Loan Application Details</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')

    <main class="container">
        <section class="py-4 mt-2">
            <div class="row">
                <div class="col-md-12">
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab"
                                class="nav-link small text-uppercase active">Account Details</a></li>
                        <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab"
                                class="nav-link small text-uppercase">Fingerprints</a></li>
                    </ul>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="profile1" class="tab-pane fade active show" style="overflow:scroll; height:400px;">
                            <div class="row pb-2">
                                <div class="col-md-8">
                                    <table class="table table-sm table-hover table-striped h6">
                                         <thead>
                                                <tr>
                                                <th scope="col">Customer Names </th>
                                                <th scope="col">{{ $results->data[0]->name }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">Employer</th>
                                                <td>{{ $results->data[0]->employer }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">ID</th>
                                                <td>{{ $results->data[0]->idNumber }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Account Type</th>
                                                <td>{{ strtoupper($results->data[0]->accountType) }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Account No</th>
                                                <td>{{ $results->data[0]->accontNumber }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Date of Birth</th>
                                                <td>{{ $results->data[0]->dob }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Email</th>
                                                <td>{{ $results->data[0]->email }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Nationality</th>
                                                <td>{{ strtoupper($results->data[0]->nationality) }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">City</th>
                                                <td>{{ strtoupper($results->data[0]->city) }}</td>
                                                </tr>
                                                 <tr>
                                                <th scope="row">Gender</th>
                                                <td>{{ $results->data[0]->gender }}</td>
                                                </tr>
                                                <th scope="row">Physical Address</th>
                                                <td>{{ strtoupper($results->data[0]->physicalAddress) }}</td>
                                                </tr>
                                                <th scope="row">Phone Number</th>
                                                <td>{{ $results->data[0]->phoneNumber }}</td>
                                                </tr>
                                                <th scope="row">Tax PIN</th>
                                                <td>{{ strtoupper($results->data[0]->tinNo) }}</td>
                                                </tr>
                                                <th scope="row">Customer Status</th>
                                                @if ($results->data[0]->customerStatus == '0' )
                                                    <td>Inactive</td>
                                                @else
                                                 <td>Active</td>

                                                @endif
                                                </tr>
                                                <th scope="row">Date Registered</th>
                                                <td>{{  \Carbon\Carbon::parse($results->data[0]->createdAt)->format('d-m-Y / h:i:s A') }}</td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div id="messages1" class="tab-pane fade" style="overflow:scroll; height:400px;">
                            {{-- <div class="list-group"> --}}
                                @foreach ( $results->templates as $fin )
                                 <div class="card-body">
                                    <img src="https://static4.depositphotos.com/1017903/325/i/600/depositphotos_3253328-stock-photo-black-and-white-fingerprint.jpg" style="height: 250px; width:150px" />

                                </div>
                            {{-- <a href="" class="list-group-item d-inline-block text-muted"> <img src="{{ $fin->fingerImage  }}"</a> --}}

                                @endforeach

                                {{-- {{ dd($results)  }} --}}


                                {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
        </section>
        <hr>
        <br>
    </main>

    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection
