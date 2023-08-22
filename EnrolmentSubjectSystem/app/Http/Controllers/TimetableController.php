<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\studenttimetable; // Update namespace if needed
use App\Models\Subject; // Update namespace if needed

class TimetableController extends Controller
{
    public function enrollSubjects(Request $request)
    {
        $selectedSubjectIds = $request->input('selected_subjects');
        $remark = $request->input('remark');
    
        foreach ($selectedSubjectIds as $subjectId) {
            $subject = Subject::find($subjectId); // Use $subject instead of $Subjects
            if ($subject) {
                studenttimetable::create([
                    'subject_id' => $subject->id,
                    'remarks' => $remark,
                ]);
            }
        }
    
        $Subjects = Subject::with('lecturer')->get(); // Fetch subjects again
        return view('/AARO/SubjectIndex', compact('Subjects'))->with('success', 'Subjects enrolled successfully.');
    }
    
}
