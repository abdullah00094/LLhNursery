@extends('layouts.app')
@section('title', 'Teacher Edit')
@section('content')
<section class="content">
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('teachers.update', $teacher->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="form-group">
                            <label>name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{$teacher->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>email:</label>
                            <input class="form-control" type="text" id="name" name="email" value="{{$teacher->email}}" required>
                        </div>
                        <div class="form-group">
                            <label>phone number:</label>
                            <input class="form-control" type="text" id="name" name="phone_number" value="{{$teacher->phone_number}}" required>
                        </div>
                        <div class="form-group">
                            <label>subject:</label>
                            <select name="subject_id" id="" class="form-control">
                            <option value="" disabled {{ is_null($teacher->subject_id) ? 'selected' : '' }}>
                            Select a subject
                            </option>    
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ $teacher->subject && $teacher->subject->id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
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