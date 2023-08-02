<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
Use Session;

class LecturerController extends Controller
{
    //
    public function create()
    {
        return view('AARO/Insert_Lecturer');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'LecturerID' => 'required|unique:lecturers',
            'password' => 'required',
            'name' => 'required',
            'ic' => 'required|unique:lecturers',
            'email' => 'required|email|unique:lecturers',
            'phone_number' => 'required|unique:lecturers',
            'faculty' => 'required',
            'gender' => 'required|in:Male,Female',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Lecturer::create($validatedData);

        return redirect()->route('Lecturer.create')->with('success', 'Lecturer created successfully.');
    }

    public function Lecturerindex()
    {
        $Lecturers = Lecturer::all();
        return view('AARO/LecturerIndex', compact('Lecturers'));
    }

    public function LecturerEdit($id)
    {

          
        $Lecturers =Lecturer::all()->where('id',$id);
        //select * from products where id='$id'
        
        return view('AARO/LecturerEdit' ,compact('Lecturers'))->with('lecturer',Lecturer::all());
                                
       
    }

    public function LecturerDelete($id)
    {
        $lecturer=Lecturer::find($id);
        $lecturer->delete();
        Session::flash('deleteSuccess',"Lecturer Profile deleted succesful!");
        return redirect()->route('lecturer.index');
       

       
    }
    public function LecturerUpdate(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'id' => 'required|string|max:8',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:lecturers,email,' . $id,
            'faculty' => 'required|string|max:255',
        ]);
    
        // Find the lecturer by ID
        $lecturer = Lecturer::find($id);
    
        if (!$lecturer) {
            // Handle the case when lecturer with the given ID is not found
            // For example, you can redirect back with an error message
            return redirect()->back()->with('error', 'Lecturer not found.');
        }
    
        // Update the lecturer's information with the form data
        $lecturer->LecturerID = $request->input('id');
        $lecturer->name = $request->input('name');
        $lecturer->email = $request->input('email');
        $lecturer->faculty = $request->input('faculty');
        $lecturer->save();
    
        // Redirect back to the edit form with a success message
        return redirect()->route('lecturer.index')->with('success', 'Lecturer updated successfully.');
    }
    public function LecturerSearch()
    {
        $keyword = request('LecturerSearch');
    
        
        $Lecturers = Lecturer::where('LecturerID', 'like', '%' . $keyword . '%')
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword . '%')
        ->orWhere('faculty', 'like', '%' . $keyword . '%')
   
        ->get();
       
    
        // Pass the filtered subjects to the view
        return view('/AARO/LecturerIndex', compact('Lecturers'));
}
}
