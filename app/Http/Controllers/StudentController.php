<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $redovni = Student::where('status','redovni')->count();
        $izvanredni = Student::where('status','izvanredni')->count();

        return view('students.index', compact(
            'students','redovni','izvanredni'
        ));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ime' => 'required|min:2',
            'prezime' => 'required|min:2',
            'status' => 'required|in:redovni,izvanredni',
            'godiste' => 'required|integer|min:1980|max:' . date('Y'),
            'prosjek' => 'required|numeric|min:1|max:5',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $this->store($request);
        $student->update($request->all());
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}

