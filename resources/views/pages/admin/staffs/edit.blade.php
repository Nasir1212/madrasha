@extends('layouts.admin')
@section('content')

    <div class="card shadow">
        <div class="card-header bg-warning text-dark text-center">
            <h3>শিক্ষক ও কর্মচারীদের তথ্য সংশোধন (Edit)</h3>
        </div>
        <div class="card-body">
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
            
            <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="row g-3">
                    <div class="col-md-4">
                        <label>বাংলা নাম</label>
                        <input type="text" name="name_bn" class="form-control" value="{{ $staff->name_bn }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>ইংরেজী নাম</label>
                        <input type="text" name="name_en" class="form-control" value="{{ $staff->name_en }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>পদবী</label>
                        <input type="text" name="designation" class="form-control" value="{{ $staff->designation }}" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label>বিষয়</label>
                        <input type="text" name="subject" class="form-control" value="{{ $staff->subject }}">
                    </div>
                    <div class="col-md-4">
                        <label>ব্যাংক একাউন্ট নং</label>
                        <input type="text" name="bank_account_no" class="form-control" value="{{ $staff->bank_account_no }}">
                    </div>
                    <div class="col-md-4">
                        <label>এন.আই.ডি নং</label>
                        <input type="text" name="nid_no" class="form-control" value="{{ $staff->nid_no }}">
                    </div>
                    
                    <div class="col-md-4">
                        <label>নিয়োগ তারিখ</label>
                        <input type="date" name="appointment_date" class="form-control" value="{{ $staff->appointment_date }}">
                    </div>
                    <div class="col-md-4">
                        <label>ইনডেক্স নং</label>
                        <input type="text" name="index_no" class="form-control" value="{{ $staff->index_no }}">
                    </div>
                    <div class="col-md-4">
                        <label>মোবাইল নং</label>
                        <input type="text" name="mobile_no" class="form-control" value="{{ $staff->mobile_no }}">
                    </div>
                    
                    <div class="col-md-4">
                        <label>বেতন কোড</label>
                        <input type="text" name="salary_code" class="form-control" value="{{ $staff->salary_code }}">
                    </div>
                    <div class="col-md-4">
                        <label>জন্ম তারিখ</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ $staff->date_of_birth }}">
                    </div>
                    <div class="col-md-4">
                        <label>যোগদান তারিখ</label>
                        <input type="date" name="joining_date" class="form-control" value="{{ $staff->joining_date }}">
                    </div>
                    
                    <div class="col-md-4">
                        <label>MPO Type</label>
                        <select name="mpo_type" class="form-select">
                            <option value="MPO" {{ $staff->mpo_type == 'MPO' ? 'selected' : '' }}>MPO</option>
                            <option value="Non-MPO" {{ $staff->mpo_type == 'Non-MPO' ? 'selected' : '' }}>Non-MPO</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label> ঠিকানা </label>
                        <input type="text" name="address" class="form-control" value="{{ $staff->address }}">
                    </div>
                    <div class="col-md-4">
                        <label>ছবি (পরিবর্তন করতে চাইলে সিলেক্ট করুন)</label>
                        <input type="file" name="photo" class="form-control">
                        @if($staff->photo)
                            <div class="mt-2">
                                <small class="text-muted">বর্তমান ছবি:</small> <br>
                                <img src="https://img.fbasm.edu.bd/{{ $staff->photo }}" alt="Photo" style="max-width:80px; border: 1px solid #ddd; padding: 2px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary px-5">ফিরে যান</a>
                    <button type="submit" class="btn btn-warning px-5">আপডেট করুন</button>
                </div>
            </form>
        </div>
    </div>
@endsection