@extends('layouts.app')
@section('title', 'Students List')
@section('content')
    <div class="modal fade" id="createTeacherModal" tabindex="-1" role="dialog" aria-labelledby="createTeacherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTeacherModalLabel">Add student</h5>
                    <button value="{{ 'name' }}" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">parent Contact</label>
                            <input type="text" class="form-control" id="name" name="parent_info"
                                value="{{ old('name') }}" placeholder="Enter Phone Number" required>
                        </div>

                        <div class="form-group">
                            <label for="name">grade</label>
                          <select id="grade_id" name="grade_id" class="form-control" >
                            <option value="" disabled selected>Select Grade To assigned</option>
                            @foreach ($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal"
                                data-target="#createTeacherModal">
                                <span>Add New Student </span>
                            </button>
                            <table id="linesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>parent Info </th>
                                        <th>Grade</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->parent_info }}</td>
                                            <td>{{ $student->grade ? $student->grade->name : 'No grade Assigned' }}</td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{ route('students.edit', $student->id) }}">
                                                    Edit
                                                </a>
                                                <a style="color: #000" class="btn btn-secondary"
                                                    href="{{ route('students.show', $student->id) }}">
                                                    Show
                                                </a>
                                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                                    style="display:inline;"  onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
