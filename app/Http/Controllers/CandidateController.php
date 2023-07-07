<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:candidates|email',
            'phone' => 'required|unique:candidates|numeric|digits_between:10,15',
            'job' => 'required',
            'year' => 'required',
        ],[
            'name.required' => 'Name field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.',
            'email.unique' => 'Your Email has been resgiter',
            'phone.required' => 'Phone field is required.',
            'phone.unique' => 'Your Phone number has been resgiter',
            'job.required' => 'Jabatan field is required',
            'year.required' => 'Year field is required.'
        ]);

        Candidate::create([
            'job_id' => $request->job,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'year' => $request->year,
        ]);

        return back()->with('success', 'User created successfully.');
        // return view('welcome');
        // return "hello";
    }
}
