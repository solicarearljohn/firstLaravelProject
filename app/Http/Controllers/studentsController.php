<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function myView()
    {
        
      //  $students = Students::all();
       // $students = Students::latest()->paginate(5);
       $students = Students::paginate(5);
        $users = User::all();

        return view('dashboard', compact('students', 'users'));
    }

    // Method to handle the search request
    public function search(Request $request)
    {
        $search = $request->input('search'); // Get the search query from the request

        // Perform the search query
        $students = Students::where('name', 'like', "%{$search}%")->paginate(5)->appends(['search' => $search]); // Preserve the search query in the pagination links

        return view('dashboard', compact('students')); // Pass the search results to the view
    }


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

    public function index(Request $request)
    {
        $students = Students::all(); // Retrieve all students
        $students = Students::latest()->paginate(5); // Paginate with 5 students per page
        return view('dashboard', compact('students')); // Return the dashboard view with students data
    }



    public function edit($id)
    {
        $student = Students::find($id);
        return view('students.edit', compact('student'));
    }

            public function update(Request $request, $id)
        {
            // Validate the request data
            $request->validate([
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ]);

            // Find the student by ID
            $student = Students::find($id);

            // Update the student's data
            $student->update([
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
            ]);

            // Redirect back with a success message
            return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        }

           

    //to delete 
    public function destroy($id)
    {
        $student = Students::findOrFail($id);
        $student->delete();

        return redirect('/')->with('success', 'Student deleted successfully.');
    
    }


}