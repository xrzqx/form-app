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
            'phone' => 'required|unique:candidates|numeric|digits:14',
            'job_id' => 'required',
            'year' => 'required',
        ]);

        Candidate::create([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'year' => $request->year,
        ]);

        return response()->json([
            "status" => "ok",
            'message' => 'Data Berhasil Ditambahkan',
        ]);
        // return redirect('/');
    }
}
