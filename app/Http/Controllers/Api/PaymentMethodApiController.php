<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentMethodApiController extends Controller
{
    public function getPaymentMethodsList()
    {

        $payment_methods =  PaymentMethod::query()
            ->where('deleted_at', null)
            ->get();


        $results = array();
        foreach ($payment_methods as $payment_method){

            $country_name = "";

            $country = Country::query()
                ->where('id', $payment_method->country_id)
                ->first();

            if ($country){
                $country_name = $country->name;
            }

            array_push($results,
                array(
                    'id' => $payment_method->id,
                    'name' => $payment_method->name,
                    'description' => $payment_method->description,
                    'enabled' => $payment_method->enabled,
                    'country_id' => $payment_method->country_id,
                    'country_name' => $country_name,
                    'created_at' => date('Y-m-d h:i:s', strtotime($payment_method->created_at)),
                    'updated_at' => $payment_method->updated_at,
                    'deleted_at' => $payment_method->deleted_at,
                ));
        }
        return response()->json($results);
    }

    public function countryPaymentMethods(Request $request){

        $country_payment_methods = PaymentMethod::query()
            ->where('country_id', $request->id)
            ->where('enabled', true)
            ->where('deleted_at', null)
            ->get();

        return response()->json($country_payment_methods);
    }

    public function getCountryPaymentMethods(Request $request)
    {

        if (auth('api')->check()) {
            $user_id = auth('api')->user()->getAuthIdentifier();
        }

        $user = User::query()->where('id', $user_id)->first();
        $country_id = $user->country_id;

        $country_payment_methods = PaymentMethod::query()
            ->where('country_id', $country_id)
            ->where('enabled', true)
            ->where('deleted_at', null)
            ->get();

        return response()->json($country_payment_methods);
    }

    public function PaymentMethodDetails(Request $request)
    {
        return response()->json(
            PaymentMethod::query()
                ->where('id', $request->id)
                ->where('deleted_at', null)
                ->first()
        );
    }

    public function createPaymentMethods(Request $request)
    {

        $enabled = true;
        if($request->enabled == "false" || $request->enabled == 0) {
            $enabled = false;
        }

        $payment_method = PaymentMethod::query()->create([
            'name' => $request->get('name'),
            'description' => $request->get('name'),
            'country_id' => $request->get('country_id'),
            'enabled' => $enabled,
        ]);

        if ($payment_method){
            return response()->json([
                'status'=>'success',
                'message'=>'Payment method added successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to add record']);
        }
    }

    public function updatePaymentMethods(Request $request)
    {
        $enabled = true;
        if($request->enabled == "false" || $request->enabled == 0) {
            $enabled = false;
        }

        $update = PaymentMethod::query()->where('id',$request->id)->update([
            'name' => $request->get('name'),
            'description' => $request->get('name'),
            'country_id' => $request->get('country_id'),
            'enabled' => $enabled,
        ]);

        if ($update){
            return response()->json([
                'status'=>'success',
                'message'=>'Payment method updated successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to update record']);
        }
    }

    public function deletePaymentMethods(Request $request)
    {
        $delete_payment_method = PaymentMethod::query()
            ->where('id', $request->id)
            ->delete();

        if ($delete_payment_method){
            return response()->json([
                'status'=>'success',
                'message'=>'Payment method deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to delete record']);
        }
    }

    public function searchPaymentMethods(Request $request)
    {
        $created_date = $request->created_date;
        $custom_date = $request->custom_date;
        $custom_start_date = $request->custom_start_date;
        $custom_end_date = $request->custom_end_date;
        $search_name = $request->search_name;
        $search_country = $request->search_country;
        $search_active = $request->search_active;

        $payment_method = PaymentMethod::query();

        if($created_date != 'all'){

            if($created_date == 'today'){

                $payment_method->whereDate('created_at', Carbon::today());

            }elseif($created_date == 'current_week'){

                $payment_method->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

            }elseif($created_date == 'last_week'){

                $previous_week = strtotime("-1 week +1 day");
                $start_week = strtotime("last sunday midnight", $previous_week);
                $end_week = strtotime("next saturday",$start_week);
                $start_week = date("Y-m-d", $start_week);
                $end_week = date("Y-m-d", $end_week);
                $payment_method->whereBetween('created_at', [$start_week, $end_week]);

            }elseif($created_date == 'current_month'){

                $payment_method->whereMonth('created_at', Carbon::now()->month);

            }elseif($created_date == 'current_year'){

                $payment_method->whereYear('created_at', Carbon::now()->year);

            }elseif($created_date == 'custom_date'){

                $custom_date = date("Y-m-d",strtotime($custom_date));
                $payment_method->whereDate('created_at', '=', $custom_date);

            }elseif($created_date == 'custom_range'){

                $start_date = date("Y-m-d",strtotime($custom_start_date));
                $end_date = date("Y-m-d",strtotime($custom_end_date));
                $payment_method->whereBetween('created_at', [$start_date, $end_date]);
            }

        }
        if($search_name != ''){
            $payment_method->where('first_name', 'LIKE', '%'.$search_name.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search_name.'%');
        }

        if($search_country != ''){
            $payment_method->where('country_id', 'LIKE', '%'.$search_country.'%');
        }

        if($search_active != 'all'){
            $payment_method->where('enabled', 'LIKE', '%'.$search_active.'%');
        }

        $payment_methods = $payment_method->where('deleted_at', null)->get();

        $results = array();
        foreach ($payment_methods as $payment_method){

            $country_name = "";

            $country = Country::query()
                ->where('id', $payment_method->country_id)
                ->first();

            if ($country){
                $country_name = $country->name;
            }

            array_push($results,
                array(
                    'id' => $payment_method->id,
                    'name' => $payment_method->name,
                    'description' => $payment_method->description,
                    'enabled' => $payment_method->enabled,
                    'country_id' => $payment_method->country_id,
                    'country_name' => $country_name,
                    'created_at' => date('Y-m-d h:i:s', strtotime($payment_method->created_at)),
                    'updated_at' => $payment_method->updated_at,
                    'deleted_at' => $payment_method->deleted_at,
                ));
        }

        return response()->json($results);
    }
}
