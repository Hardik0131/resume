<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Listing;
use App\Models\Resume;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('user')
            ->where('user_id', Auth::user()->id)
            ->where('is_applied', true)
            ->latest()->get();

        $appliedJobs = [];

        foreach ($applications as $application) {
            $job = Listing::where('id', $application->listing_id)->first();
            if ($job) {
                $appliedJobs[] = $job;
            }
        }

        return view('jobseeker.applied-jobs', compact('applications', 'appliedJobs'));
    }

    public function saved()
    {
        $applications = Application::with('user')
            ->where('user_id', Auth::user()->id)
            ->where('is_saved', true)
            ->latest()->get();

        $savedJobs = [];

        foreach ($applications as $application) {
            $job = Listing::where('id', $application->listing_id)->first();
            if ($job) {
                $savedJobs[] = $job;
            }
        }

        $savedJobCount = count($savedJobs);

        return view('jobseeker.saved-jobs', compact('applications', 'savedJobs', 'savedJobCount'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'user_id' => 'required|exists:users,id',
            'saved_updated_at' => 'required',
        ]);

        Application::updateOrCreate([
            'listing_id' => $request->listing_id,
            'user_id' => $request->user_id,
        ], [
            'is_saved' => true,
            'saved_updated_at' => $request->saved_updated_at,
        ]);

        return back()->with('success', "Job Has Been Saved Successfully.");
    }

    public function create(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'resume_id' => 'required|exists:resumes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $resume = Resume::where('id', $request->resume_id)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $resumePath = $resume->file_path;

        Application::updateOrCreate([
            'listing_id' => $request->listing_id,
            'resume_id' => $request->resume_id,
            'user_id' => $request->user_id,
        ], [
            'resume_score' => $resume->score,
            'resume' => $resumePath,
            'status' => 'applied',
            'is_applied' => true,
        ]);

        return back()->with('success', 'Your application has been submitted successfully.');
    }

    public function applyWithdraw(Request $request)
    {
        $application = Application::where('listing_id', $request->listing_id)
            ->where('user_id', Auth::user()->id)
            ->where('is_applied', true)
            ->firstOrFail();

        if ($application) {
            Application::where('user_id', Auth::user()->id)
                ->where('listing_id', $request->listing_id)
                ->update(['is_applied' => false]);

            return back()->with('success', 'Your application has been withdrawn successfully.');
        } else {
            return back()->with('error', 'You have not applied for this job yet.');
        }
    }

    public function removeSaved(Request $request)
    {
        $application = Application::where('listing_id', $request->listing_id)
            ->where('user_id', Auth::user()->id)
            ->where('is_saved', true)
            ->firstOrFail();

        if ($application) {
            Application::where('user_id', Auth::user()->id)
                ->where('listing_id', $request->listing_id)
                ->update(['is_saved' => false]);

            return back()->with('success', 'Job has been removed from saved list successfully.');
        } else {
            return back()->with('error', 'This job is not in your saved list.');
        }
    }
}
