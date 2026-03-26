<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index(){
        return view('employer.create-listing');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'skills' => 'required',
            'experience' => 'required|integer',
        ]);

        Listing::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'skills' => strtolower($request->skills),
            'experience' => $request->experience,
        ]);

        return back()->with('success', 'Job Created Successfully!');
    }
}
