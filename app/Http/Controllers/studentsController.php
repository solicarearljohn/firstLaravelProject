<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function myView()
    {
        $students = Students::all();
        $users = User::all();

        return view('dashboard', compact('students', 'users'));
    }

    //function addNewStudent
    public function addNewStudent(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
        ]);

        //students
        $add_new = new Students;
        $add_new->id = $request->id;
        $add_new->name = $request->name;
        $add_new->age = $request->age;
        $add_new->gender = $request->gender;
        $add_new->save();

        return back()->with('success', 'Student added successfully');
    }

    public function destroy($id)
    {
        $student = Students::findOrFail($id);
        $student->delete();

        return redirect('/')->with('success', 'Student deleted successfully.');
    
    }
}