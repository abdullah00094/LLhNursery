@extends('layouts.app')
@section('title', 'Grades List')
@section('content')
    <div class="modal fade" id="createGradeModal" tabindex="-1" role="dialog" aria-labelledby="createGradeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGradeModalLabel">Add Grade</h5>
                    <button value="{{ 'name' }}" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Enter name" required>
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
                                data-target="#createGradeModal">
                                <span>Add New Grade</span>
                            </button>
                            <table id="linesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                        <tr>
                                            <td>{{ $grade->id }}</td>
                                            <td>{{ $grade->name }}</td>
                                            <td>
                                                <a class="btn btn-success" href="{{ route('grades.edit', $grade->id) }}">
                                                    Edit
                                                </a>
                                                <a style="color: #000" class="btn btn-secondary"
                                                    href="{{ route('grades.show', $grade->id) }}">
                                                    Show
                                                </a>
                                                <form action="{{ route('grades.destroy', $grade->id) }}" method="POST"
                                                    style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this grade?');">
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
