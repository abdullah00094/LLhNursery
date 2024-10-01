<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        return view('teachers.index',['teachers'=>$teachers,'subjects'=>$subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        validator([
            'name' =>'required|string|max:255',
            'email' =>'required|string|max:255|unique:teachers,email',
            'phone_number' =>'required|string|max:255|unique:teachers,phone_number',
            'subject_id' =>'nullable|integer|exists:subjects,id',
        ]);

        Teacher::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'subject_id'=>$request->subject_id,
        ]);
        return redirect()->route('teachers.index')->with('success', 'Teacher saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show',['teacher'=>$teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = Subject::all();
        // dd($teacher);
        return view('teachers.edit',['teacher'=>$teacher, 'subjects'=>$subjects]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:teachers,email,' . $id,
        'phone_number' => 'required|string|max:255|unique:teachers,phone_number,' . $id,
        'subject_id' => 'integer|exists:subjects,id',
    ]);

    // Find the teacher by ID
    $teacher = Teacher::findOrFail($id);

    // Update teacher details
    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->phone_number = $request->phone_number;
    $teacher->subject_id = $request->subject_id;

    // Save the updated teacher record
    $teacher->save();

    // Redirect to the teachers index page with success message
    return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teacher::where('id',$id)->delete();
        return back();
    }

}
