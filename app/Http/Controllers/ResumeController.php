<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;

use function PHPSTORM_META\map;

class ResumeController extends Controller
{

    public function index(){
        $resume = Resume::where('user_id', Auth::user()->id)->latest()->first();

        return view('jobseeker.my-profile', compact('resume'));
    }

    public function store(Request $request){
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('resume');
        $path = $file->store('resumes', 'public');

        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/' . $path));
        $text = $pdf->getText();

        $score = Resume::calculateScore($text);

        Resume::create([
            'user_id' => Auth::user()->id,
            'file_path' => $path,
            'content' => $text,
            'score' => $score,
        ]);

        return back()->with('success', 'Resume Uploaded Successfully!');
    }
}
