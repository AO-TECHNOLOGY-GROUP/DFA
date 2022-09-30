@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">RM Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">RM</h4>
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
                            <h4 class="header-title mt-0 mb-1">RM Management</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('create_users')
                                <a href="{{ route('users.create-rms') }}"
                                    class="btn btn-sm btn-soft-primary float-right  mr-2" data-toggle="tooltip"
                                    data-placement="top" title="Add User">
                                    <i class="uil uil-plus"> Add RM</i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($results->agents))
                        <table class="table-hover table m-0 align-items-center table-flush" width="80%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>ID</th>
                                    <th>Role</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Date Created</th>
                                    <th>Maker</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results->agents as $user)
                                    <tr>
                                        {{-- {{ dd($user) }} --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($user->firstName . ' ' . $user->lastName) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phoneNumber }}</td>
                                        <td>{{ $user->idNumber }}</td>
                                        <td>Relationship Manager</td>
                                        {{-- <td>{!! status_label($user->status) !!}</td> --}}
                                        <td>{{ $user->createdAt }}</td>
                                        <td>
                                            {{ $user->createdBy }}
                                            <small class="d-block"></small>
                                        </td>

                                        <td>
                                            <small class="d-block"></small>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <form method="POST" action="{{ route('users.reset-pass-rms') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->email }}" name="email" />
                                                        <button class="dropdown-item" type="submit">Reset Password</button>
                                                    </form>
                                                    <form method="POST" action="{{ route('users.reset-device') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}" name="agent_id" />
                                                    <button class="dropdown-item" type="submit">Reset Device</button>
                                                    </form>
                                                      <form method="POST" action="{{ route('users.action-on-device') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}" name="agent_id" />
                                                        <input type="hidden" value="1" name="status" />
                                                    <button class="dropdown-item" type="submit">Activate Device</button>
                                                    </form>
                                                      <form method="POST" action="{{ route('users.action-on-device') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}" name="agent_id" />
                                                         <input type="hidden" value="0" name="status" />
                                                    <button class="dropdown-item" type="submit">Deactivate Device</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>ID</th>
                                    <th>Role</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Date Created</th>
                                    <th>Maker</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        {{-- {!! $$results->agents->links() !!} --}}
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
@endsection

@section('script')
    <div class="modal fade modal-success" id="captureFingerprints" role="dialog" aria-label="Fingerprint collection"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-confirm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Make sure to capture all 10 fingerprints, each button for each finger</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LLITTLE', '5')">Left Little</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LRING', '4')">Left Ring</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LMIDDLE', '3')">Left Middle</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LINDEX', '2')">Left Index</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LTHUMB', '1')">Left Thumb</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RTHUMB', '6')">Right Thumb</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RINDEX', '7')">Right Index</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RMIDDLE', '8')">Right Middle</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RRING', '9')">Right Ring</button>
                                <button type="button" class="btn btn-primary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RLITTLE', '10')">Right Little</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                            Cancel
                        </button>
                        <button type="button" id="fingerprintsubmit" class="btn btn-success" aria-hidden="true"
                            onclick="registerAllFingerprints()">
                            <i class="uil uil-check"></i>
                            Approve
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')

    @endsection
