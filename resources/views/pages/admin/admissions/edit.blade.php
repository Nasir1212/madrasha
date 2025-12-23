 @extends('layouts.admin')
@section('content')
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<style>
body {
    font-family: "Noto Sans Bengali", "SolaimanLipi", sans-serif;
    background: #f8f9fa;
}
.section-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
    padding-bottom: 6px;
    border-bottom: 2px solid #0d6efd;
    color: #0d6efd;
}
.card {
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.07);
}
label {
    font-weight: 600;
    margin-bottom: 4px;
}
#previewImage {
    width: 120px;
    height: 120px;
    border: 1px solid #999;
    margin-top: 8px;
    display: block;
    object-fit: cover;
    background: white;
}
</style>
</head>
<body>
<div class="container py-4">

<form id="admissionForm" action="{{ route('admin.admissions.update', $student->id) }}
 " method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf
@method('PUT')

<div class="card-layout">



<!-- ১. ছাত্র/ছাত্রীর তথ্য -->
<div class="card">
<div class="card-body">
<div class="section-title">১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য</div>
<div class="row g-3">
<div class="col-md-6">
<label>নামের প্রথম অংশ (বাংলা)</label>
<input type="text" name="name_bn_first" class="form-control" value="{{ old('name_bn_first', $student->name_bn_first) }}">
</div>
<div class="col-md-6">
<label>নামের শেষ অংশ (বাংলা)</label>
<input type="text" name="name_bn_last" class="form-control" value="{{ old('name_bn_last', $student->name_bn_last) }}">
</div>
<div class="col-md-6">
<label>নামের প্রথম অংশ (English)</label>
<input type="text" name="name_en_first" class="form-control" value="{{ old('name_en_first', $student->name_en_first) }}">
</div>
<div class="col-md-6">
<label>নামের শেষ অংশ (English)</label>
<input type="text" name="name_en_last" class="form-control" value="{{ old('name_en_last', $student->name_en_last) }}">
</div>
<div class="col-md-6">
<label>জন্ম তারিখ</label>
<input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}">
</div>
<div class="col-md-6">
<label>জন্ম নিবন্ধন নম্বর</label>
<input type="text" name="birth_reg_no" class="form-control" value="{{ old('birth_reg_no', $student->birth_reg_no) }}">
</div>
<div class="col-md-6">
<label>লিঙ্গ</label>
<select name="gender" class="form-select">
<option value="">-- নির্বাচন করুন --</option>
<option value="male" {{ old('gender', $student->gender)=='male'?'selected':'' }}>পুরুষ</option>
<option value="female" {{ old('gender', $student->gender)=='female'?'selected':'' }}>মহিলা</option>
</select>
</div>
<div class="col-md-6">
<label>জাতীয়তা</label>
<input type="text" name="nationality" class="form-control" value="{{ old('nationality', $student->nationality) }}">
</div>
<div class="col-md-6">
<label>ব্লাড গ্রুপ</label>
<select name="blood_group" class="form-control">
<option value="">নির্বাচন করুন</option>
@foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
<option value="{{ $bg }}" {{ old('blood_group', $student->blood_group)==$bg?'selected':'' }}>{{ $bg }}</option>
@endforeach
</select>
</div>
<div class="col-md-6">
<label>ধর্ম</label>
<select name="religion" class="form-control">
<option value="">নির্বাচন করুন</option>
@foreach(['ইসলাম'=>'Islam','হিন্দু'=>'Hindu','খ্রিস্টান'=>'Christian','বৌদ্ধ'=>'Buddhist','অন্যান্য'=>'Other'] as $label=>$value)
<option value="{{ $value }}" {{ old('religion', $student->religion)==$value?'selected':'' }}>{{ $label }}</option>
@endforeach
</select>
</div>
<div class="col-md-6">
<label>ছাত্র/ছাত্রীর ছবি</label>
<input type="file" id="imageInput" name="student_photo" class="form-control" accept="image/*">
</div>
<div class="col-md-6">
<img id="previewImage" src="https://img.fbasm.edu.bd/{{ $student->student_photo }}" alt="Preview Image">
</div>
</div>
</div>
</div>

