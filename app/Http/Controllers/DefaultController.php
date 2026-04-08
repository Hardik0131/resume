<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Listing;

class DefaultController extends Controller
{
    public function jobDashboard()
    {
        $applicationCount = Application::where('user_id', Auth::user()->id)->where('is_applied', true)->count();
        $savedJobCount = Application::where('user_id', Auth::user()->id)->where('is_saved', true)->count();
        $recentApplications = Application::where('user_id', Auth::user()->id)->where('is_applied', true)->latest()->take(3)->get();

        $recentApplicationsArray = [];

        foreach ($recentApplications as $application) {
            $job = Listing::where('id', $application->listing_id)->first();
            if ($job) {
                $recentApplicationsArray[] = $job;
            }
        }

        $upcomingInterview = null; // Placeholder for upcoming interviews logic

        $recentSavedJobs = Application::where('user_id', Auth::user()->id)->where('is_saved', true)->latest()->take(3)->get();
        $recentSavedJobArray = [];

        foreach ($recentSavedJobs as $saved) {
            $job = Listing::where('id', $saved->listing->id)->first();
            if ($job) {
                $recentSavedJobArray[] = $job;
            }
        }

        $messages = null; // Placeholder for messages logic

        return view('jobseeker.dashboard', compact('applicationCount', 'savedJobCount', 'recentApplicationsArray', 'upcomingInterview', 'recentSavedJobArray', 'messages'));
    }
}
