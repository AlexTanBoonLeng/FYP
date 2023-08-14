<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Lecturer;
use App\Models\Timetable_Entries;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function TimetableEnroll(Request $request)
    {
        $request->validate([
            'selected_subjects' => 'required|array',
            'selected_subjects.*' => 'integer|exists:subjects,id',
        ]);
    
        // Get the array of selected subject IDs
        $selectedSubjects = $request->input('selected_subjects');
    
        // Retrieve the subjects from the database using the selected IDs
        $subjects = Subject::whereIn('id', $selectedSubjects)->get();
    
        // Combine the subject IDs into a single string separated by commas
        $subjectIds = implode(',', $selectedSubjects);
        $subjectIds = implode(',', $selectedSubjects);
        // Combine other details (day_and_time, classroom, lecturer, etc.) into a single string or format as needed
    
        // Save the combined data into the timetable_entries table
        $timetableEntry = new Timetable_Entries();
        $timetableEntry->subject_id = $subjectIds;
        $timetableEntry->name = $subjectIds;
        $timetableEntry->credit = $subjectIds;
        $timetableEntry->day_and_time = $subjectIds;
        $timetableEntry->classroom = $subjectIds;
        $timetableEntry->lecturer_id = $subjectIds;
        $timetableEntry->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Selected subjects have been enrolled into the timetable.');
    }
}
