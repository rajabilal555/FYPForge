<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Staff/Student/List', [
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Staff/Student/Create', []);
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

        $student = Student::create($data->replace(['password' => Hash::make($data['password'])])->toArray());
        $student->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return Inertia::render('pagepath/View', [
            'student' => $student->only([
                'id',
                // add more fields to send to user
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return Inertia::render('pagepath/Edit', [
            'student' => $student->only([
                'id',
                // add more fields to send to user
            ])
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
