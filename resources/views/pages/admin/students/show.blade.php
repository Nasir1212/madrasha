@extends('layouts.admin')
@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    /* লেবেল ও ভ্যালু স্টাইল */
    .form-display-label {
        font-weight: 600;
        color: #1c3faa;
    }

    .form-display-value {
        background-color: #f8f9fa;
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        display: block;
        width: 100%;
    }

    .section-title {
        background-color: #1c3faa;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: 20px;
        font-weight: 600;
    }

    .student-photo {
        max-width: 180px;
        border-radius: 8px;
        border: 2px solid #1c3faa;
        margin-top: 10px;
    }

    /* Print button */
    .no-print {
        display: block;
    }

    /* Print styles */
    @media print {
        /* শুধু ডাটা অংশ দেখাবে */
        body * {
            visibility: hidden;
        }

        #printableArea, #printableArea * {
            visibility: visible;
        }

        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        /* নেভিগেশন, হেডার, ফুটার লুকানো */
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container">
    <!-- Print Button -->
    <div class="d-flex justify-content-end mb-3 no-print">
        <button onclick="window.print()" class="btn btn-success">Print Student Info</button>
    </div>

    <!-- Printable Data -->
    <div id="printableArea">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Student Details</h3>
            </div>
            <div class="card-body">

                <!-- PERSONAL INFO -->
                <div class="section-title">Personal Information</div>
                <div class="row g-3 mt-2">
                    <div class="col-md-3">
                        <label class="form-display-label">First Name (BN)</label>
                        <span class="form-display-value">{{ $student->first_name_bn }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Last Name (BN)</label>
                        <span class="form-display-value">{{ $student->last_name_bn }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">First Name (EN)</label>
                        <span class="form-display-value">{{ $student->first_name_en }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Last Name (EN)</label>
                        <span class="form-display-value">{{ $student->last_name_en }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Gender</label>
                        <span class="form-display-value">{{ $student->gender }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Blood Type</label>
                        <span class="form-display-value">{{ $student->blood_type ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Religion</label>
                        <span class="form-display-value">{{ $student->religion ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Birth Date</label>
                        <span class="form-display-value">{{ $student->birth_date ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-display-label">Birth Registration No.</label>
                        <span class="form-display-value">{{ $student->birth_reg_no ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-display-label">Student Photo</label>
                        @if($student->photo)
                            <img src="{{ asset('storage/'.$student->photo) }}" class="student-photo" alt="Student Photo">
                        @else
                            <span class="form-display-value">No Photo</span>
                        @endif
                    </div>
                </div>

                <!-- PARENTS INFO -->
                <div class="section-title">Parents Information</div>
                <div class="row g-3 mt-2">
                    <div class="col-md-3">
                        <label class="form-display-label">Father Name (BN)</label>
                        <span class="form-display-value">{{ $student->father_name_bn }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Mother Name (BN)</label>
                        <span class="form-display-value">{{ $student->mother_name_bn }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Father Name (EN)</label>
                        <span class="form-display-value">{{ $student->father_name_en }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Mother Name (EN)</label>
                        <span class="form-display-value">{{ $student->mother_name_en }}</span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-display-label">Parents Contact</label>
                        <span class="form-display-value">{{ $student->parents_contact }}</span>
                    </div>
                </div>

                <!-- ADDRESS INFO -->
                <div class="section-title">Address Information</div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label class="form-display-label">Full Address</label>
                        <span class="form-display-value">{{ $student->full_address }}</span>
                    </div>
                    <div class="col-md-2">
                        <label class="form-display-label">Zip Code</label>
                        <span class="form-display-value">{{ $student->zip_code }}</span>
                    </div>
                    <div class="col-md-2">
                        <label class="form-display-label">Police Station</label>
                        <span class="form-display-value">{{ $student->police_station }}</span>
                    </div>
                    <div class="col-md-2">
                        <label class="form-display-label">Nationality</label>
                        <span class="form-display-value">{{ $student->nationality }}</span>
                    </div>
                </div>

                <!-- ACADEMIC INFO -->
                <div class="section-title">Academic Information</div>
                <div class="row g-3 mt-2">
                    @if($student->currentAcademic)
                        <div class="col-md-4">
                            <label class="form-display-label">Class</label>
                            <span class="form-display-value">{{ $student->currentAcademic->class }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-display-label">Roll</label>
                            <span class="form-display-value">{{ $student->currentAcademic->roll }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-display-label">Session</label>
                            <span class="form-display-value">{{ $student->currentAcademic->session }}</span>
                        </div>
                    @else
                        <div class="col-12">
                            <span class="form-display-value">No academic information found.</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
