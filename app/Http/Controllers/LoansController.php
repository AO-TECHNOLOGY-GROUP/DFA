<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function getloansPending()
    {

        $active = 0;

        $data = [
            "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "260000",
            "status"=>"$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));


        if ($results->response == '000') {
            $data = $results->data;
            return view('loans.new', compact('data'));
        }
    }
    public function getPaidLoans()
    {

        $active = 2;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "260000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            $data = $results->data;
            return view('loans.paid', compact('data'));
        }
    }

    public function getRejectedLoans()
    {

        $active = 3;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "260000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            $data = $results->data;
            return view('loans.rejected', compact('data'));
        }
    }


    public function getActiveLoans()
    {

        $active = 1;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "260000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            $data = $results->data;
            return view('loans.active', compact('data'));
        }
    }


    public function ActionLoan(Request $request)
    {

        $name = $request->input('name');
        $loan_id = $request->input('loan_id');
        $phone_number = $request->input('phone_number');
        $status = $request->input('status');

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "265000",
            "status" => "$status",
            "loanId" => "$loan_id",
            "phoneNumber" => "$phone_number",
            "name" => "$name"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            flash('Loan action success')->success();
            return redirect()->back();
        } else {
            flash('Loan could not be saved. Try again')->error();
            return redirect()->back();
        }
    }

    public function getLoanDetails(Request $request)
    {
        $id_number = $request->input('id_number');

        $data = [
            "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "140000",
            "idNumber"=> "$id_number"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        $msg = $results->responseDescription;
        if ($results->response == '000') {
            return view('loans.details', compact('results'));
        }else{
            flash($msg)->error();
            return redirect()->back();
        }
    }

    public function getPartiallyLoans()
    {

        $active = 4;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "260000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            $data = $results->data;
            return view('loans.partially-approved', compact('data'));
        }
    }



}
