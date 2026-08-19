@extends('layouts.admin')
@section('content')
    @php
    // ইউআরএল (URL) থেকে সিলেক্টেড আইডিগুলো অ্যারেতে নেওয়া
    $selectedIds = request('std_ids') ? explode(',', request('std_ids')) : [];
    @endphp

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
                <div class="col-md-1">
                    <input type="text" name="age" class="form-control form-control-sm" placeholder="Age 5-9" value="{{ request('age') }}">
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

                <div class="col-md-1">
                    <select name="class" class="form-select form-select-sm">
                        <option value="">Class </option>
                        @foreach(range(0, 10) as $class)
                            <option value="{{ $class }}" 
                            {{ request()->filled('class') && request('class') == $class ? 'selected' : '' }}>
                            Class {{ $class }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <input type="text" name="roll" class="form-control form-control-sm" placeholder="Roll" value="{{ request('roll') }}">
                </div>

                <div class="col-md-2">
                    <input type="text" name="session" class="form-control form-control-sm" placeholder="Session" value="{{ request('session') }}">
                </div>
                <input type="hidden" name="std_ids" value="{{ request('std_ids') }}">

                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-search"></i> Search
                    </button>
                    <a href="{{ route('admin.students.index') }}?all=1" class="btn btn-secondary btn-sm"> <i class="bi bi-eye"></i> </a>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>                  
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">

        <form action="{{ route('admin.download.doc') }}" method="POST">
    @csrf
    <input type="hidden" name="uid" value="{{ request('uid') }}">
    <input type="hidden" name="age" value="{{ request('age') }}">
    <input type="hidden" name="name" value="{{ request('name') }}">
    <input type="hidden" name="class" value="{{ request('class') }}">
    <input type="hidden" name="roll" value="{{ request('roll') }}">
    <input type="hidden" name="session" value="{{ request('session') }}">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="std_ids" value="{{ request('std_ids') }}" >

<input type="hidden" name="ordered_columns" id="ordered_columns">
    <div class="row mb-3 card p-3 bg-light">
        <h6>ডাউনলোডের জন্য কলাম সিলেক্ট করুন:</h6>
        <div class="row">
        <div class="col-md-3">
            <input type="checkbox" class="column-check" name="selected_columns[]" value="uid" > UID <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="full_name_bn" > নাম (বাংলা) <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="full_name_en" > Name (EN) <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="birth_date"> জন্ম তারিখ <br>
             <input type="checkbox" class="column-check" name="selected_columns[]" value="blood_group"> Blood Group <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="gender"> লিঙ্গ
        </div>
        <div class="col-md-3">
            <input type="checkbox" class="column-check" name="selected_columns[]" value="father_bn"> পিতার নাম (বাংলা) <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="father_en"> পিতার নাম (ইংরেজী) <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="mother_bn"> মাতার নাম (বাংলা) <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="mother_en"> মাতার নাম (ইংরেজী) <br>
           
        </div>
        <div class="col-md-3">
            <input type="checkbox" class="column-check" name="selected_columns[]" value="guardian_phone"> অভিভাবকের ফোন <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="perm_village"> স্থায়ী ঠিকানা <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="birth_reg_no"> জন্ম নিবন্ধন নং <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="religion"> ধর্ম
        </div>
        <div class="col-md-3">
            <input type="checkbox" class="column-check" name="selected_columns[]" value="student_photo"> ছবি <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="class"> শ্রেণি <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="roll"> রোল <br>
            <input type="checkbox" class="column-check" name="selected_columns[]" value="session"> বর্ষ <br>
        </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Download Selected Data (Word)</button>
</form>

    </div>
</div>



<div class="card mb-3">
    <div class="card-body bg-light">

            <div class="row g-2">
            <div class="col-md-2">
            <div class="mb-2 text-start">
            <strong> শিক্ষার্থী: 
                {{ $students instanceof \Illuminate\Pagination\LengthAwarePaginator ? $students->total() : $students->count() }}
                 জন</strong>
            </div>
            </div>

            <div class="col-md-2">
            <div class="mb-2 text-start">
                     <form action="{{ route('admin.students.print.cards') }}" method="GET">
                         <input type="hidden" name="uid"  value="{{ request('uid') }}">
                         <input type="hidden" name="age"  value="{{ request('age') }}">
                        <input type="hidden" name="name"  value="{{ request('name') }}">  
                        <input type="hidden" name="class"  value="{{ request('class') }}">
                        <input type="hidden" name="roll"  value="{{ request('roll') }}">
                        <input type="hidden" name="session" value="{{ request('session') }}">
                        <input type="hidden" name="gender" value="{{ request('gender') }}">
                         <input type="hidden" name="std_ids" value="{{ request('std_ids') }}">

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
                        <input type="hidden" name="std_ids" value="{{ request('std_ids') }}">

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
                <input type="checkbox" onchange="handle_selected_id(this,'{{$student->id}}')" {{ in_array($student->id, $selectedIds) ? 'checked' : '' }}
               style="transform: scale(1.1); cursor: pointer; margin: 0;">
                @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $students->firstItem() + $key }}
                @else
                {{ $loop->iteration }}
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

<script>

//     let selectedOrder = [];

