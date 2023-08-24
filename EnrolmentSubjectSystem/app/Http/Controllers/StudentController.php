<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\studenttimetable;
use Illuminate\Http\Request;
Use DB;
use Illuminate\Support\Facades\Hash;
use Session;

class StudentController extends Controller
{
    public function create()
    {
        $Batchs = Batch::all();
        return view('AARO/Insert_Student', compact('Batchs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'StudentID' => [
                'required',
                'unique:users,userID', // Check for uniqueness in the "users" table
                'max:8',
            ],
            'name' => 'required|max:50',
            'password' => 'required|max:8',
            'ic' => 'required|regex:/^\d{6}-\d{2}-\d{4}$/',
            'email' => 'required|email|max:50',
            'phone_number' => 'required|max:11',
            'address' =>'required',
            'faculty' => 'required',
            'course' => 'required',
            'batch_id' => 'required',
            'gender' => 'required',


        ]);

            $user = new User();
            $user->userID = $validatedData['StudentID'];
            $user->name = $validatedData['name'];
            $user->password = Hash::make($validatedData['password']); // Hash the password
            $user->role = 'student'; // Assuming 'role' is a column in the 'users' table representing user roles
            $user->save();

            $student = new Student();
            $student->StudentID = $validatedData['StudentID'];
            $student->password = Hash::make($validatedData['password']); // Hash the password
            $student->name = $validatedData['name'];
            $student->ic = $validatedData['ic'];
            $student->email = $validatedData['email'];
            $student->phone_number = $validatedData['phone_number'];
            $student->address = $validatedData['address'];
            $student->faculty = $validatedData['faculty'];
            $student->course = $validatedData['course'];
            $student->batch_id = $validatedData['batch_id'];
            $student->gender = $validatedData['gender'];
            $student->save();
       

    

      

        return redirect()->route('Insert_Student')->with('success', 'Student created successfully.');
    }
    
    public function index()
    {
        
        $students = Student::with('batch')->get();
        return view('AARO/StudentIndex', compact('students'));
    }

    public function StudentEdit($id)
    {

          
        $Students =Student::all()->where('StudentID',$id);
        //select * from products where id='$id'
        
        return view('Student/StudentEdit' ,compact('Students'))->with('student',Student::all());
                                
       
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'phone_number' => 'required',
        'address' => 'required',
    ]);

    // Find the student with the given ID
    $student = Student::where('StudentID', $id)->first();

    if (!$student) {
        // Handle the case when student with the given ID is not found
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'Student not found.');
    }

    // Update the student's information with the form data
    $student->phone_number = $request->input('phone_number');
    $student->address = $request->input('address');
    $student->save();

    return redirect()->route('Studentdashboard')->with('success', 'Student details updated successfully.');
}

    public function StudentDelete($id)
    {
        $Student = Student::find($id);
            if (!$Student){
                return redirect()->route('student.index')->with('error', 'Student Profile not found.');
            }
            $User = User::where('userID',$Student->StudentID)->first();

            if($User && $User->role ==='student'){
                $User->delete();
            }

            $Student->delete();

            Session::flash('deleteSuccess', 'Student Profile deleted successfully.');
            return redirect()->route('student.index');

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
        ->orWhere('batch_id', 'like', '%' . $keyword . '%')
        ->get();
       
    
        // Pass the filtered subjects to the view
        return view('/AARO/StudentIndex', compact('students'));
}

public function viewTimetable()
{
    $user = Session::get('user');
    $sessionStudentId = $user->userID;

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']; // Modify as needed
    $startHour = 8;
    $endHour = 17;

    $student = Student::where('StudentID', $sessionStudentId)->first();
  
    if (!$student) {
        // Handle case where student is not found
        return redirect()->back()->with('error', 'Student not found.');
    }

    $batchId = $student->batch_id;

    $studentTimetables = studenttimetable::where('batch_id', $batchId)->get();

    $subjectIds = $studentTimetables->pluck('subject_id');
   
    $subjects = Subject::whereIn('id', $subjectIds)->get();

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

    return view('/Student/StudentViewTimetable', compact('processedDataByDayHour', 'daysOfWeek', 'startHour', 'endHour'));
}



}
