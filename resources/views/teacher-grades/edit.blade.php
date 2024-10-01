@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('assignedgrades.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    
    <div class="row">
        <h4>Edit Teacher Grade Assignment</h4>

        <!-- Display any success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Form to update the teacher-grade assignment -->
        <form action="{{ route('updateAssignedGrades.update', $teacherGrade->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <!-- Select field for the grade -->
            <div class="form-group">
                <label for="grade_id">Grade</label>
                <select name="grade_id" id="grade_id" class="form-control">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" 
                            {{ $teacherGrade->grade_id == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Select field for the teacher -->
            <div class="form-group">
                <label for="teacher_id">Teacher</label>
                <select name="teacher_id" id="teacher_id" class="form-control">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" 
                            {{ $teacherGrade->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Update Assignment</button>

        </form>
    
        <!-- Back button -->
    </div>

</div>















@endsection
