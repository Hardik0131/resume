<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class DefaultController extends Controller
{
    public function jobDashboard(){
        $applicationCount = Application::where('user_id', Auth::user()->id)->where('is_applied', true)->count();

        return view('jobseeker.dashboard', compact('applicationCount'));
    }
}
