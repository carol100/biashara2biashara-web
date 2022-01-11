<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job_listing;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;

class JobListingApiController extends Controller
{
    public function createJobListing(Request $request)
    {
            $job_listing = Job_listing::query()->create([
                'title' => $request->get('title'),
                'category_id' => $request->get('category_id'),
                'description' => $request->get('description'),
                'item_type' => $request->get('item_type'),
                'user_id' => $request->get('user_id'),
                'notes' => $request->get('notes'),
                'attachment' => $request->get('attachment'),
                'is_negotiable' => $request->get('is_negotiable'),

            ]);

            if ($job_listing){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Record added successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add record'
                ]);
            }
    }

    public function getAllOpenJobListings()
    {
        $jobs = Job_listing::query()
            ->where('status', 'submitted')
            ->where('deleted_at', null)
            ->get();

        return response()->json($jobs);
    }

    public function categoryJobListings(Request $request)
    {
        $category_id = $request->category_id;

        $category_jobs = Job_listing::query()
            ->where('category_id', $category_id)->get();

        return response()->json($category_jobs);
    }
    public function getRecentJobListings()
    {
        $jobs = Job_listing::query()
            ->where('status', 'submitted')
            ->where('deleted_at', null)
            ->latest()
            ->get();

        return response()->json($jobs);
    }

    public function updateJobListing(Request $request)
    {

        $update_job_listing = Job_listing::query()->where('id', $request->id)
            ->update([
            'title' => $request->get('title'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'item_type' => $request->get('item_type'),
            'user_id' => $request->get('user_id'),
            'notes' => $request->get('notes'),
            'attachment' => $request->get('attachment'),
            'is_negotiable' => $request->get('is_negotiable'),

        ]);

        if ($update_job_listing){
            return response()->json([
                'status' => 'success',
                'message' => 'Record added successfully'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add record'
            ]);
        }
    }

    public function getJobListingDetails(Request $request)
    {
        $job_details = Job_listing::query()->where('id', $request->id)->first();

        return response()->json($job_details);
    }

    public function deleteJobListing(Request $request)
    {
        $delete = Job_listing::query()
            ->where('id', $request->id)
            ->delete();

        return response()->json($delete);
    }

    public function searchJobListing(Request $request)
    {


    }
}