<!-- ২. পিতা-মাতা ও অভিভাবক -->
<div class="card">
<div class="card-body">
<div class="section-title">২। পিতা-মাতা ও অভিভাবকের তথ্য</div>
<div class="row g-3">
<div class="col-md-6">
<label>পিতার নাম (বাংলা)</label>
<input type="text" name="father_bn" class="form-control" value="{{ old('father_bn', $student->father_bn) }}">
</div>
<div class="col-md-6">
<label>পিতার নাম (English)</label>
<input type="text" name="father_en" class="form-control" value="{{ old('father_en', $student->father_en) }}">
</div>
<div class="col-md-6">
<label>পিতার NID নং</label>
<input type="text" name="father_nid" class="form-control" value="{{ old('father_nid', $student->father_nid) }}">
</div>
<div class="col-md-6">
<label>পিতার জন্ম নিবন্ধন নং</label>
<input type="text" name="father_birth_reg" class="form-control" value="{{ old('father_birth_reg', $student->father_birth_reg) }}">
</div>
<div class="col-md-6">
<label>পিতার জন্ম তারিখ</label>
<input type="date" name="father_birth_date" class="form-control" value="{{ old('father_birth_date', $student->father_birth_date) }}">
</div>
<hr>
<div class="col-md-6">
<label>মাতার নাম (বাংলা)</label>
<input type="text" name="mother_bn" class="form-control" value="{{ old('mother_bn', $student->mother_bn) }}">
</div>
<div class="col-md-6">
<label>মাতার নাম (English)</label>
<input type="text" name="mother_en" class="form-control" value="{{ old('mother_en', $student->mother_en) }}">
</div>
<div class="col-md-6">
<label>মাতার NID নং</label>
<input type="text" name="mother_nid" class="form-control" value="{{ old('mother_nid', $student->mother_nid) }}">
</div>
<div class="col-md-6">
<label>মাতার জন্ম নিবন্ধন নং</label>
<input type="text" name="mother_birth_reg" class="form-control" value="{{ old('mother_birth_reg', $student->mother_birth_reg) }}">
</div>
<div class="col-md-6">
<label>মাতার জন্ম তারিখ</label>
<input type="date" name="mother_birth_date" class="form-control" value="{{ old('mother_birth_date', $student->mother_birth_date) }}">
</div>
<hr>
<div class="col-md-6">
<label>অভিভাবকের নাম</label>
<input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $student->guardian_name) }}">
</div>
<div class="col-md-6">
<label>অভিভাবকের পেশা</label>
<select name="guardian_occupation" class="form-control">
<option value="">নির্বাচন করুন</option>
@foreach(['কৃষক','দিনমজুর','ব্যবসায়ী','প্রবাসী','শিক্ষক/শিক্ষিকা','ছাত্র/ছাত্রী','বেসরকারি চাকরি','সরকারি চাকরি','গৃহিণী','ড্রাইভার','হাঁস-মুরগি/গবাদি খামারী','মিস্ত্রি','ইমাম/খতিব/মুয়াজ্জিন','অন্যান্য'] as $job)
<option value="{{ $job }}" {{ old('guardian_occupation', $student->guardian_occupation)==$job?'selected':'' }}>{{ $job }}</option>
@endforeach
</select>
</div>
<div class="col-md-6">
<label>অভিভাবকের মোবাইল নম্বর</label>
<input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone', $student->guardian_phone) }}">
</div>
</div>
</div>
</div>

