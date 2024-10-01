@extends('layouts.app')
@section('title', 'Grades List')
@section('content')
    <section class="content">
        <div class="container">
            <h1>Details of Teacher</h1>
            <div class="card">
                <div class="card-header">
                    <h2>{{ $teacher->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $teacher->name }}</p>
                    <p><strong>Name:</strong> {{ $teacher->email }}</p>
                    <p><strong>Name:</strong> {{ $teacher->phone_number }}</p>
                    <p><strong>Name:</strong> {{ $teacher->subject ? $teacher->subject->name : 'No Subject Assigned' }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

