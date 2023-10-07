<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AdvisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Staff/Advisor/AdvisorList', [
            'advisors' => Advisor::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Staff/Advisor/AdvisorCreate', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = collect($request->validate([
            'name' => ['required'],
            'registration_no' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::defaults()],
        ]));

        $student = Advisor::create($data->replace(['password' => Hash::make($data['password'])])->toArray());
        $student->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Advisor $advisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advisor $advisor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advisor $advisor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advisor $advisor)
    {
        //
    }
}
