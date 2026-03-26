<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function create(){
        return view('jobseeker.upload-resume');
    }

    public function store(Request $request){
        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048', // Validate that the uploaded file is a PDF and not larger than 2MB
        ]);

        $path = $request->file('resume')->store('resumes', 'public'); // Store the file in the 'resumes' directory within the 'public' disk

        Resume::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
        ]);

        return back()->with('success', 'Resume uploaded successfully!');
    }
}
