@extends('layouts.app')
@section('title', 'Grades List')
@section('content')
    <section class="content">
        <div class="container">
            <h1>Details of grade</h1>
            <div class="card">
                <div class="card-header">
                    <h2>{{ $subject->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $subject->name }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

