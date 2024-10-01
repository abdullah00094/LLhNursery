@extends('layouts.app')
@section('title', 'Absences List')

@section('content')
<div class="container">
    <h1>Absences List</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('absences.index') }}" class="mb-4" id="filter-form" >
        <!-- Date Range Filter -->
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>

        <!-- Student Name Filter -->
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" class="form-control" value="{{ request('student_name') }}">
        </div>

        <!-- Grade Filter -->
        <div class="form-group">
            <label for="grade_id">Grade:</label>
            <select name="grade_id" id="grade_id" class="form-control">
                <option value="">Select Grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('absences.index') }}" class="btn btn-secondary">Reset</a> <!-- Reset button -->
        <button type="button" class="btn btn-success" id="export-btn">Export to Excel</button>
    </form>

    <!-- Absence Table -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Grade</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absences as $absence)
                <tr>
                    <td>{{ $absence->id }}</td>
                    <td>{{ $absence->student ? $absence->student->name : 'No Student' }}</td>
                    <td>{{ $absence->student && $absence->student->grade ? $absence->student->grade->name : 'No Grade' }}</td>
                    <td>{{ $absence->date }}</td>
                    <td>
                        <form action="{{ route('absences.delete', $absence->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No absences found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $absences->links('pagination::bootstrap-4') }} 


    {{-- {{ $absences->links() }} --}}
</div>
<script>
$('#export-btn').on('click', function () {
    window.location.href = '{{ route("absences.export") }}';
});

</script>
@endsection
