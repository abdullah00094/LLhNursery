@extends('layouts.app')
@section('title', 'Student Edit')
@section('content')
<section class="content">
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('students.update', $student->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{$student->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>email:</label>
                            <input class="form-control" type="text" id="parent_info" name="parent_info" value="{{$student->parent_info}}" required>
                        </div>
                        <div class="form-group">
                            <label>grade:</label>
                            <select name="grade_id" id="" class="form-control">
                                <option value="" disabled
                                {{ is_null($student->grade_id) ? 'selected' : '' }}>
                            Select a grade
                            </option>    
                            @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}"
                                {{ $student->grade && $student->grade->id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach                        
                            </select>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <a type="button" class="btn btn-default" href="/all-teachers">close</a>
                            <button type="submit" class="btn btn-primary" >save</button>
                        </div>    
                    </form>
                </div>
        </div>
    </div>
    </div>
</section>

@endsection