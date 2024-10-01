<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        $students = Student::all();
        return view('students.index',['grades'=>$grades,'students'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        validator([
            'name'=> 'required|string|max:255' , 
            'parent_info' => 'required|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
        ]);

        Student::create([
            'name'=>$request->name,
            'parent_info'=>$request->parent_info,
            'grade_id' => $request->grade_id,
        ]);
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = Student::findOrFail($id);
        return view('students.show',['student'=>$students]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = Student::findOrFail($id);
        $grades = Grade::all();
        return view('students.edit',['student'=>$students , 'grades'=>$grades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,Student $student)
    {
       $request-> validate([
        'name'=> 'required|string|max:255' , 
        'parent_info' => 'required|string|max:255',
        'grade_id' => 'required|integer|exists:grades,id',
        ]);
        $student = Student::findOrFail($id);
        $student ->name = $request->name;
        $student->parent_info = $request->parent_info;
        $student->grade_id = $request->grade_id;
        $student->save();
        return redirect()->route('students.index')->with('success', 'Record edited successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::where('id',$id)->delete();
        return to_route('students.index');
    }

}
