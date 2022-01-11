<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CountryApiController extends Controller
{
    public function createCountry(Request $request){

        $country =  Country::query()->create([
            'name'=>$request->get('name'),
            'country_code'=>$request->get('country_code'),
            'currency_code'=>$request->get('currency_code'),
        ]);

        if ($country){

//            $log_controller = new LogController();
//            $log_controller->countryCreateLog($request->causer_id, $country->id, $country->name);

            return response()->json([
                'status'=>'success',
                'message'=>'country created successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to add record']);
        }

    }

    public function getRecentCountries(Request $request)
    {
        return response()->json(
            Country::query()
                ->where('deleted_at', null)
                ->latest()
                ->limit(10)
                ->get());
    }

    public function getAllCountries(){

        return response()->json(
            Country::query()->orderBy('name')
                ->where('deleted_at', null)
                ->get()
        );
    }

    public function updateCountry(Request $request){

        $country_id = $request->id;

        $update = Country::query()->where('id', $country_id)->update([
            'name'=>$request->get('name'),
            'country_code'=>$request->get('country_code'),
            'currency_code'=>$request->get('currency_code'),
        ]);

        if($update){

//            $country = DB::table('countries')
//                ->where('id', $request->id)
//                ->first();
//
//            // TODO Log country update
//            $log_controller = new LogController();
//            $log_controller->countryEditLog($request->causer_id, $country->id, $country->name);


            return response()->json([
                'status'=>'success',
                'message'=>'Country updated successfully'
            ]);
        }
        else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to update Country'
            ]);
        }

    }

    public function getCountryDetails(Request $request){

        return response()->json(
            Country::query()->where('id', $request->id)->first()
        );
    }

    public function deleteCountry(Request $request){

        $country_id = $request->id;
        $country =  Country::query()->where('id', $country_id)->delete();

        if ($country){
//
//            $country_deleted = DB::table('countries')
//                ->where('id', $request->id)
//                ->first();
//
//            // TODO Log country delete
//            $log_controller = new LogController();
//            $log_controller->countryDeleteLog($request->causer_id, $country_deleted->id, $country_deleted->name);

            return response()->json([
                'status'=>'success',
                'message'=>'Country deleted successfully'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Failed to delete Country '
            ]);
        }
    }

    public function searchAdminCountry(Request $request)
    {
        $created_date = $request->created_date;
        $custom_date = $request->custom_date;
        $custom_start_date = $request->custom_start_date;
        $custom_end_date = $request->custom_end_date;
        $search_name = $request->search_name;

        $country = Country::query();

        if($created_date != 'all'){

            if($created_date == 'today'){

                $country->whereDate('created_at', Carbon::today());

            }elseif($created_date == 'current_week'){

                $country->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);

            }elseif($created_date == 'last_week'){

                $previous_week = strtotime("-1 week +1 day");
                $start_week = strtotime("last sunday midnight", $previous_week);
                $end_week = strtotime("next saturday",$start_week);
                $start_week = date("Y-m-d", $start_week);
                $end_week = date("Y-m-d", $end_week);
                $country->whereBetween('created_at', [$start_week, $end_week]);

            }elseif($created_date == 'current_month'){

                $country->whereMonth('created_at', Carbon::now()->month);

            }elseif($created_date == 'current_year'){

                $country->whereYear('created_at', Carbon::now()->year);

            }elseif($created_date == 'custom_date'){

                $custom_date = date("Y-m-d",strtotime($custom_date));
                $country->whereDate('created_at', '=', $custom_date);

            }elseif($created_date == 'custom_range'){

                $start_date = date("Y-m-d",strtotime($custom_start_date));
                $end_date = date("Y-m-d",strtotime($custom_end_date));
                $country->whereBetween('created_at', [$start_date, $end_date]);
            }

        }
        if($search_name != ''){
            $country
                ->where('name', 'LIKE', '%'.$search_name.'%');
        }

        $country = $country->where('deleted_at', null)->get();
        return response()->json($country);
    }

}
