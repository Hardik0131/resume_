<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Listing;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function apply($listingId){
        $listing = Listing::findOrFail($listingId);
        $resume = Resume::where('user_id', Auth::id())->latest()->first(); // Get the latest resume of the user

        if(!$resume){
            return back()->with('error', 'Upload Resume before applying.');
        }

        $matchScore = Listing::matchScore($resume->content, $listing->skills);

        Application::create([
            'listing_id' => $listing->id,
            'user_id' => Auth::id(),
            'resume_id' => $resume->id,
            'match_score' => $matchScore,
        ]);

        return back()->with('success', 'Applied Successfully');
    }
}
