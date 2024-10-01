@extends('layouts.app')
@section('title', 'Grades List')
@section('content')
    <section class="content">
        <div class="container">
            <h1>Details of grade</h1>
            <div class="card">
                <div class="card-header">
                    <h2>{{ $grade->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $grade->name }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

