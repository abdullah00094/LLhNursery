<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Absence;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\AbsenceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;



class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Absence::with('student.grade');

        // Filter by student name
        if ($request->filled('student_name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->student_name . '%');
            });
        }
    
        // Filter by grade
        if ($request->filled('grade_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('grade_id', $request->grade_id);
            });
        }
    
        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
    
        // Get filtered results
        $absences = $query->paginate(10);
    
        // Store the filtered results in the session
        session(['filtered_absences' => $absences]);
    
        // Fetch grades for the grade filter
        $grades = Grade::all();
    
        // dd(request()->input()->links());
        // Return the view with absences and grades
        return view('absences.index', compact('absences', 'grades'));
    }
    
    public function showRecordForm(Request $request)
    {
        $grades = Grade::all(); // Fetch all grades for dropdown
    
        $gradeId = $request->input('grade_id'); // Get selected grade ID from request
        $students = []; // Default empty array
    
        // If a grade is selected, fetch students for that grade
        if ($gradeId) {
            $students = Student::where('grade_id', $gradeId)->get();
        }
    
        return view('absences.record', compact('students', 'grades', 'gradeId'));
    }
    public function recordAbsences(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'absences' => 'nullable|array',
            'absences.*' => 'exists:students,id',
        ]);
    
        $date = $request->input('date');
        $absences = $request->input('absences', []); // Get selected students' IDs
    
        foreach ($absences as $studentId) {
            Absence::updateOrCreate(
                ['student_id' => $studentId, 'date' => $date],
                ['absence' => true] // Mark as absent
            );
        }
    
        return redirect()->route('absences.index')
            ->with('success', 'Absences recorded successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the absence by ID and delete it
        $absence = Absence::findOrFail($id);
        $absence->delete();
    
        // Redirect back with success message
        return redirect()->route('absences.index')->with('success', 'Absence deleted successfully.');
    }
    
    
    public function exportFilteredAbsences()
    {
        // Retrieve filtered absences from session
        $absences = session('filtered_absences');
    
        if (!$absences) {
            return redirect()->back()->with('error', 'No absences to export.');
        }
    
        // Pass the filtered absences to the export class
        return Excel::download(new AbsenceExport($absences), 'filtered_absences.xlsx');
    }
    
    
      
}
