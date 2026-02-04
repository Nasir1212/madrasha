@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5>Students List</h5>
        <a href="{{ route('admin.students.create') }}" class="btn btn-light btn-sm">Add Student</a>
    </div>
    <div class="card mb-3">
    <div class="card-body bg-light">
        <form action="{{ route('admin.students.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-2">
                    <input type="text" name="uid" class="form-control form-control-sm" placeholder="ID (UID)" value="{{ request('uid') }}">
                </div>
                
                <div class="col-md-2">
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Student Name" value="{{ request('name') }}">
                </div>
                <div class="col-md-1">
                    <select name="gender" class="form-select form-select-sm">
                        <option value="">Gender</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="others" {{ request('gender') == 'others' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="class" class="form-select form-select-sm">
                        <option value="">Class </option>
                        @foreach(range(1, 10) as $class)
                            <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>Class {{ $class }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <input type="text" name="roll" class="form-control form-control-sm" placeholder="Roll" value="{{ request('roll') }}">
                </div>

                <div class="col-md-2">
                    <input type="text" name="session" class="form-control form-control-sm" placeholder="Session" value="{{ request('session') }}">
                </div>

                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>                  
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body bg-light">

            <div class="row g-2">
            <div class="col-md-2">
            <div class="mb-2 text-start">
            <strong> শিক্ষার্থী: {{ count($students) }} জন</strong>
            </div>
            </div>

            <div class="col-md-2">
            <div class="mb-2 text-start">
                     <form action="{{ route('admin.students.print.cards') }}" method="GET">
                        <input type="hidden" name="uid"  value="{{ request('uid') }}">
                        <input type="hidden" name="name"  value="{{ request('name') }}">  
                        <input type="hidden" name="class"  value="{{ request('class') }}">
                        <input type="hidden" name="roll"  value="{{ request('roll') }}">
                        <input type="hidden" name="session" value="{{ request('session') }}">
                        <input type="hidden" name="gender" value="{{ request('gender') }}">
                        <button type="submit" class="btn btn-success btn-sm w-100">
                        <i class="bi bi-printer"></i> Print ID Cards
                        </button>
                        </form>
            </div>
            </div>

              <div class="col-md-3">
            <div class="mb-2 text-start">
                     <form action="{{ route('admin.students.index') }}" method="GET">
                         <input type="hidden" name="uid"  value="{{ request('uid') }}">
                        <input type="hidden" name="name"  value="{{ request('name') }}">  
                        <input type="hidden" name="class"  value="{{ request('class') }}">
                        <input type="hidden" name="roll"  value="{{ request('roll') }}">
                        <input type="hidden" name="session" value="{{ request('session') }}">
                        <input type="hidden" name="gender" value="{{ request('gender') }}">
                        <input type="hidden" name="is_multiple_img"  value="{{ 1 }}">
                        
                        <button type="submit" class="btn btn-success btn-sm w-100">
                        <i class="bi bi-printer"></i> Upload Multiple Image 
                        </button>
                        </form>
            </div>
            </div>

            </div>



    </div>
</div>

    <div class="card-body table-responsive">
        
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th style="width: 7rem">Info</th>
                    <th style="">Student</th>
                    <th style="">Father </th>
                    <th style="">Mother </th>
                    <th style="">Gardian</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            @if(request()->has('is_multiple_img') &&  request('is_multiple_img') == '1')
            <form action="{{ route('admin.students.bulk-serial-photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @endif
            <tbody>
                @forelse($students as $key => $student)
                <tr>
                <td>
                @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $students->firstItem() + $key }}
                @else
                {{ $key + 1 }}
                @endif
                </td>
                    <td>
                          ID : {{ $student->uid }}
                    <br>
                    শ্রেণি: {{ $student->currentAcademic->class ?? 'N/A' }}
                    <br>
                    রোল:  {{ $student->currentAcademic->roll ?? 'N/A' }}
                    <br>
                    বর্ষ:  {{ $student->currentAcademic->session ?? 'N/A' }}
                    <br>
                    @if($student->student_photo)
                        <img src="https://img.fbasm.edu.bd/{{ $student->student_photo }}" alt="Photo" style="max-width:50px; border-radius:5px;">
                        @endif
                    </td>
                    <td>
                    নাম: {{ $student->name_bn_first }} {{ $student->name_bn_last }}
                    <br>
                    Name:  {{ $student->name_en_first }} {{ $student->name_en_last }}
                    <br>
                    জন্ম তারিখ: {{ $student->birth_date }}
                    <br>
                    জন্ম নি: {{ $student->birth_reg_no }}
                    <br>
                    লিঙ্গ:    {{ $student->gender }}
                
                </td>
                    <td>
                        পিতা: {{ $student->father_bn }}
                        <br>
                        Father:  {{ $student->father_en }}
                        <br>
                        এন.আইডি: {{ $student->father_nid }}
                        <br>
                        জন্ম নি: {{ $student->father_birth_reg }}
                        <br>
                        জন্ম তা: {{ $student->father_birth_date }}
                    </td>
                    <td>
                        
                        মাতা: {{ $student->mother_bn }}
                        <br>
                         Mother: {{ $student->mother_en }}
                        <br>
                        এন.আইডি: {{ $student->mother_nid }}
                        <br>
                        জন্ম নি:{{ $student->mother_birth_reg }}
                        <br>
                        জন্ম তা: {{ $student->mother_birth_date }}
                    </td>
                       
                      
                    <td>
                        নাম: {{ $student->guardian_name }}
                        <br>
                        পেশা: {{ $student->guardian_occupation }}
                        <br>
                        মোবাইল: {{ $student->guardian_phone }}
                        <br>
                    
                    <td>
                        @if(request()->has('is_multiple_img') &&  request('is_multiple_img') == '1')
                        <input type="checkbox"  class="form-check-input"  name="student_ids[]" value="{{ $student->id }}">
                        @else
                        <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-sm btn-info mb-1 "><i class="bi bi-eye"></i></a>
                        <br>
                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning  mb-1"><i class="bi bi-pencil-square"></i></a>
                        <br>
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">No students found.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">
            @if(request()->has('is_multiple_img') &&  request('is_multiple_img') == '1')
   <div class="card mt-3">
            <div class="card-body">
            <h5>সিরিয়াল অনুযায়ী ছবি আপলোড দিন</h5>
            <p class="text-danger">* আপনি যতজন ছাত্র সিলেক্ট করেছেন, ঠিক ততগুলো ছবিই সিলেক্ট করুন। ১ম ছবি ১ম সিলেক্টেড ছাত্রের জন্য প্রযোজ্য হবে।</p>
            <input type="file" name="photos[]" class="form-control" multiple required>
            <button type="submit" class="btn btn-success mt-2">সিরিয়ালি আপলোড করুন</button>
            </div>
            </div>
            @endif
                    </td>
                </tr>
         
            </tfoot>
            @if(request()->has('is_multiple_img') &&  request('is_multiple_img') == '1')
            </form>
            @endif
        </table>

       @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center mt-3">
        {{ $students->links() }}
    </div>
@endif
    </div>
</div>

@endsection