//     document.querySelectorAll('.column-check').forEach(checkbox => {
//         checkbox.addEventListener('change', function() {
//             if (this.checked) {
//                 // মার্ক করলে লিস্টের শেষে পুশ হবে
//                 selectedOrder.push(this.value);
//             } else {
//                 // আনমার্ক করলে লিস্ট থেকে রিমুভ হবে
//                 selectedOrder = selectedOrder.filter(item => item !== this.value);
//             }
//             // হিডেন ফিল্ডে কমা দিয়ে স্টোর করা (যেমন: uid,full_name_bn,roll)
//             document.getElementById('ordered_columns').value = selectedOrder.join(',');
//         });
//     });

//     // ফর্ম সাবমিট করার সময় চেক করা
//     document.getElementById('downloadForm').addEventListener('submit', function(e) {
//         if (selectedOrder.length === 0) {
//             e.preventDefault();
//             alert('অনুগ্রহ করে অন্তত একটি কলাম সিলেক্ট করুন।');
//         }
//     });

 

// let selectedStudentIds = [];

// function handle_selected_id(checkbox, id) {
//     id = id.toString(); // আইডি স্ট্রিং এ কনভার্ট
    
//     if (checkbox.checked) {
//         // টিক দিলে অ্যারেতে ঢুকবে
//         if (!selectedStudentIds.includes(id)) {
//             selectedStudentIds.push(id);
//         }
//     } else {
//         // টিক তুলে নিলে অ্যারে থেকে বাদ যাবে
//         selectedStudentIds = selectedStudentIds.filter(item => item !== id);
//     }
    
//     // কমা দিয়ে জয়েন করা (যেমন: 72,73)
//     let finalIdsString = selectedStudentIds.join(',');
    
//     // name="std_ids" দিয়ে পেজের দুটি ইনপুট ফিল্ডকেই একসাথে ধরা এবং ভ্যালু সেট করা
//     let inputFields = document.getElementsByName('std_ids');
//     inputFields.forEach(field => {
//         field.value = finalIdsString;
//     });

//     console.log("Name field values updated to:", finalIdsString);
// }

// ==========================================
    // ১. গ্লোবাল ভেরিয়েবল ইনিশিয়ালাইজেশন (সবার উপরে)
    // ==========================================
    let selectedOrder = [];
    let selectedStudentIds = [];

    // পেজ লোড হওয়ার সময় যদি আগে থেকে input ফিল্ডে কোনো আইডি থাকে, তা অ্যারেতে নেওয়া
    let existingFields = document.getElementsByName('std_ids');
    if (existingFields.length > 0 && existingFields[0].value) {
        selectedStudentIds = existingFields[0].value.split(',').filter(Boolean);
    }

    // ==========================================
    // ২. স্টুডেন্ট আইডি সিলেকশন ফাংশন (গ্লোবাল স্কোপে)
    // ==========================================
    window.handle_selected_id = function(checkbox, id) {
        id = id.toString(); // আইডি স্ট্রিং এ কনভার্ট
        
        if (checkbox.checked) {
            // টিক দিলে অ্যারেতে ঢুকবে
            if (!selectedStudentIds.includes(id)) {
                selectedStudentIds.push(id);
            }
        } else {
            // টিক তুলে নিলে অ্যারে থেকে বাদ যাবে
            selectedStudentIds = selectedStudentIds.filter(item => item !== id);
        }
        
        // কমা দিয়ে জয়েন করা (যেমন: 72,73)
        let finalIdsString = selectedStudentIds.join(',');
        
        // name="std_ids" দিয়ে পেজের দুটি ইনপুট ফিল্ডকেই একসাথে ধরা এবং ভ্যালু সেট করা
        let inputFields = document.getElementsByName('std_ids');
        inputFields.forEach(field => {
            field.value = finalIdsString;
        });

        console.log("Name field values updated to:", finalIdsString);
    }

    // ==========================================
    // ৩. ডাউনলোডের জন্য কলাম সিলেকশন হ্যান্ডেলার
    // ==========================================
    document.querySelectorAll('.column-check').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // মার্ক করলে লিস্টের শেষে পুশ হবে
                selectedOrder.push(this.value);
            } else {
                // আনমার্ক করলে লিস্ট থেকে রিমুভ হবে
                selectedOrder = selectedOrder.filter(item => item !== this.value);
            }
            // হিডেন ফিল্ডে কমা দিয়ে স্টোর করা (যেমন: uid,full_name_bn,roll)
            let orderedColumnsInput = document.getElementById('ordered_columns');
            if (orderedColumnsInput) {
                orderedColumnsInput.value = selectedOrder.join(',');
            }
        });
    });

    // ==========================================
    // ৪. ফর্ম সাবমিট করার সময় নাল-চেক ভ্যালিডেশন
    // ==========================================
    let downloadFormElement = document.getElementById('downloadForm');
    if (downloadFormElement) {
        downloadFormElement.addEventListener('submit', function(e) {
            if (selectedOrder.length === 0) {
                e.preventDefault();
                alert('অনুগ্রহ করে অন্তত একটি কলাম সিলেক্ট করুন।');
            }
        });
    }

</script>
@endsection
