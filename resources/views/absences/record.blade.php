@extends('layouts.app')
@section('title', 'Record Absence')
@section('content')

<div class="container">
    <h1>Record Absences</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('absences.record') }}" class="mb-4">
        <div class="form-group">
            <label>Grade:</label>
            <select name="grade_id" class="form-control" onchange="this.form.submit()">
                <option value="">Select Grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" {{ request()->grade_id == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Absence Form -->
    <form method="POST" action="{{ route('absences.store') }}">
        @csrf
        <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" value="{{ now()->toDateString() }}" class="form-control" required>
        </div>

        @if (!empty($students))
            <div class="form-group">
                <label>Students:</label>
                @foreach ($students as $student)
                    <div class="form-check">
                        <input type="checkbox" name="absences[]" value="{{ $student->id }}" class="form-check-input">
                        <label class="form-check-label">{{ $student->name }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Record Absences</button>
        @else
            <p>Please select a grade to see students.</p>
        @endif
    </form>
</div>

@endsection
