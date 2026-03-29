@extends('layouts.admin')
@section('content')

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3>শিক্ষক ও কর্মচারীদের তথ্য ফরম</h3>
        </div>
        <div class="card-body">
            @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            
            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4"><label>বাংলা নাম</label><input type="text" name="name_bn" class="form-control" required></div>
                    <div class="col-md-4"><label>ইংরেজী নাম</label><input type="text" name="name_en" class="form-control" required></div>
                    <div class="col-md-4"><label>পদবী</label><input type="text" name="designation" class="form-control" required></div>
                    
                    <div class="col-md-4"><label>বিষয়</label><input type="text" name="subject" class="form-control"></div>
                    <div class="col-md-4"><label>ব্যাংক একাউন্ট নং</label><input type="text" name="bank_account_no" class="form-control"></div>
                    <div class="col-md-4"><label>এন.আই.ডি নং</label><input type="text" name="nid_no" class="form-control"></div>
                    
                    <div class="col-md-4"><label>নিয়োগ তারিখ</label><input type="date" name="appointment_date" class="form-control"></div>
                    <div class="col-md-4"><label>ইনডেক্স নং</label><input type="text" name="index_no" class="form-control"></div>
                    <div class="col-md-4"><label>মোবাইল নং</label><input type="text" name="mobile_no" class="form-control"></div>
                    
                    <div class="col-md-4"><label>বেতন কোড</label><input type="text" name="salary_code" class="form-control"></div>
                    <div class="col-md-4"><label>জন্ম তারিখ</label><input type="date" name="date_of_birth" class="form-control"></div>
                    <div class="col-md-4"><label>যোগদান তারিখ</label><input type="date" name="joining_date" class="form-control"></div>
                    
                    <div class="col-md-4"><label>MPO Type</label>
                        <select name="mpo_type" class="form-select">
                            <option value="MPO">MPO</option>
                            <option value="Non-MPO">Non-MPO</option>
                        </select>
                    </div>
                    <div class="col-md-8"><label>ছবি</label><input type="file" name="photo" class="form-control"></div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">সংরক্ষণ করুন</button>
                </div>
            </form>
        </div>
    </div>
@endsection