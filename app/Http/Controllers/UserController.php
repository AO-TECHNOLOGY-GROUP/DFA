<?php

namespace App\Http\Controllers;

use App\Mail\userSignUpMail;
use App\Role;
use App\User;
use App\verificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::paginate();
        trail('View user', 'User listing');
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $this->permitted_roles();
        return view('users.create', compact('roles'));
    }

    public function permitted_roles()
    {
        if (user()->role === 'super-admin') {
            $roles = Role::all();
        } else {
            $roles = Role::where('role_name', '!=', 'super-admin')->get();
        }

        return $roles;
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|exists:roles,name'
        ]);

        $fname = $request->get('first_name');
        $lname = $request->get('last_name');
        $email = $request->get('email');
        $phone = $request->get('phone_number');

        $user = user();

        $user = User::create([
            'first_name' => $fname,
            'last_name' => $lname,
            'email' => $email,
            'phone_number' => $phone,
            'creator_id' => $user->id,
            'verifier_id' => $user->id,
            'password' => uniqid()
        ]);

        $roles = $request->input('role') ? $request->input('role') : [];
        $user->assignRole($roles);

        $code = Str::random(60) . uuid();

        VerificationCode::create([
            'code' => $code,
            'user_id' => $user->id,
            'expires_at' => Carbon::now()->addHours(config('admintemplate.new_user_token_validity'))->toDateTimeString(),
            'intent' => 'account creation'
        ]);

        Mail::to($email, $user->name)->send(new userSignUpMail($user, $code));

        flash()->info("An activation link has been sent to the email address - $email");
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        trail('Edit user', 'Initiate user edit');
        $roles = $this->permitted_roles();

        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required|exists:roles,name'
        ]);

        trail('Update user', 'User update');

        $email = $request->get('email');
        $confirmEmail = User::where('email', $email)->where('uuid', '!=', $user->uuid)->count();

        if ($confirmEmail) {
            flash()->info($email . ' belongs to another user');
            return redirect()->back();
        }

        $role = $request->get('role');
        $roles = $this->permitted_roles()->pluck('name')->toArray();

        if (!in_array($role, $roles)) {
            flash()->info('Permission denied');
            return redirect()->route('logout');
        }

        $user->update([
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'status' => $request->get('status')
        ]);

        $user->syncRoles([$role]);

        flash('User updated successfully')->important();
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('show_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('users.show', compact('user'));
    }

    public function logs(User $user)
    {
        abort_if(Gate::denies('manage_users'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sheets = new SheetCollection([
            'ActivityLog' => $this->auditGenerator($user),
        ]);

        $name = $user->first_name . ' '. $user->last_name . ' - Activity-Log-As-At' . now()->format('M j, Y g:i A');;
        return (new FastExcel($sheets))->download($name . '.xlsx');

    }

    function auditGenerator($user)
    {
        foreach (Activity::where(function ($q) use ($user) {
            $q->where('subject_id', '!=', $user->id)->where('subject_type', '!=', 'App\User')->orWhere('log_name', '!=', 'default');
        })->where('causer_id', $user->id)->where('causer_type', get_class($user))->select('description as Activity', 'subject_type as Subject', 'subject_id as SubjectID', 'created_at as Timestamp')->latest()->cursor() as $user) {
            yield $user;
        }
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        flash('User deleted successfully (soft deleted).')->important();
        return redirect()->route('users.index');
    }

    public function createRMs(){

        return view('users.create-rms');
    }

    public function SubmitRMs(Request $request){

        $firstname = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $id_number = $request->input('id_number');

        $user_id = Auth::user()->id;

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'id_number' => 'required'
        ]);

        $data = [
            "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "100000",
            "createdBy"=> "$user_id",
            "firstName"=> $firstname,
            "middleName" => $middle_name,
            "lastName"=> $last_name,
            "email"=> $email,
            "phoneNumber"=> $phone_number,
            "idNumber"=> $id_number,
            "channel"=> "web"
        ];
        $post = json_encode($data);
        $result = json_decode(curl($data));

        if($result->response == '000'){



            //send sms


            flash('Account creation success')->success();
            return redirect()->route('users.fetch-rms');
        }else{
            flash('Error occured! Try again later.')->error();
              return redirect()->back();
        }

    }

    public function fetchRMs(){

        // endpoint_url

        $data = [
        "username"=> "esb",
        "password"=> "esb@ao2021",
        "msgType"=> "1200",
        "processingCode"=> "105000"
        ];
        $post = json_encode($data);
        $results = json_decode(curl($data));

        return view('users.rms', compact('results'));

    }

    public function resetPasswordRMS(Request $request){
        // dd($request->all());

        $email = $request->get('email');

        $data = [
           "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "110500",
            "dfaChannel"=> "web",
            "email" =>"$email"
        ];
        $post = json_encode($data);

        $results = json_decode(curl($data));

        if($results->response == '000'){
            flash('Success! ')->success();
            return redirect()->back();

        }else{
            flash('Error occured! Try again later.')->error();
            return redirect()->back();

        }

    }

    public function resetDeviceRMS(Request $request)
    {

        $agent_id = $request->get('agent_id');

        $data = [
            "username" => "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "910000",
            "agentId"=>"$agent_id"
        ];
        $post = json_encode($data);

        // dd($post);
        $results = json_decode(curl($data));

        if ($results->response == '000') {
            flash('Success! Device reset ')->success();
            return redirect()->back();
        } else {
            flash('Unable to reset device. Contact System Administrator')->error();
            return redirect()->back();
        }
    }

    public function actionDevice(Request $request)
    {

        $agent_id = $request->get('agent_id');
        $status = $request->get('status');

        $data = [
            "username"=> "esb",
            "password"=> "esb@ao2021",
            "msgType"=> "1200",
            "processingCode"=> "920000",
            "status"=> "$status",
            "agentId"=> "$agent_id"
        ];
        $post = json_encode($data);

        $results = json_decode(curl($data));

        if ($results->response == '000') {
            flash('Success! Action recorded successfully')->success();
            return redirect()->back();
        } else {
            flash('Unable to either Activate/Deactivate Device')->error();
            return redirect()->back();
        }
    }


}
