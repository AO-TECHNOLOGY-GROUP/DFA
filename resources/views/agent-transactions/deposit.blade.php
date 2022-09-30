@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Deposits</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Cash Deposits</h4>
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
                            <h4 class="header-title mt-0 mb-1">Make Cash Deposit</h4>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <h6 class="ml-2 text-info"><i>* Complete form below to make deposit</i></h6>
                        <div class="col-xl-10 mt-4 ml-2">
                            <form action="" method="post">
                                @csrf

                                <div class="form-group row mb-3">
                                    <label for="role" class="col-3 col-form-label">Agent Float Account</label>
                                    <div class="col-6">
                                        <select name="role" id="role" class="form-group custom-select" required>
{{--                                            @foreach($roles as $role)--}}
{{--                                                <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>--}}
{{--                                            @endforeach--}}
                                            <option value="56418651">56418651</option>
                                            <option value="56418457">56418457</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="customerNumber" class="col-3 col-form-label">Customer Number</label>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="customerNumber"
                                               placeholder="e.g. 538214"
                                               required name="customer_number">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="amount" class="col-3 col-form-label">Amount</label>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="amount"
                                               placeholder="20000"
                                               required name="amount">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mt-4 mb-2"><i class="uil uil-location-arrow"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
