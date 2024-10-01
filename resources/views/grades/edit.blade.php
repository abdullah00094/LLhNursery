@extends('layouts.app')
@section('title', 'Grades List')
@section('content')

<section class="content">
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('grades.update', $grade->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="form-group">
                            <label>name:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{$grade->name}}" required>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <a type="button" class="btn btn-default" href="/all-grades">Close</a>
                            <button type="submit" class="btn btn-primary" >Save</button>
                        </div>    
                    </form>
                </div>
        </div>
    </div>
    </div>
</section>

@endsection