<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort functionality
        if ($request->filled('sort_by')) {
            $sortBy = $request->sort_by;
            if (in_array($sortBy, ['student_id', 'name', 'gpa'])) {
                $query->orderBy($sortBy);
            }
        } else {
            $query->latest();
        }

        $students = $query->get();

        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|unique:students,student_id',
            'name' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,5.00',
        ]);

        Student::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Student record added successfully.');
    }

    public function update(Request $request, $student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();

        $request->validate([
            'student_id' => 'required|string|unique:students,student_id,' . $student->student_id . ',student_id',
            'name' => 'required|string|max:255',
            'gpa' => 'required|numeric|between:1.00,5.00',
        ]);

        $student->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Student record updated successfully.');
    }

    public function destroy($student_id)
    {
        $student = Student::where('student_id', $student_id)->firstOrFail();
        $student->delete();

        return redirect()->route('dashboard')->with('success', 'Student record deleted successfully.');
    }
}