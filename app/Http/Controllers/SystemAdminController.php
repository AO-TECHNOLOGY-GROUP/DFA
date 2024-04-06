<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use Illuminate\Http\Request;

class SystemAdminController extends Controller
{
    public function index()
    {
        $activeUserCount = User::where('status', 'active')->count();
        $inactiveUserCount = User::where('status', 'disabled')->count();
        $acc_success =  Account::where('is_active', 1)->count();
        $acc_pending =  Account::where('is_active', 0)->count();
        $acc_rejected =  Account::where('is_active', 3)->count();
        $acc_partiallyapproved =  Account::where('is_active', 4)->count();

        $data = [
            "username" => "esb",
            "password" => "esb@ao2021",
            "msgType" => "1200",
            "processingCode" => "900000"
        ];
        $post = json_encode($data);
        // $results = json_decode(curl($data));
        // dd($results);

        return view('dashboard', compact('activeUserCount', 'inactiveUserCount', 'acc_success', 'acc_pending', 'acc_rejected', 'acc_partiallyapproved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
