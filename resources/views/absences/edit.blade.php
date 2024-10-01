@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Absence</h1>
    
    <form method="POST" action="{{ route('absences.update', $absence->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="student">Student</label>
            <select name="student_id" id="student" class="form-control" required>
                <option value="">Select a student</option>
                @foreach($grades as $grade)
                    @foreach($grade->students as $student)
                        <option value="{{ $student->id }}" {{ $absence->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $absence->date }}" required>
        </div>

        <div class="form-group">
            <label for="is_absent">Is Absent?</label>
            <select name="is_absent" id="is_absent" class="form-control" required>
                <option value="1" {{ $absence->is_absent ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$absence->is_absent ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Absence</button>
    </form>
</div>
@endsection
