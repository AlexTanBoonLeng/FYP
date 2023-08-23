<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Batch;
use App\Models\studenttimetable; // Update namespace if needed
use App\Models\Subject; // Update namespace if needed

class TimetableController extends Controller
{
    public function enrollSubjects(Request $request)
    {

        $Batchs = Batch::all();
        $selectedSubjectIds = $request->input('selected_subjects');
        $batch_id = $request->input('batch_id');
    
        foreach ($selectedSubjectIds as $subjectId) {
            $subject = Subject::find($subjectId); // Use $subject instead of $Subjects
            if ($subject) {
                studenttimetable::create([
                    'subject_id' => $subject->id,
                    'batch_id' => $batch_id,
                ]);
            }
        }
    
        $Subjects = Subject::with('lecturer')->get(); // Fetch subjects again
        return view('/AARO/SubjectIndex', compact('Subjects','Batchs'))->with('success', 'Subjects enrolled successfully.');
    }
    
}
