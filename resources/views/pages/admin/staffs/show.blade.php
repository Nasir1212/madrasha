@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    @if($staff->photo)
                        <img src="https://img.fbasm.edu.bd/{{ $staff->photo }}" alt="{{ $staff->name_en }}" class="rounded img-thumbnail mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Photo" alt="No Photo" class="rounded img-thumbnail mb-3">
                    @endif
                    <h5 class="fw-bold">{{ $staff->name_bn }}</h5>
                    <p class="text-muted">{{ $staff->designation }}</p>
                    <span class="badge {{ $staff->mpo_type == 'MPO' ? 'bg-success' : 'bg-secondary' }}">{{ $staff->mpo_type }}</span>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> তথ্য সংশোধন করুন</a>
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> তালিকায় ফিরে যান</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> বিস্তারিত প্রোফাইল</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="35%">নাম (বাংলা)</th>
                            <td>{{ $staff->name_bn }}</td>
                        </tr>
                        <tr>
                            <th>Name (English)</th>
                            <td>{{ $staff->name_en }}</td>
                        </tr>
                        <tr>
                            <th>পদবী</th>
                            <td>{{ $staff->designation }}</td>
                        </tr>
                        <tr>
                            <th>বিষয়</th>
                            <td>{{ $staff->subject ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>মোবাইল নম্বর</th>
                            <td>{{ $staff->mobile_no }}</td>
                        </tr>
                        <tr>
                            <th>এন.আই.ডি (NID) নম্বর</th>
                            <td>{{ $staff->nid_no }}</td>
                        </tr>
                        <tr>
                            <th>ব্যাংক একাউন্ট নম্বর</th>
                            <td>{{ $staff->bank_account_no }}</td>
                        </tr>
                        <tr>
                            <th>ইনডেক্স নম্বর</th>
                            <td>{{ $staff->index_no ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>বেতন কোড</th>
                            <td>{{ $staff->salary_code ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>জন্ম তারিখ</th>
                            <td>{{ $staff->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>নিয়োগের তারিখ</th>
                            <td>{{ $staff->appointment_date }}</td>
                        </tr>
                        <tr>
                            <th>যোগদানের তারিখ</th>
                            <td>{{ $staff->joining_date }}</td>
                        </tr>
                        <tr>
                            <th>ঠিকানা</th>
                            <td>{{ $staff->address ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection