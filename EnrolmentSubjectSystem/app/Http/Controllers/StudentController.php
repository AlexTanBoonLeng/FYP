<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create()
    {
        return view('AARO/Insert_Student');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'StudentID' => 'required|unique:students',
            'password' => 'required',
            'name' => 'required',
            'ic' => 'required',
            'email' => 'required|email|unique:students',
            'phone_number' => 'required',
            'address' => 'required',
            'faculty' => 'required',
            'course' => 'required',
            'batch' => 'required',
            'gender' => 'required|in:Male,Female',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Student::create($validatedData);

        return redirect()->route('Insert_Student')->with('success', 'Student created successfully.');
    }
    
    public function index()
    {
        $students = Student::all();
        return view('AARO/StudentIndex', compact('students'));
    }

    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'password' => 'required',
            'name' => 'required',
            'ic' => 'required|unique:students,ic,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone_number' => 'required',
            'address' => 'required',
            'faculty' => 'required',
            'course' => 'required',
            'batch' => 'required',
            'gender' => 'required|in:male,female',
        ]);

        $student->update($validatedData);

        return redirect()->route('student.index')->with('success', 'Student details updated successfully.');
    }

    public function StudentDelete(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully.');
    }
    public function StudentSearch()
    {
        $keyword = request('StudentSearch');
    
        
        $students = Student::where('StudentID', 'like', '%' . $keyword . '%')
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword . '%')
        ->orWhere('ic', 'like', '%' . $keyword . '%')
        ->orWhere('faculty', 'like', '%' . $keyword . '%')
        ->orWhere('course', 'like', '%' . $keyword . '%')
        ->orWhere('batch', 'like', '%' . $keyword . '%')
        ->get();
       
    
        // Pass the filtered subjects to the view
        return view('/AARO/StudentIndex', compact('students'));
}
}
