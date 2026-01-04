@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3>Students List</h3>
        <a href="{{ route('admin.students.create') }}" class="btn btn-light btn-sm">Add Student</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name (BN)</th>
                    <th>Name (EN)</th>
                    <th>Gender</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Session</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $key => $student)
                <tr>
                    <td>{{ $students->firstItem() + $key }}</td>
                    <td>{{ $student->name_bn_first }} {{ $student->name_bn_last }}</td>
                    <td>{{ $student->name_en_first }} {{ $student->name_en_last }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ $student->currentAcademic->class ?? 'N/A' }}</td>
                    <td>{{ $student->currentAcademic->roll ?? 'N/A' }}</td>
                    <td>{{ $student->currentAcademic->session ?? 'N/A' }}</td>
                    <td>
                        @if($student->student_photo)
                        <img src="https://img.fbasm.edu.bd/{{ $student->student_photo }}" alt="Photo" style="max-width:50px; border-radius:5px;">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
</div>

@endsection
