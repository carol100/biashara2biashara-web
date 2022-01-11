<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Util\SMSUtil;
use App\Http\Controllers\Util\StringGeneratorUtil;
use App\Mail\UserCreatedMailable;
use App\Mail\VerificationCode;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserApiController extends Controller
{
    public function getAllUsers()
    {
        return response()->json(
            User::query()
                ->where('deleted_at', null)
                ->get());
    }

    public function getRecentUsers(Request $request)
    {

        $users = User::query()
            ->where('deleted_at', null)
            ->latest()
            ->limit(10)
            ->get();

        $results = array();
        foreach ($users as $user){

            $payment_method_name = "";

            $payment_method = PaymentMethod::query()
                ->where('id', $user->payment_method)
                ->first();

            if ($payment_method){
                $payment_method_name = $payment_method->payment_method_name;
            }

            array_push($results,
                array(

                    'payment_method' => $user->payment_method,
                    'payment_method_name' => $payment_method_name,
                    'created_at' => date('Y-m-d h:i:s', strtotime($user->created_at)),
                    'updated_at' => $user->updated_at,
                    'deleted_at' => $user->deleted_at,
                ));
        }

        return json_encode($users);
    }

    public function getUserDetails(Request $request)
    {
        return response()->json(
            User::query()->where('id', $request->id)->first()
        );
    }

    public function searchUsers(Request $request)
    {
        $search = $request->get('search');
        $user = User::query()
            ->where('username', 'like', $search . '%')
            ->where('deleted_at', null)
            ->get();

        return response()->json($user);


    }

    public function createUser(Request $request)
    {

        $string_generator = new StringGeneratorUtil();
        $verification_code = $string_generator->generateCode();
        $password = "password";


        $enabled = true;
        if($request->enabled == "false" || $request->enabled == 0) {
            $enabled = false;
        }

        $is_company = false;
        if($request->is_company == "true" || $request->is_company == 1) {
            $is_company = true;
        }

        $social_media_handles = false;
        if($request->social_media_handles == "true" || $request->social_media_handles == 1) {
            $social_media_handles = true;
        }

        $is_registered = false;
        if($request->is_registered == "true" || $request->is_registered == 1) {
            $is_registered = true;
        }

        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('users/images','s3');
            Storage::disk('s3')->setVisibility('users/images','public');
        }

        $file_path = null;
        if($request->hasFile('registration_file')){
            $file_path = $request->file('registration_file')->store('users/files','s3');
            Storage::disk('s3')->setVisibility('users/files','public');
        }


        $email = $request->get('email');
        $user = User::query()->create([
            'is_company' => $is_company,
            'company_name' => $request->get('company_name'),
            'first_name' => $request->get('first_name'),
            'middle_name' => $request->get('middle_name'),
            'last_name' => $request->get('last_name'),
            'phone_number' => $request->get('phone_number'),
            'physical_address' =>  $request->get('physical_address'),
            'email' => $email,
            'website' => $request->get('website'),
            'social_media_handles' => $social_media_handles,
            'facebook' => $request->get('facebook'),
            'instagram' => $request->get('instagram'),
            'twitter' => $request->get('twitter'),
            'other' => $request->get('other'),
            'business_type' => $request->get('business_type'),
            'description' => $request->get('description'),
            'image' => $path,
            'is_registered' => $is_registered,
            'registration_date' => $request->get('registration_date'),
            'registration_file' => $file_path,
            'item_type' => $request->get('item_type'),
            'item_description' => $request->get('item_description'),
            'rating' => $request->get('rating'),
            'notes' => $request->get('notes'),
            'password' => bcrypt($request->get('password')),
            'enabled' => $enabled,
            'verification_code' =>$verification_code,

        ]);

        if ($user) {

//            $log_controller = new LogController();
//            $log_controller->userCreateLog($request->causer_id, $user->id, $user->username);
//
//            $email = $request->get('email');
//            Mail::to($email)->send(new UserCreatedMailable($password, $email));

            return response()->json([
                'status' => 'success',
                'message' => 'Record added successfully'
            ]);

        } else {

            return response()->json([
                'status' => 'error',
                'message' => 'failed to add record'
            ]);
        }

    }

    public function updateUser(Request $request)
    {
        $user_id = $request->id;
        $phone_number = $request->phone_number;
        $phone_number_check = DB::table('users')
            ->where('phone_number', $phone_number)
            ->first();

        if ($phone_number_check) {

            if($phone_number_check->id != $user_id){

                $json_array = array(
                    'status'=>'error',
                    'message' => "Phone number already exist",
                );

                $response = $json_array;
                return json_encode($response);
            }

        }

        //Check if email exists
        if ($request->email != '') {
            $email_check = DB::table('users')->where('email', $request->email)->first();
            if ($email_check) {

                if($email_check->id != $user_id){

                    $json_array = array(
                        'status'=>'error',
                        'message' => "Email address already exist",
                    );

                    $response = $json_array;
                    return json_encode($response);
                }

            }
        }

        $enabled = true;
        if($request->enabled == "false" || $request->enabled == 0) {
            $enabled = false;
        }

        $is_company = false;
        if($request->is_company == "true" || $request->is_company == 1) {
            $is_company = true;
        }

        $social_media_handles = false;
        if($request->social_media_handles == "true" || $request->social_media_handles == 1) {
            $social_media_handles = true;
        }

        $is_registered = false;
        if($request->is_registered == "true" || $request->is_registered == 1) {
            $is_registered = true;
        }

        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('users/images','s3');
            Storage::disk('s3')->setVisibility('users/images','public');
        }

        $file_path = null;
        if($request->hasFile('registration_file')){
            $file_path = $request->file('registration_file')->store('users/files','s3');
            Storage::disk('s3')->setVisibility('users/files','public');
        }


        $update = User::query()
            ->where('id', $request->id)
            ->update([
                'is_company' => $is_company,
                'company_name' => $request->get('company_name'),
                'first_name' => $request->get('first_name'),
                'middle_name' => $request->get('middle_name'),
                'last_name' => $request->get('last_name'),
                'phone_number' => $request->get('phone_number'),
                'physical_address' =>  $request->get('physical_address'),
                'email' =>  $request->get('email'),
                'website' => $request->get('website'),
                'social_media_handles' => $social_media_handles,
                'facebook' => $request->get('facebook'),
                'instagram' => $request->get('instagram'),
                'twitter' => $request->get('twitter'),
                'other' => $request->get('other'),
                'business_type' => $request->get('business_type'),
                'description' => $request->get('description'),
                'image' => $path,
                'is_registered' => $is_registered,
                'registration_date' => $request->get('registration_date'),
                'registration_file' => $file_path,
                'item_type' => $request->get('item_type'),
                'item_description' => $request->get('item_description'),
                'rating' => $request->get('rating'),
                'notes' => $request->get('notes'),
                'enabled' => $enabled,


            ]);

        if($update){

            $user = DB::table('users')
                ->where('id', $request->id)
                ->first();

            // TODO Log user update
            $log_controller = new LogController();
            $log_controller->userEditLog($request->causer_id, $user->id, $user->username);

            return response()->json([
                'status'=>'success',
                'message'=>'Record has been updated',
            ]);

        }else{

            return response()->json([
                'status'=>'error',
                'message'=>'Failed to update record',
            ]);
        }
    }

    public function deleteUser(Request $request)
    {
        $user = User::query()
            ->where('id', $request->id)
            ->delete();

        if($user){

//            $user_deleted = DB::table('users')
//                ->where('id', $request->id)
//                ->whereNotNull('deleted_at')
//                ->first();
//
//            // TODO Log user delete
//            $log_controller = new LogController();
//            $log_controller->userEditLog($request->causer_id, $user_deleted->id, $user_deleted->username);

            return response()->json([
                'status'=>'success',
                'message'=>'Record has been deleted successfully',
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to delete record',
            ]);
        }
    }

    public function searchUser(Request $request){

        $created_date = $request->created_date;
        $custom_date = $request->custom_date;
        $custom_start_date = $request->custom_start_date;
        $custom_end_date = $request->custom_end_date;
        $search_company = $request->search_company;
        $search_name = $request->search_name;
        $search_email = $request->search_email;
        $search_phone = $request->search_phone;

        $user = DB::table('users');
        if($created_date != 'all'){

            if($created_date == 'today'){

                $user->whereDate('created_at', Carbon::today());

            }elseif($created_date == 'current_week'){

                $user->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

            }elseif($created_date == 'last_week'){

                $previous_week = strtotime("-1 week +1 day");
                $start_week = strtotime("last sunday midnight", $previous_week);
                $end_week = strtotime("next saturday",$start_week);
                $start_week = date("Y-m-d", $start_week);
                $end_week = date("Y-m-d", $end_week);
                $user->whereBetween('created_at', [$start_week, $end_week]);

            }elseif($created_date == 'current_month'){

                $user->whereMonth('created_at', Carbon::now()->month);

            }elseif($created_date == 'current_year'){

                $user->whereYear('created_at', Carbon::now()->year);

            }elseif($created_date == 'custom_date'){

                $custom_date = date("Y-m-d",strtotime($custom_date));
                $user->whereDate('created_at', '=', $custom_date);

            }elseif($created_date == 'custom_range'){

                $start_date = date("Y-m-d",strtotime($custom_start_date));
                $end_date = date("Y-m-d",strtotime($custom_end_date));
                $user->whereBetween('created_at', [$start_date, $end_date]);
            }

        }

        if($search_name != ''){
            $user->where('first_name','LIKE','%'.$search_name.'%')
                ->orWhere('username', 'LIKE', '%'.$search_name.'%');
        }

        if($search_email != ''){
            $user->where('email','LIKE','%'.$search_email.'%');
        }

        if($search_phone != ''){
            $user->where('phone_number','LIKE','%'.$search_phone.'%');
        }

        if($search_company != ''){
            $user->where('is_company','LIKE','%'.$search_company.'%');
        }

        $users = $user
            ->where('deleted_at', null)
            ->get();

        $results = array();
        foreach ($users as $user){

            $payment_method_name = "";

            $payment_method = PaymentMethod::query()
                ->where('id', $user->payment_method)
                ->first();

            if ($payment_method){
                $payment_method_name = $payment_method->payment_method_name;
            }

            array_push($results,
                array(

                    'payment_method' => $user->payment_method,
                    'payment_method_name' => $payment_method_name,
                    'created_at' => date('Y-m-d h:i:s', strtotime($user->created_at)),
                    'updated_at' => $user->updated_at,
                    'deleted_at' => $user->deleted_at,
                ));
        }

        return json_encode($users);
    }

    public function userStatistics(Request $request){

        $user_id = $request->user_id;

        $wallet_total_balance = Transaction::query()
            ->where('deleted_at', null)
            ->where('user_id', $user_id)
            ->whereNotNull('usd_amount')
            ->sum('usd_amount');

        $total_buys = Transaction::query()
            ->where('deleted_at', null)
            ->where('user_id', $user_id)
            ->where('transaction_type','buy')
            ->sum('usd_amount');

        $total_sells = Transaction::query()
            ->where('deleted_at', null)
            ->where('user_id', $user_id)
            ->whereIn('transaction_type',['sell_internal', 'sell_external'])
            ->sum('usd_amount');

        return response()->json([
            'wallet_total_balance' => $wallet_total_balance,
            'total_buys' => $total_buys,
            'total_sells' => $total_sells,
        ]);
    }

}
