<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;

class ResumeController extends Controller
{
    public function create(){
        return view('jobseeker.upload-resume');
    }

    public function store(Request $request){
        $request->validate([
            'resume' => 'required|mimes:pdf|max:2028',
        ]);

        $file = $request->file('resume');
        $path = $file->store('resumes', 'public');

        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path('app/public/'. $path));
        $text = $pdf->getText();

        $score = Resume::calculateScore($text);

        Resume::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
            'content' => $text,
            'score' => $score,
        ]);

        return back()->with('success', 'Resume uploaded Successfully! Your resume score is: ' . $score);
    }
}
