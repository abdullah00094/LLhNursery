<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\TeacherGrade;
use Illuminate\Http\Request;

class TeacherGradeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $teacherGrades = TeacherGrade::with(['teacher', 'grade'])->get();
        $teachers = Teacher::all(); // Fetch all teachers
        $grades = Grade::all(); // Fetch all grades
        return view('teacher-grades.index', [
            'teacherGrades' => $teacherGrades,
            'teachers' => $teachers,
            'grades' => $grades
        ]);
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|array', // Expect an array of IDs
            'grade_id.*' => 'exists:grades,id', // Ensure each grade_id exists
            'teacher_id' => 'required|array', // Expect an array of IDs
            'teacher_id.*' => 'exists:teachers,id', // Ensure each teacher_id exists
        ]);
    
        foreach ($request->teacher_id as $teacherId) {
            foreach ($request->grade_id as $gradeId) {
                // Check if this assignment already exists to avoid duplicates
                if (!TeacherGrade::where('teacher_id', $teacherId)->where('grade_id', $gradeId)->exists()) {
                    TeacherGrade::create([
                        'grade_id' => $gradeId,
                        'teacher_id' => $teacherId,
                    ]);
                }
            }
        }
    
        // Redirect back to the index page with a success message
        return redirect()->route('assignedgrades.index')->with('success', 'Teacher assigned to grade(s) successfully.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacherGrade = TeacherGrade::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
    
        return view('teacher-grades.edit', ['teacherGrade'=>$teacherGrade, 'grades'=>$grades, 'teachers'=>$teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            // Validate the request
            $request->validate([
                'teacher_id' => 'required|exists:teachers,id',
                'grade_id' => 'required|exists:grades,id',
            ]);

            // Find the teacher_grade entry
            $teacherGrade = TeacherGrade::findOrFail($id);

            // Update the fields with the new values
            $teacherGrade->teacher_id = $request->teacher_id;
            $teacherGrade->grade_id = $request->grade_id;

            // Save the updated teacher_grade
            $teacherGrade->save();

            // Redirect back to the list with success message
            return redirect()->route('assignedgrades.index')->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignedGrade=TeacherGrade::findOrFail($id)->delete();
        return back();
    }

}