<!-- ৩. ঠিকানা তথ্য -->
<div class="card">
<div class="card-body">
<div class="section-title">৩। ঠিকানা তথ্য</div>
<h6 class="fw-bold text-primary">স্থায়ী ঠিকানা</h6>
<div class="row g-3 mb-3">
<div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="perm_village" class="form-control" value="{{ old('perm_village', $student->perm_village) }}"></div>
<div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="perm_post" class="form-control" value="{{ old('perm_post', $student->perm_post) }}"></div>
<div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="perm_union" class="form-control" value="{{ old('perm_union', $student->perm_union) }}"></div>
<div class="col-md-6"><label>উপজেলা</label><input type="text" name="perm_upazila" class="form-control" value="{{ old('perm_upazila', $student->perm_upazila) }}"></div>
<div class="col-md-6"><label>জেলা</label><input type="text" name="perm_district" class="form-control" value="{{ old('perm_district', $student->perm_district) }}"></div>
</div>
<h6 class="fw-bold text-primary">বর্তমান ঠিকানা</h6>
<div class="row g-3 mb-3">
<div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="curr_village" class="form-control" value="{{ old('curr_village', $student->curr_village) }}"></div>
<div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="curr_post" class="form-control" value="{{ old('curr_post', $student->curr_post) }}"></div>
<div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="curr_union" class="form-control" value="{{ old('curr_union', $student->curr_union) }}"></div>
<div class="col-md-6"><label>উপজেলা</label><input type="text" name="curr_upazila" class="form-control" value="{{ old('curr_upazila', $student->curr_upazila) }}"></div>
<div class="col-md-6"><label>জেলা</label><input type="text" name="curr_district" class="form-control" value="{{ old('curr_district', $student->curr_district) }}"></div>
</div>
</div>
</div>

<!-- ৪. ভর্তি সংক্রান্ত তথ্য -->
<div class="card">
<div class="card-body">
<div class="section-title">৪। ভর্তি সংক্রান্ত তথ্য</div>
<div class="row g-3">
<div class="col-md-6">
<label>কোন শ্রেণীতে ভর্তি হতে চান</label>
<select name="admit_class" class="form-select">
<option value="">নির্বাচন করুন</option>
@php
$classes = ['শিশু','প্রথম','দ্বিতীয়','তৃতীয়','চতুর্থ','পঞ্চম','ষষ্ঠ','সপ্তম','অষ্টম','নবম'];
@endphp
@for($i=0;$i<=9;$i++)
<option value="{{ $i }}" {{ old('admit_class', $student->admit_class)==$i?'selected':'' }}>{{ $classes[$i] }}</option>
@endfor
</select>
</div>
<div class="col-md-6">
<label>পূর্বে যে শ্রেণীতে ছিল</label>
<select name="previous_class" class="form-select">
<option value="">নির্বাচন করুন</option>
@for($i=0;$i<=9;$i++)
<option value="{{ $i }}" {{ old('previous_class', $student->previous_class) === $i?'selected':'' }}>{{ $classes[$i] }}</option>
@endfor
</select>
</div>
<div class="col-md-6">
<label>পূর্বের বিদ্যালয়/মাদ্রাসার নাম</label>
<input type="text" name="previous_institute" class="form-control" value="{{ old('previous_institute', $student->previous_institute) }}">
</div>
<div class="col-md-6">
<label>ছাড়পত্রের নাম্বার</label>
<input type="text" name="leave_certificate_no" class="form-control" value="{{ old('leave_certificate_no', $student->leave_certificate_no) }}">
</div>
<div class="col-md-6">
<label>ছাড়পত্রের তারিখ</label>
<input type="date" name="leave_certificate_date" class="form-control" value="{{ old('leave_certificate_date', $student->leave_certificate_date) }}">
</div>
</div>
</div>
</div>




<div class="text-center mt-4 mb-5">
<button type="submit" class="btn btn-primary px-4 py-2 fw-bold">আপডেট করুন</button>
</div>

</div>
</form>
</div>

<script>
document.getElementById("imageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById("previewImage");
            img.src = e.target.result;
            img.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection