<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Aaro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
Use Session;
class AAROController extends Controller
{
    //
    public function create()
    {
        return view('AARO/Insert_AARO');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'AAROID' => [
                'required',
                'unique:users,userID', // Check for uniqueness in the "users" table
                'max:8',
            ],
            'password' => 'required',
            'name' => 'required',
            'ic' => 'required|unique:AARO',
            'email' => 'required|email|unique:AARO',
            'phone_number' => 'required|unique:AARO',  
        ]);
    
        $user = new User();
        $user->userID = $validatedData['AAROID'];
        $user->name = $validatedData['name'];
        $user->password = Hash::make($validatedData['password']); // Hash the password
        $user->role = 'AARO'; // Assuming 'role' is a column in the 'users' table representing user roles
        $user->save();
    
        $AARO = new Aaro();
        $AARO->AAROID = $validatedData['AAROID'];
        $AARO->password = $user->password; // Use the hashed password from the User model
        $AARO->name = $validatedData['name'];
        $AARO->ic = $validatedData['ic'];
        $AARO->email = $validatedData['email'];
        $AARO->phone_number = $validatedData['phone_number'];
        $AARO->save();
       
        return redirect()->route('AARO.create')->with('success', 'AARO created successfully.');
    }

    public function AAROindex()
    {
        $Aaro = Aaro::all();
        return view('AARO/AAROIndex', compact('Aaro'));
    }
    public function AAROSearch()
    {
        $keyword = request('AAROSearch');
    
        
        $Aaro = Aaro::where('AAROID', 'like', '%' . $keyword . '%')
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword . '%')
        ->orWhere('phone_number', 'like', '%' . $keyword . '%')
   
        ->get();
       
    
        // Pass the filtered subjects to the view
        return view('/AARO/AAROIndex', compact('Aaro'));
}
public function AARODelete($id)
{
    
    $Aaro = Aaro::find($id);

  
    if (!$Aaro) {
        return redirect()->route('AARO.index')->with('error', 'AARO Profile not found.');
    }

    
    $User = User::where('userID', $Aaro->AAROID)->first();

    
    if ($User && $User->role === 'AARO') {
        $User->delete();
    }

   
    $Aaro->delete();

  
    Session::flash('deleteSuccess', 'AARO Profile deleted successfully.');
    return redirect()->route('AARO.index');
}
   
}

