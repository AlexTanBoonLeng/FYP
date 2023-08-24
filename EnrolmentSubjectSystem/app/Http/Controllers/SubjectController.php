<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Subject;
use App\Models\Lecturer;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
class SubjectController extends Controller
{
    public function create()
    {
        
        $lecturers = Lecturer::all();
        return view('/AARO/Insert_Subject', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id' => 'required|unique:subjects',
            'name' => 'required',
            'credit' => 'required',
            'day_and_time' => 'required|array', // Update the validation rule to expect an array
            'day_and_time.*' => 'required', // Validate each element of the array
            'classroom' => 'required',
            'lecturer_id' => 'nullable|exists:lecturers,id',
        ]);

        // Combine the days into a single string using a delimiter (e.g., comma)
        $days = implode(',', $validatedData['day_and_time']);
        $validatedData['day_and_time'] = $days;

        unset($validatedData['days']);

        Subject::create($validatedData);

        return redirect()->route('subject.create')->with('success', 'Subject created successfully.');
    }

    public function SubjectList()
    {
        // Fetch subjects along with their associated lecturer information
        $Subjects = Subject::with('lecturer', 'batch')->get();
    
        $Batchs = Batch::all(); // Fetch all batches for the dropdown
    
        return view('/AARO/SubjectIndex', compact('Subjects', 'Batchs'));
    }

    public function SubjectEdit($id)
    {   $lecturers = Lecturer::all();
        $Subjects = Subject::all()->where('id', $id);
        //select * from products where id='$id'

        return view('AARO/SubjectEdit', compact('Subjects','lecturers'))->with('subject', Subject::all(),'lecturer',Lecturer::all());
    }

    public function SubjectDelete($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        Session::flash('deleteSuccess', "Subject Information deleted successfully!");
        return redirect()->route('subject.index');
    }

    public function SubjectUpdate(Request $request, $id)
    {
       
        
        
        // Validate the form data
        $request->validate([
            
            'subject_id' => 'required|string|max:11',
            'name' => 'required|string|max:255',
            'credit' => 'required|integer|max:10', // Remove the comma from the max value
            'day_and_time' => 'required', // Update the validation rule to expect an array
           
            'classroom' => 'required|string',
            'lecturer_id' => 'required|string|max:255',
        ]);
       
        // Find the subject by ID
        $subject = Subject::find($id);

        if (!$subject) {
            // Handle the case when the subject with the given ID is not found
            // For example, you can redirect back with an error message
            return redirect()->back()->with('error', 'Subject not found.');
        }

        // Combine the days into a single string using a delimiter (e.g., comma)
        

        // Update the subject's information with the form data
        $subject->subject_id = $request->input('subject_id');
        $subject->name = $request->input('name');
        $subject->credit = $request->input('credit');
        $subject->day_and_time = $request->input('day_and_time');
        $subject->classroom = $request->input('classroom');
        $subject->lecturer_id = $request->input('lecturer_id');
        $subject->save();

        // Redirect back to the edit form with a success message
        return redirect()->route('subject.index')->with('success', 'Subject updated successfully.');
    }
    public function SubjectSearch()
    {
        $keyword = request('SubjectSearch');
    
        // Retrieve subjects based on the search keyword
        $Subjects = Subject::leftJoin('lecturers', 'lecturers.id', '=', 'subjects.lecturer_id')
        ->select('lecturers.name as lecturer_name', 'lecturers.id as lecturer_id', 'subjects.*')
        ->where(function (Builder $query) use ($keyword) {
            $query->where('subjects.subject_id', 'like', '%' . $keyword . '%')
                ->orWhere('subjects.name', 'like', '%' . $keyword . '%')
                ->orWhere('subjects.day_and_time', 'like', '%' . $keyword . '%')
                ->orWhere('subjects.classroom', 'like', '%' . $keyword . '%')
                ->orWhere('subjects.credit', 'like', '%' . $keyword . '%')
                ->orWhereHas('lecturer', function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
        })
        ->get();
    
        // Pass the filtered subjects to the view
        return view('/AARO/SubjectIndex', compact('Subjects'));
    }
}