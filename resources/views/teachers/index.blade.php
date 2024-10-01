@extends('layouts.app')
@section('title', 'teachers List')
@section('content')
    <div class="modal fade" id="createTeacherModal" tabindex="-1" role="dialog" aria-labelledby="createTeacherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTeacherModalLabel">Add teacher</h5>
                    <button value="{{ 'name' }}" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teachers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Phone Number</label>
                            <input type="text" class="form-control" id="name" name="phone_number"
                                value="{{ old('name') }}" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" id="name" name="email"
                                value="{{ old('name') }}" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject</label>
                          <select id="subject_id" name="subject_id" class="form-control" >
                            <option value="" disabled selected>Select Subject To assigned</option>
                            @foreach ($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
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
                                <span>Add New teacher</span>
                            </button>
                            <table id="linesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone number</th>
                                        <th>subject</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->phone_number }}</td>
                                            <td>{{ $teacher->subject ? $teacher->subject->name : 'No Subject Assigned' }}</td>
                                            <td>
                                                <a class="btn btn-success"
                                                    href="{{ route('teachers.edit', $teacher->id) }}">
                                                    Edit
                                                </a>
                                                <a style="color: #000" class="btn btn-secondary"
                                                    href="{{ route('teachers.show', $teacher->id) }}">
                                                    Show
                                                </a>
                                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                                    style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
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
