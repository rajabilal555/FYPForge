<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Staff/Student/StudentList', [
            'students' => Student::paginate(request('per_page', 10)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Staff/Student/StudentCreate', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $data = collect($request->validate([
            'name' => ['required'],
            'registration_no' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::defaults()],
        ]));

        $student = Student::create($data->replace(['password' => Hash::make($data['password'])])->toArray());
        $student->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): Response
    {
        return Inertia::render('Staff/Student/StudentView', [
            'student' => $student->only([
                'id',
                // add more fields to send to user
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): Response
    {
        return Inertia::render('Staff/Student/StudentEdit', [
            'student' => $student->only([
                'id',
                'name',
                'email',
                'registration_no',
                // add more fields to send to user
            ])
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student->fill($request->validate([
            'name' => ['required'],
            'registration_no' => ['required', 'numeric'],
            'email' => ['required', 'email'],
        ]))->save();


        return redirect()->route('staff.student.index')->with('flash_message', 'Student updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
