<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Lecturer;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with(['subject', 'lecturer'])->get();
        return view('timetables.index', compact('timetables'));
    }

    public function create()
    {
        // Fetch subjects and lecturers for dropdowns
        $subjects = Subject::all();
        $lecturers = Lecturer::all();
        return view('timetables.create', compact('subjects', 'lecturers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'day_and_time' => 'required|array',
            'day_and_time.*' => 'required|string',
            'classroom' => 'required|string',
            'lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        $timetable = new Timetable();
        $timetable->subject_id = $validatedData['subject_id'];
        $timetable->day_and_time = implode(', ', $validatedData['day_and_time']);
        $timetable->classroom = $validatedData['classroom'];
        $timetable->lecturer_id = $validatedData['lecturer_id'];
        $timetable->save();

        return redirect()->route('timetables.index')->with('success', 'Timetable entry created successfully.');
    }

    public function edit($id)
    {
        $timetable = Timetable::findOrFail($id);
        $subjects = Subject::all();
        $lecturers = Lecturer::all();
        return view('timetables.edit', compact('timetable', 'subjects', 'lecturers'));
    }

    public function update(Request $request, $id)
    {
        $timetable = Timetable::findOrFail($id);

        $validatedData = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'day_and_time' => 'required|array',
            'day_and_time.*' => 'required|string',
            'classroom' => 'required|string',
            'lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        $timetable->subject_id = $validatedData['subject_id'];
        $timetable->day_and_time = implode(', ', $validatedData['day_and_time']);
        $timetable->classroom = $validatedData['classroom'];
        $timetable->lecturer_id = $validatedData['lecturer_id'];
        $timetable->save();

        return redirect()->route('timetables.index')->with('success', 'Timetable entry updated successfully.');
    }

    public function destroy($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();
        return redirect()->route('timetables.index')->with('success', 'Timetable entry deleted successfully.');
    }
}
