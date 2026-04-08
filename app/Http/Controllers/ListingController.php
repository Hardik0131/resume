<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recruiter.post-job');
    }

    public function allJobs()
    {
        $listings = Listing::where('status', 'active')
            ->orderByDesc('created_at')
            ->get();

        return view('jobseeker.all-jobs', [
            'jobs' => $listings,
        ]);
    }

    public function jobDetail($slug)
    {
        $listing = Listing::where('slug', $slug)->firstOrFail();

        return view('jobseeker.job-detail', [
            'job' => $listing,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'job_title' => 'required',
                'slug' => 'nullable|unique:listings,slug',
                'company_name' => 'nullable',
                'location' => 'required',
                'work_type' => 'required|in:Remote,On-site,Hybrid',
                'employment_type' => 'required|in:Full-time,Part-time,Contract,Internship',
                'experience_level' => 'required|in:Junior,Mid,Senior,Lead',
                'min_salary' => 'nullable|numeric',
                'max_salary' => 'nullable|numeric|gte:min_salary',
                'currency' => 'required|in:USD,EUR,INR',
                'hiring_urgency' => 'required|in:Normal,High,Urgent',
                'job_description' => 'required',
                'required_skills' => 'nullable',
                'required_skills.*' => 'string',
                'application_link' => 'nullable',
                'status' => 'nullable|in:draft,active',
                'closing_date' => 'nullable|date|after_or_equal:today',
                'published_at' => 'nullable|date',
            ],
            [
                'job_title.required' => 'Job title is required.',
                'location.required' => 'Location is required.',
                'work_type.required' => 'Work type is required.',
                'work_type.in' => 'Invalid work type selected.',
                'employment_type.required' => 'Employment type is required.',
                'employment_type.in' => 'Invalid employment type selected.',
                'experience_level.required' => 'Experience level is required.',
                'experience_level.in' => 'Invalid experience level selected.',
                'min_salary.numeric' => 'Minimum salary must be a number.',
                'max_salary.numeric' => 'Maximum salary must be a number.',
                'max_salary.gte' => 'Maximum salary must be greater than or equal to minimum salary.',
                'currency.required' => 'Currency is required.',
                'currency.in' => 'Invalid currency selected.',
                'hiring_urgency.required' => 'Hiring urgency is required.',
                'hiring_urgency.in' => 'Invalid hiring urgency selected.',
                'job_description.required' => 'Job description is required.',
                'required_skills.*.string' => 'Each skill must be a string.',
                'closing_date.date' => 'Closing date must be a valid date.',
                'closing_date.after_or_equal' => 'Closing date cannot be in the past.'
            ]
        );

        $slug = Str::slug($request->job_title);
        $count = Listing::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count) {
            $slug .= '-' . ($count + 1);
        }

        Listing::create([
            'user_id' => Auth::user()->id,
            'job_title' => $request->job_title,
            'slug' => $slug,
            'company_name' => $request->company_name,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'currency' => $request->currency,
            'hiring_urgency' => $request->hiring_urgency,
            'job_description' => $request->job_description,
            'required_skills' => $request->required_skills ? json_encode($request->required_skills) : null,
            'application_link' => $request->application_link,
            'closing_date' => $request->closing_date,
            'published_at' => !$request->is_draft ? now() : null,
        ]);

        if ($request->is_draft) {
            return back()->with('success', 'Draft Saved Successfully!');
        } else {
            return back()->with('success', 'Job Listing Created Successfully!');
        }
    }

    public function updateDraft(Request $request, $slug)
    {
        $listing = Listing::where('slug', $slug)->where('user_id', Auth::user()->id)->firstOrFail();

        $request->validate(
            [
                'job_title' => 'required',
                'department' => 'nullable',
                'location' => 'required',
                'work_type' => 'required|in:Remote,On-site,Hybrid',
                'employment_type' => 'required|in:Full-time,Part-time,Contract,Internship',
                'experience_level' => 'required|in:Junior,Mid,Senior,Lead',
                'min_salary' => 'nullable|numeric',
                'max_salary' => 'nullable|numeric|gte:min_salary',
                'currency' => 'required|in:USD,EUR,INR',
                'hiring_urgency' => 'required|in:Normal,High,Urgent',
                'job_description' => 'required',
                'required_skills' => 'nullable',
                'required_skills.*' => 'string',
                'application_link' => 'nullable',
                'closing_date' => 'nullable|date|after_or_equal:today',
                'slug' => 'nullable|unique:listings,slug,' . $listing->id,
            ],
            [
                // validation messages...
            ]
        );

        $slug = Str::slug($request->job_title);
        $count = Listing::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $listing->id)->count();
        if ($count) {
            $slug .= '-' . ($count + 1);
        }

        $listing->update([
            'job_title' => $request->job_title,
            'department' => $request->department,
            'location' => $request->location,
            'work_type' => $request->work_type,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'currency' => $request->currency,
            'hiring_urgency' => $request->hiring_urgency,
            'job_description' => $request->job_description,
            'required_skills' => $request->required_skills ? json_encode($request->required_skills) : null,
            'application_link' => $request->application_link,
            'closing_date' => $request->closing_date,
            'slug' => $slug,
        ]);

        return back()->with('success', 'Draft Updated Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
