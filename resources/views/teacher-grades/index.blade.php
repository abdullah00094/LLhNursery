@extends('layouts.app')

@section('content')
<div class="container">
    {{-- createAssignmentModalLabel --}}
    <div class="modal fade" id="createAssignmentModalLabel" tabindex="-1" role="dialog" aria-labelledby="createAssignmentModalLabel"
    aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <!-- Form to create a new teacher-grade assignment -->
                    <form action="{{ route('assignGrade.store') }}" method="POST">
                        @csrf
                    
                        <!-- Checkboxes for grades -->
                        <div class="form-group">
                            <label>Select Grades</label><br>
                            @foreach($grades as $grade)
                                <div class="form-check">
                                    <input type="checkbox" name="grade_id[]" value="{{ $grade->id }}" class="form-check-input" id="grade_{{ $grade->id }}">
                                    <label class="form-check-label" for="grade_{{ $grade->id }}">{{ $grade->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    
                        <!-- Checkboxes for teachers -->
                        <div class="form-group">
                            <label>Select Teachers</label><br>
                            @foreach($teachers as $teacher)
                                <div class="form-check">
                                    <input type="checkbox" name="teacher_id[]" value="{{ $teacher->id }}" class="form-check-input" id="teacher_{{ $teacher->id }}">
                                    <label class="form-check-label" for="teacher_{{ $teacher->id }}">{{ $teacher->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    
                        <!-- Submit button -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Assignment</button>
                        </div>
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal"
    data-target="#createAssignmentModalLabel">
    <span>Assign Grade </span>
    </button>
    <table class="table">
        <thead>
            <tr>
                <th>Teacher</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teacherGrades as $teacherGrade)
            <tr>
                <td>{{ $teacherGrade->teacher ? $teacherGrade->teacher->name : "NA" }}</td>
                <td>{{ $teacherGrade->grade ? $teacherGrade->grade->name :  "NA" }}</td>

                <td>
                    <a href="{{ route('editAssignedGrades.edit', $teacherGrade->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('assignedGrade.destroy', $teacherGrade->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $absences->links('pagination::bootstrap-4') }} 

</div>

@endsection
