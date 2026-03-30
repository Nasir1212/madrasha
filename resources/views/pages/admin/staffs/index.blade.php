@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5>Staff & Teacher List</h5>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-light btn-sm">Add Staff</a>
    </div>

    <div class="card mb-3 border-0">
        <div class="card-body bg-light">
            <form action="{{ route('admin.staff.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-2">
                        <input type="text" name="index_no" class="form-control form-control-sm" placeholder="Index No" value="{{ request('index_no') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Staff Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="designation" class="form-select form-select-sm">
                            <option value="">Designation</option>
                            <option value="Headmaster" {{ request('designation') == 'Headmaster' ? 'selected' : '' }}>Headmaster</option>
                            <option value="Assistant Teacher" {{ request('designation') == 'Assistant Teacher' ? 'selected' : '' }}>Assistant Teacher</option>
                            </select>
                    </div>
                    <div class="col-md-2">
                        <select name="mpo_type" class="form-select form-select-sm">
                            <option value="">MPO Type</option>
                            <option value="MPO" {{ request('mpo_type') == 'MPO' ? 'selected' : '' }}>MPO</option>
                            <option value="Non-MPO" {{ request('mpo_type') == 'Non-MPO' ? 'selected' : '' }}>Non-MPO</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="mobile_no" class="form-control form-control-sm" placeholder="Mobile No" value="{{ request('mobile_no') }}">
                    </div>
                    <div class="col-md-2 d-flex gap-1">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-search"></i> Search
                        </button>
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <form action="
        {{-- {{ route('admin.staff.download.doc') }} --}}
         " method="POST" id="downloadForm">
            @csrf
            <input type="hidden" name="name" value="{{ request('name') }}">
            <input type="hidden" name="designation" value="{{ request('designation') }}">
            <input type="hidden" name="mpo_type" value="{{ request('mpo_type') }}">
            <input type="hidden" name="ordered_columns" id="ordered_columns">

            <div class="p-3 bg-light rounded border mb-3">
                <h6 class="fw-bold"><i class="bi bi-check2-square"></i> ডাউনলোডের জন্য কলাম সিলেক্ট করুন:</h6>
                <div class="row">
                    <div class="col-md-3">
                        <input type="checkbox" class="column-check" value="name_bn"> নাম (বাংলা) <br>
                        <input type="checkbox" class="column-check" value="name_en"> Name (EN) <br>
                        <input type="checkbox" class="column-check" value="designation"> পদবী <br>
                        <input type="checkbox" class="column-check" value="subject"> বিষয়
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" class="column-check" value="index_no"> ইনডেক্স নং <br>
                        <input type="checkbox" class="column-check" value="bank_account_no"> ব্যাংক একাউন্ট নং <br>
                        <input type="checkbox" class="column-check" value="nid_no"> এন.আই.ডি নং <br>
                        <input type="checkbox" class="column-check" value="salary_code"> বেতন কোড
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" class="column-check" value="mobile_no"> মোবাইল নং <br>
                        <input type="checkbox" class="column-check" value="date_of_birth"> জন্ম তারিখ <br>
                        <input type="checkbox" class="column-check" value="joining_date"> যোগদান তারিখ <br>
                        <input type="checkbox" class="column-check" value="appointment_date"> নিয়োগ তারিখ
                    </div>
                    <div class="col-md-3">
                        <input type="checkbox" class="column-check" value="mpo_type"> MPO Type <br>
                        <input type="checkbox" class="column-check" value="photo"> ছবি
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-word"></i> Download Staff Data (Word)</button>
        </form>
    </div>
</div>

<div class="card mb-3 border-0">
    <div class="card-body bg-light py-2">
        <div class="row align-items-center">
            <div class="col-md-4">
                <strong>মোট জনবল: {{ $allStaff->count() }} জন</strong>
            </div>
            <div class="col-md-4 text-end">
                <form action="{{ route('admin.staff.index') }}" method="GET">
                    <input type="hidden" name="is_multiple_img" value="1">
                    <button type="submit" class="btn btn-outline-success btn-sm w-100">
                        <i class="bi bi-images"></i> Bulk Photo Upload Mode
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Staff Info</th>
                    <th>Personal Info</th>
                    <th>Employment</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            @if(request('is_multiple_img') == '1')
            <form action="
            {{-- {{ route('admin.staff.bulk-photo') }} --}}
             " method="POST" enctype="multipart/form-data">
            @csrf
            @endif

            <tbody>
                @forelse($allStaff as $key => $staff)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <strong>{{ $staff->name_bn }}</strong> <br>
                        <small class="text-muted">{{ $staff->name_en }}</small> <br>
                        @if($staff->photo)
                            <img src="https://img.fbasm.edu.bd/{{ $staff->photo }}" alt="Photo" class="mt-1 rounded" style="width:50px; height:50px; object-fit:cover;">
                        @endif
                    </td>
                    <td>
                        পদবী: {{ $staff->designation }} <br>
                        বিষয়: {{ $staff->subject ?? 'N/A' }} <br>
                        NID: {{ $staff->nid_no }}
                    </td>
                    <td>
                        ইনডেক্স: {{ $staff->index_no ?? 'N/A' }} <br>
                        যোগদান: {{ $staff->joining_date }} <br>
                        ধরণ: <span class="badge bg-info">{{ $staff->mpo_type }}</span>
                    </td>
                    <td>
                        মোবাইল: {{ $staff->mobile_no }} <br>
                        ব্যাংক: {{ $staff->bank_account_no }}
                    </td>
                    <td>
                        @if(request('is_multiple_img') == '1')
                            <input type="checkbox" class="form-check-input border-primary" name="staff_ids[]" value="{{ $staff->id }}">
                        @else
                            <a href="{{ route('admin.staff.show', $staff->id) }}" class="btn btn-xs btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-xs btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, this);">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">কোনো তথ্য পাওয়া যায়নি।</td>
                </tr>
                @endforelse
            </tbody>

            @if(request('is_multiple_img') == '1')
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="bg-white p-3 border mt-2">
                            <h6><i class="bi bi-cloud-upload"></i> সিরিয়াল অনুযায়ী ছবি আপলোড দিন</h6>
                            <input type="file" name="photos[]" class="form-control" multiple required>
                            <button type="submit" class="btn btn-success mt-2 btn-sm">Upload Serially</button>
                        </div>
                    </td>
                </tr>
            </tfoot>
            </form>
            @endif
        </table>
    </div>
</div>

<script>
    let selectedOrder = [];
    document.querySelectorAll('.column-check').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                selectedOrder.push(this.value);
            } else {
                selectedOrder = selectedOrder.filter(item => item !== this.value);
            }
            document.getElementById('ordered_columns').value = selectedOrder.join(',');
        });
    });

    document.getElementById('downloadForm').addEventListener('submit', function(e) {
        if (selectedOrder.length === 0) {
            e.preventDefault();
            alert('অনুগ্রহ করে অন্তত একটি কলাম সিলেক্ট করুন।');
        }
    });

    

    function confirmDelete(event, form) {
        event.preventDefault(); 
        
       
        var result = confirm("আপনি কি নিশ্চিতভাবে এই তথ্যটি মুছে ফেলতে চান?");
        
        if (result) {
            form.submit(); // 'Ok' দিলে ফর্ম সাবমিট হবে
        }
    }
</script>
@endsection