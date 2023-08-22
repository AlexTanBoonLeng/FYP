<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Subject;
Use DB;
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
            'LecturerID' => [
                'required',
                'unique:users,userID', // Check for uniqueness in the "users" table
                'max:8',
            ],
            'password' => 'required',
            'name' => 'required',
            'ic' => 'required|unique:lecturers',
            'email' => 'required|email|unique:lecturers',
            'phone_number' => 'required|unique:lecturers',
            'faculty' => 'required',
            'gender' => 'required|in:Male,Female',
        ]);
        $user = new User();
        $user->userID = $validatedData['LecturerID'];
        $user->name = $validatedData['name'];
        $user->password = Hash::make($validatedData['password']); // Hash the password
        $user->role = 'lecturer'; // Assuming 'role' is a column in the 'users' table representing user roles
        $user->save();

        $lecturer = new Lecturer();
        $lecturer->LecturerID = $validatedData['LecturerID'];
        $lecturer->password = Hash::make($validatedData['password']); // Hash the password
        $lecturer->name = $validatedData['name'];
        $lecturer->ic = $validatedData['ic'];
        $lecturer->email = $validatedData['email'];
        $lecturer->phone_number = $validatedData['phone_number'];
        $lecturer->faculty = $validatedData['faculty'];
        $lecturer->gender = $validatedData['gender'];
        $lecturer->save();
       

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
        if(!$lecturer){
            return redirect()->route('lecturer.index')->with('erorr','Lecturer Profile not found.');
        }

        $User = User::where('userID',$lecturer->LecturerID)->first();

        if($User && $User->role === 'lecturer'){
            $User->delete();
        }

        $lecturer->delete();
    
        Session::flash('deleteSuccess', 'lecturer Profile deleted successfully.');
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

public function LecturerDashboard(){
    return view ('/Lecturer/LecturerDashboard');
}

public function viewTimetable()
{
    $user = Session::get('user');
    $sessionLecturerId = $user->userID;

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']; // Modify as needed
    $startHour = 8;
    $endHour = 17;

    $subjects = DB::table('subjects')
        ->select('subjects.*')
        ->join('lecturers', 'subjects.lecturer_id', '=', 'lecturers.id')
        ->join('users', 'lecturers.lecturerid', '=', 'users.userid')
        ->where('users.userid', '=', $sessionLecturerId)
        ->get();

    $processedDataByDayHour = [];

    foreach ($subjects as $subject) {
        $schedules = explode(',', $subject->day_and_time);

        foreach ($schedules as $schedule) {
            $scheduleParts = explode(' ', trim($schedule));
            $day = $scheduleParts[0];
            list($startTime, $endTime) = explode('-', $scheduleParts[1]);

            for ($hour = $startHour; $hour <= $endHour; $hour++) {
                if ($hour >= $startTime && $hour < $endTime) {
                    $processedDataByDayHour[$day][$hour][] = [
                        'id' => $subject->id,
                        'subject_id' => $subject->subject_id,
                        'name' => $subject->name,
                        'classroom'=> $subject->classroom,
                        // Include other relevant data
                    ];
                }
            }
        }
    }

    return view('/Lecturer/viewTimetable', compact('processedDataByDayHour', 'daysOfWeek', 'startHour', 'endHour'));
}
}
