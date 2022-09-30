@extends('layout.default')



@section('breadcrumb')
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/redmond/jquery-ui.css">
    {{-- <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="style.css"> --}}

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.js"></script>
    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript">
            $(function(){

        $( "#captureFingerprints" ).on('show', function(){
            alert("Show!");
        });
        $( "#captureFingerprints" ).on('shown', function(){
            alert("Shown!");
        });

        });


    </script>
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
                    {{-- <a href="#captureFingerprints" data-toggle="modal" class="btn code-dialog">Display code</a> --}}
                    @if (count($data))
                        <table class="table-hover table m-0 align-items-center" width="100%">
                            <thead>
                                <tr>
                                    <th>Account Name</th>
                                    <th>ID No.</th>
                                    <th>Type</th>
                                    <th>Nationality</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    <th>City</th>
                                    <th>Employer</th>
                                    <th>More Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $account)
                                    <tr>
                                        <td>{{ ucwords($account->name) }}</td>
                                        <td>{{ ucwords($account->idNumber) }}</td>
                                        <td>{{ ucwords($account->accountType) }}</td>
                                        <td>{{ ucwords($account->nationality) }}</td>
                                        <td>{{ ucwords($account->phoneNumber) }}</td>
                                        <td>{{ ucwords($account->email) }}</td>
                                        <td>{{ ucwords($account->tinNo) }}</td>
                                        <td>{{ ucwords($account->city) }}</td>
                                        <td>{{ ucwords($account->employer) }}</td>
                                        <td>
                                            <form action="{{ route('loan.loan-details') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="id_number" value="{{ $account->idNumber }}"/>
                                                <button type="submit" class="btn btn-link btn-sm">View</button>
                                            </form>
                                        </td>
                                        <td>
                                        <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button href="#captureFingerprints" data-toggle="modal" class="btn code-dialog dropdown-item text-primary">Complete Process</button>
                                                    <form action="{{ route('account.action-accounts') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="name" value="{{ $account->name }}"/>
                                                        <input type="hidden" name="account_number" value="{{ $account->accontNumber }}"/>
                                                        <input type="hidden" name="phone_number" value="{{ $account->phoneNumber }}"/>
                                                        <input type="hidden" name="status" value="4"/>
                                                    <button  type="submit" class="btn code-dialog dropdown-item text-success">Approve Account</button>
                                                    </form>
                                                    <form action="{{ route('account.action-accounts') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="name" value="{{ $account->name }}"/>
                                                        <input type="hidden" name="account_number" value="{{ $account->accontNumber }}"/>
                                                        <input type="hidden" name="phone_number" value="{{ $account->phoneNumber }}"/>
                                                        <input type="hidden" name="status" value="3"/>
                                                    <button  type="submit" class="btn code-dialog dropdown-item text-danger">Reject Account</button>
                                                    </form>

                                                </div>


                                        </div>
                                         <td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Account Name</th>
                                    <th>ID No.</th>
                                    <th>Type</th>
                                    <th>Nationality</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Tax pin</th>
                                    <th>City</th>
                                    <th>Employer</th>
                                    <th>More Details</th>
                                    <th>Action</th>
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
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LLITTLE', '5')">Left Little</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LRING', '4')">Left Ring</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LMIDDLE', '3')">Left Middle</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LINDEX', '2')">Left Index</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.LTHUMB', '1')">Left Thumb</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RTHUMB', '6')">Right Thumb</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RINDEX', '7')">Right Index</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RMIDDLE', '8')">Right Middle</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RRING', '9')">Right Ring</button>
                                <button type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="captureFingerprint(event, 'V.RLITTLE', '10')">Right Little</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
                            Go Back
                        </button>
                        <button type="button" id="fingerprintsubmit" class="btn btn-success" aria-hidden="true"
                            onclick="registerAllFingerprints()">
                            <i class="uil uil-check"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>


    @endsection

    @section('script')



    <script type="text/javascript">
            // function displayForm() {

            //     $("#captureFingerprints").modal('toggle');
            // }
            $('#completeProcess').click(function(){

            $("#captureFingerprints").modal('toggle');
            });

            function registerAllFingerprints() {
                var form = $("#userCreation");
                form.submit();

            }

            function captureFingerprint(event, finger, id) {
                var domElement = $(event.target);
                console.log(domElement);
                var phone = $('#phoneNumber').val();
                var email = $('#email3').val();


                let data = {
                    username: "esb",
                    password: "esb@payk0nn1",
                    msgType: "1200",
                    processingCode: "920000",
                    transactionType: "BUR",
                    tranId: "-179797715700020210203103812.844",
                    userId: phone,
                    fingerCode: id,
                    fingerDescription: finger,
                    clientIp: "127.0.0.1",
                    timestamp: "20210203103812.844",
                    channel: "BIOMETRIC",
                    description1: "USER REG",
                    description2: "USER REG",
                    description3: "USER REG",
                    currentUser: email,
                    cif: phone
                };
                let post = JSON.stringify(data);
                const url = "http://127.0.0.1:8190/channelinterface/req";
                let xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(post)

                xhr.onload = function() {
                    console.log(xhr.responseText);
                    let response = JSON.parse(xhr.responseText);
                    if (response.response == "000" || response.response == "007") {
                        domElement.prop('disabled', true);
                    } else {
                        $('#'  id).html('<i class="uil uil-close"></i> Failed');
                    }
                }

            }
        </script>

@endsection
