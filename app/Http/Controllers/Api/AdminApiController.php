<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Mail\UserCreatedMailable;
use App\Models\Admin;
use App\Traits\PassWordGenerator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminApiController extends Controller
{
    public function createAdmin(Request $request){

        $enabled = false;
        if($request->enabled == "true" || $request->enabled == 1) {
            $enabled = true;
        }

        $path = null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images/users', 's3');
            Storage::disk('s3')->setVisibility('images/users', 'public');
        }

        $password = PassWordGenerator::generatePassword();
        $admin_object = new Admin();
        $admin_created = $admin_object->create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'national_id' => $request->get('national_id'),
            'date_of_birth' => $request->get('date_of_birth'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'profile_image' => $path,
            'role' => $request->get('role'),
            'password' => bcrypt($password),
            'enabled' => $enabled,
        ]);

        if ($admin_created){

            $log_controller = new LogController();
            $log_controller->adminCreateLog($request->causer_id, $admin_created->id, $admin_created->first_name);

            $email = $request->get('email');
            Mail::to($email)->send(new UserCreatedMailable($password, $email));

            return response()->json([
                'status'=>'success',
                'message'=>'Admin created successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to add record']);
        }

    }

    public function getAllAdmins(){

        return response()->json(
            Admin::query()->orderBy('name')
                ->where('deleted_at', null)
                ->get()
        );
    }

    public function getRecentAdmins()
    {
        return response()->json(
            Admin::query()
                ->where('deleted_at', null)
                ->latest()
                ->limit(10)
                ->get());
    }

    public function updateAdmin(Request $request){

        $enabled = false;
        if($request->enabled == "true" || $request->enabled == 1) {
            $enabled = true;
        }

        $path = null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images/users', 's3');
            Storage::disk('s3')->setVisibility('images/users', 'public');
        }

        $admin_id = $request->id;

        $update = Admin::query()->where('id', $admin_id)->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'national_id' => $request->get('national_id'),
            'date_of_birth' => $request->get('date_of_birth'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
            'profile_image' => $path,
            'role' => $request->get('role'),
            'enabled' => $enabled,
        ]);

        if($update){

            $admin = DB::table('admins')
                ->where('id', $request->id)
                ->first();

            // TODO Log admin update
            $log_controller = new LogController();
            $log_controller->adminEditLog($request->causer_id, $admin->id, $admin->first_name);


            return response()->json([
                'status'=>'success',
                'message'=>'Admin updated successfully'
            ]);
        }
        else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to update Admin'
            ]);
        }

    }

    public function getAdminDetails(Request $request){

        return response()->json(
            Admin::query()->where('id', $request->id)->first()
        );
    }

    public function deleteAdmin(Request $request){

        $admin_id = $request->id;
        $admin =  Admin::query()->where('id', $admin_id)->delete();

        if ($admin){

            $admin_del = DB::table('admins')
                ->where('id', $request->id)
                ->first();

            // TODO Log admin delete
            $log_controller = new LogController();
            $log_controller->adminDeleteLog($request->causer_id, $admin_del->id, $admin_del->first_name);

            return response()->json([
                'status'=>'success',
                'message'=>'Admin deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to delete Admin '
            ]);
        }
    }

    public function searchAdmin(Request $request)
    {
        $created_date = $request->created_date;
        $custom_date = $request->custom_date;
        $custom_start_date = $request->custom_start_date;
        $custom_end_date = $request->custom_end_date;
        $search_name = $request->search_name;
        $search_email = $request->search_email;
        $search_role = $request->search_role;
        $search_status = $request->search_status;

        $admin = Admin::query();

        if($created_date != 'all'){

            if($created_date == 'today'){

                $admin->whereDate('created_at', Carbon::today());

            }elseif($created_date == 'current_week'){

                $admin->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

            }elseif($created_date == 'last_week'){

                $previous_week = strtotime("-1 week +1 day");
                $start_week = strtotime("last sunday midnight", $previous_week);
                $end_week = strtotime("next saturday",$start_week);
                $start_week = date("Y-m-d", $start_week);
                $end_week = date("Y-m-d", $end_week);
                $admin->whereBetween('created_at', [$start_week, $end_week]);

            }elseif($created_date == 'current_month'){

                $admin->whereMonth('created_at', Carbon::now()->month);

            }elseif($created_date == 'current_year'){

                $admin->whereYear('created_at', Carbon::now()->year);

            }elseif($created_date == 'custom_date'){

                $custom_date = date("Y-m-d",strtotime($custom_date));
                $admin->whereDate('created_at', '=', $custom_date);

            }elseif($created_date == 'custom_range'){

                $start_date = date("Y-m-d",strtotime($custom_start_date));
                $end_date = date("Y-m-d",strtotime($custom_end_date));
                $admin->whereBetween('created_at', [$start_date, $end_date]);
            }

        }
        if($search_name != ''){
            $admin->where('first_name', 'LIKE', '%'.$search_name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search_name.'%');
        }
        if($search_email != ''){
            $admin->where('email', 'LIKE', '%'.$search_email.'%');
        }

        if($search_role != 'all'){
            $admin->where('role', 'LIKE', '%'.$search_role.'%');
        }

        if($search_status != 'all'){
            $admin->where('enabled', 'LIKE', '%'.$search_status.'%');
        }

        $admin = $admin->where('deleted_at', null)->get();
        return response()->json($admin);
    }

    public function changePassword(Request $request){

        $admin =  DB::table('admins')
            ->where('id', $request->admin_id)
            ->first();

        if($admin) {

            if (Hash::check($request->current_password, $admin->password)) {

                $update = DB::table('admins')
                    ->where('id', $request->admin_id)
                    ->update([
                        'password' => bcrypt($request->new_password),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                if($update) {

                    $json_array = array(
                        'success' => 1,
                    );

                    $response = $json_array;
                    return json_encode($response);

                } else {

                    $json_array = array(
                        'success' => 0,
                    );

                    $response = $json_array;
                    return json_encode($response);
                }

            }else{

                $json_array = array(
                    'success' => 0,
                    'message' => 'Wrong password entered',
                );

                $response = $json_array;
                return json_encode($response);
            }

        }


    }

    public function resetPassword(Request $request){

        $password_generator = new StringGeneratorUtil();
        $password = $password_generator->generatePassword();

        $update = DB::table('admins')
            ->where('id', $request->id)
            ->update([
                'password' => bcrypt($password),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        if($update) {

            $admin =  DB::table('admins')
                ->where('id', $request->id)
                ->first();

            $sms_message = "Hi $admin->first_name !, Your password has been reset. We have sent a login credentials to your email";
            $sms_util = new SMSUtil();
            $sms_util->sendSMS($admin->phone_number, $sms_message);

            return response()->json([
                'status'=>'success',
                'message'=>'Password has been reset',
            ]);

        } else {

            return response()->json([
                'status'=>'error',
                'message'=>'Failed to reset password',
            ]);
        }

    }
}
