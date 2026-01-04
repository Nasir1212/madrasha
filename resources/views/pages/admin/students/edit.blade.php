@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

<style>
body { font-family: "Noto Sans Bengali", "SolaimanLipi", sans-serif; background: #f8f9fa; }
.section-title { font-size: 18px; font-weight: 700; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 2px solid #0d6efd; color: #0d6efd; }
.card { border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.07); }
label { font-weight: 600; margin-bottom: 4px; }
input[readonly] { background-color: #f5f5f5; border: 1px solid #ccc; color: #555; cursor: not-allowed; }
#previewImage { width: 120px; height: 120px; border: 1px solid #999; margin-top: 8px; display: none; object-fit: cover; background: white; }
</style>

<h3 class="text-center mb-4">{{ isset($student) ? 'শিক্ষার্থী তথ্য সম্পাদনা করুন' : 'শিক্ষার্থী তথ্য যোগ করুন' }}</h3>

<form id="admissionForm"
      action="{{ isset($student) ? route('admin.students.update', $student->id) : route('admin.students.store') }}"
      method="POST"
      enctype="multipart/form-data"
      autocomplete="off">

    @csrf
    @if(isset($student))
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card-layout">

        <!-- ১. ছাত্র/ছাত্রীর তথ্য -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="section-title">১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>নামের প্রথম অংশ (বাংলা)</label>
                        <input type="text" name="name_bn_first" class="form-control" value="{{ old('name_bn_first', $student->name_bn_first ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>নামের শেষ অংশ (বাংলা)</label>
                        <input type="text" name="name_bn_last" class="form-control" value="{{ old('name_bn_last', $student->name_bn_last ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>নামের প্রথম অংশ (English)</label>
                        <input type="text" name="name_en_first" class="form-control" value="{{ old('name_en_first', $student->name_en_first ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>নামের শেষ অংশ (English)</label>
                        <input type="text" name="name_en_last" class="form-control" value="{{ old('name_en_last', $student->name_en_last ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>জন্ম তারিখ</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>জন্ম নিবন্ধন নম্বর</label>
                        <input type="text" name="birth_reg_no" class="form-control" value="{{ old('birth_reg_no', $student->birth_reg_no ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label>লিঙ্গ</label>
                        <select name="gender" class="form-select">
                            <option value="">-- নির্বাচন করুন --</option>
                            <option value="male" {{ (old('gender', $student->gender ?? '') == 'male') ? 'selected' : '' }}>পুরুষ</option>
                            <option value="female" {{ (old('gender', $student->gender ?? '') == 'female') ? 'selected' : '' }}>মহিলা</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>জাতীয়তা</label>
                        <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $student->nationality ?? 'বাংলাদেশী') }}">
                    </div>
                    <div class="col-md-6">
                        <label>ব্লাড গ্রুপ</label>
                        <select name="blood_group" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group', $student->blood_group ?? '') == $bg ? 'selected' : '' }}>
                                    {{ $bg }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>ধর্ম</label>
                        <select name="religion" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            @foreach(['ইসলাম'=>'Islam','হিন্দু'=>'Hindu','খ্রিস্টান'=>'Christian','বৌদ্ধ'=>'Buddhist','অন্যান্য'=>'Other'] as $label => $value)
                                <option value="{{ $value }}" {{ old('religion', $student->religion ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>ছাত্র/ছাত্রীর ছবি</label>
                        <input type="file" id="imageInput" name="student_photo" class="form-control" accept="image/*">
                        @if(isset($student) && $student->student_photo)
                            <img id="previewImage" src="https://img.fbasm.edu.bd/{{ $student->student_photo }}" alt="Preview Image" style="display:block;">
                        @else
                            <img id="previewImage" alt="Preview Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- ২. পিতা-মাতা ও অভিভাবক -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="section-title">২। পিতা-মাতা ও অভিভাবকের তথ্য</div>
                <div class="row g-3">
                    <div class="col-md-6"><label>পিতার নাম (বাংলা)</label><input type="text" name="father_bn" class="form-control" value="{{ old('father_bn', $student->father_bn ?? '') }}"></div>
                    <div class="col-md-6"><label>পিতার নাম (English)</label><input type="text" name="father_en" class="form-control" value="{{ old('father_en', $student->father_en ?? '') }}"></div>
                    <div class="col-md-6"><label>পিতার NID নং</label><input type="text" name="father_nid" class="form-control" value="{{ old('father_nid', $student->father_nid ?? '') }}"></div>
                    <div class="col-md-6"><label>পিতার জন্ম নিবন্ধন নং</label><input type="text" name="father_birth_reg" class="form-control" value="{{ old('father_birth_reg', $student->father_birth_reg ?? '') }}"></div>
                    <div class="col-md-6"><label>পিতার জন্ম তারিখ</label><input type="date" name="father_birth_date" class="form-control" value="{{ old('father_birth_date', $student->father_birth_date ?? '') }}"></div>

                    <hr>

                    <div class="col-md-6"><label>মাতার নাম (বাংলা)</label><input type="text" name="mother_bn" class="form-control" value="{{ old('mother_bn', $student->mother_bn ?? '') }}"></div>
                    <div class="col-md-6"><label>মাতার নাম (English)</label><input type="text" name="mother_en" class="form-control" value="{{ old('mother_en', $student->mother_en ?? '') }}"></div>
                    <div class="col-md-6"><label>মাতার NID নং</label><input type="text" name="mother_nid" class="form-control" value="{{ old('mother_nid', $student->mother_nid ?? '') }}"></div>
                    <div class="col-md-6"><label>মাতার জন্ম নিবন্ধন নং</label><input type="text" name="mother_birth_reg" class="form-control" value="{{ old('mother_birth_reg', $student->mother_birth_reg ?? '') }}"></div>
                    <div class="col-md-6"><label>মাতার জন্ম তারিখ</label><input type="date" name="mother_birth_date" class="form-control" value="{{ old('mother_birth_date', $student->mother_birth_date ?? '') }}"></div>

                    <hr>

                    <div class="col-md-6"><label>অভিভাবকের নাম</label><input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $student->guardian_name ?? '') }}"></div>
                    <div class="col-md-6"><label>অভিভাবকের পেশা</label>
                        <select name="guardian_occupation" class="form-control">
                            <option value="">নির্বাচন করুন</option>
                            @foreach(['কৃষক','দিনমজুর','ব্যবসায়ী','প্রবাসী','শিক্ষক/শিক্ষিকা','ছাত্র/ছাত্রী','বেসরকারি চাকরি','সরকারি চাকরি','গৃহিণী','ড্রাইভার','হাঁস-মুরগি/গবাদি খামারী','মিস্ত্রি','ইমাম/খতিব/মুয়াজ্জিন','অন্যান্য'] as $occ)
                                <option value="{{ $occ }}" {{ old('guardian_occupation', $student->guardian_occupation ?? '') == $occ ? 'selected' : '' }}>{{ $occ }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>অভিভাবকের মোবাইল নম্বর</label><input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone', $student->guardian_phone ?? '') }}"></div>
                </div>
            </div>
        </div>

        <!-- ৩. ঠিকানা তথ্য -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="section-title">৩। ঠিকানা তথ্য</div>
                <h6 class="fw-bold text-primary">স্থায়ী ঠিকানা</h6>
                <div class="row g-3 mb-3">
                    @foreach(['village','post','union','upazila','district'] as $field)
                        <div class="col-md-6">
                            <label>{{ ucfirst($field) }}</label>
                            <input type="text" name="perm_{{ $field }}" class="form-control" value="{{ old('perm_'.$field, $student->{'perm_'.$field} ?? '') }}">
                        </div>
                    @endforeach
                </div>

                <h6 class="fw-bold text-primary">বর্তমান ঠিকানা
                    <label class="form-check-label ms-2 text-dark">
                        <input type="checkbox" name="same_as_perm" class="form-check-input"> স্থায়ী ঠিকানার সাথে মিল ?
                    </label>
                </h6>
                <div class="row g-3 mb-3">
                    @foreach(['village','post','union','upazila','district'] as $field)
                        <div class="col-md-6">
                            <label>{{ ucfirst($field) }}</label>
                            <input type="text" name="curr_{{ $field }}" class="form-control" value="{{ old('curr_'.$field, $student->{'curr_'.$field} ?? '') }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ৪. একাডেমিক তথ্য -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="section-title">৪। একাডেমিক তথ্য</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>শ্রেণি</label>
                        <select name="class" class="form-select">
                            <option value="">নির্বাচন করুন</option>
                            @php
                                $classes = ['শিশু','প্রথম','দ্বিতীয়','তৃতীয়','চতুর্থ','পঞ্চম','ষষ্ঠ','সপ্তম','অষ্টম','নবম','দশম'];
                            @endphp
                            @foreach($classes as $i => $cls)
                                <option value="{{ $i }}" {{ old('class', $student->currentAcademic->class ?? '') == $i ? 'selected' : '' }}>{{ $cls }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>শ্রেণি রোল নাম্বার</label><input type="text" name="roll" class="form-control" value="{{ old('roll', $student->currentAcademic->roll ?? '') }}"></div>
                    <div class="col-md-6"><label>সেশন বছর</label><input type="text" name="session" class="form-control" value="{{ old('session', $student->currentAcademic->session) }}"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4 mb-5">
        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">{{ isset($student) ? 'আপডেট করুন' : 'যোগ করুন' }}</button>
    </div>

</form>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Image preview
    const imageInput = document.getElementById("imageInput");
    const previewImage = document.getElementById("previewImage");
    imageInput?.addEventListener("change", function(e){
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){ previewImage.src = e.target.result; previewImage.style.display='block'; }
            reader.readAsDataURL(file);
        }
    });

    // Datepicker
    document.querySelectorAll('input[type="date"]').forEach(el => el.type='text');
    flatpickr(".datepicker", { dateFormat: "Y-m-d", altInput: true, altFormat: "d-m-Y", allowInput:true, maxDate:"today", yearSelectorType:"dropdown" });

    // Same as permanent address
    const checkbox = document.querySelector('input[name="same_as_perm"]');
    checkbox?.addEventListener('change', function(){
        const fields=['village','post','union','upazila','district'];
        fields.forEach(f=>{
            const perm = document.querySelector('input[name="perm_'+f+'"]');
            const curr = document.querySelector('input[name="curr_'+f+'"]');
            if(this.checked){ curr.value=perm.value; curr.readOnly=true; perm.addEventListener('input',()=>{ if(checkbox.checked) curr.value=perm.value; }); }
            else curr.readOnly=false;
        });
    });
});
</script>

@endsection
