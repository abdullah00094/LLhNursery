@extends('layouts.app')
@section('title', 'Students List')
@section('content')
    <section class="content">
        <div class="container">
            <h1>Details of student</h1>
            <div class="card">
                <div class="card-header">
                    <h2>{{ $student->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>parent info:</strong> {{ $student->parent_info }}</p>
                    <p><strong>grade:</strong> {{ $student->grade ? $student->grade->name : 'No Grade Assigned' }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

