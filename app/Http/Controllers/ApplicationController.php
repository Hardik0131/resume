<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Listing;
use App\Models\Resume;

class ApplicationController extends Controller
{
    public function index(){
        $applications = Application::with('user')
            ->where('user_id', Auth::user()->id)
            ->latest()->get();

        $appliedJobs = [];

        foreach($applications as $application){
            $job = Listing::where('id', $application->listing_id)->first();
            if($job){
                $appliedJobs[] = $job;
            }
        }

        return view('jobseeker.applied-jobs', compact('applications', 'appliedJobs'));
    }

    public function create(Request $request){
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'resume_id' => 'required|exists:resumes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $resume = Resume::where('id', $request->resume_id)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail();

        $resumePath = $resume->file_path;

        Application::create([
            'listing_id' => $request->listing_id,
            'resume_id' => $request->resume_id,
            'user_id' => $request->user_id,
            'resume_score' => $resume->score,
            'resume' => $resumePath,
            'status' => 'applied',
            'is_applied' => true,
        ]);

        return back()->with('success', 'Your application has been submitted successfully.');
    }
}
