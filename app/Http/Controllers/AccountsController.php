<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{ 
    public function getAccountsSuccessful(){

        $active = 1;

        $data = [
            "username"=>"esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "300000",
            "status"=>"$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));


        if($results->response == '000'){
            $data = $results->data;
            return view('accounts.completed', compact('data'));

        }

    }
    public function getAccountsPending()
    {

        $active = 0;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "300000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        // dd($post);
        $results = json_decode(curl($data));


        // dd($results);

        if ($results->response == '000') {
            $data = $results->data;
            return view('accounts.pending', compact('data'));
        }
    }

    public function getAccountsPartiallyApproved()
    {

        $active = 4;

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "300000",
            "status" => "$active"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));
        // dd($results);


        if ($results->response == '000') {
            $data = $results->data;
            return view('accounts.partially', compact('data'));
        }
    }


    public function ApproveRejectAccount(Request $request)
    {

        $name = $request->input('name');
        $account_number = $request->input('account_number');
        $phone_number = $request->input('phone_number');
        $status = $request->input('status');

        $data = [
            "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "305000",
            "status"=>"$status",
            "accountNumber"=>"$account_number",
            "phoneNumber"=>"$phone_number",
            "name"=>"$name"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));


        if ($results->response == '000') {

            flash('Account action success')->success();
            return redirect()->back();

        }else{
            flash('Account could not be saved. Try again')->error();
            return redirect()->back();
        }
    }

}
