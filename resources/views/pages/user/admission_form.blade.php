<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ভর্তি আবেদন | ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদরাসা</title>
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/madrash_logo.png') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/madrash_logo.png') }}">
    <meta name="theme-color" content="#ffffff">

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
    display: none;
    object-fit: cover;
    background: white;
}
</style>
</head>

<body>
<div class="container py-4">
<h4 class="text-center ">ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদ্রাসা </h4>
<h5 class="text-center mb-4">উত্তর খরনা, চক্রশালা, পটিয়া চট্টগ্রাম</h5>
<h3 class="text-center mb-4">ভর্তি আবেদন</h3>

<form id="admissionForm" action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
@csrf

<div class="card-layout">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- ১. ছাত্র/ছাত্রীর তথ্য -->
<div class="card">
<div class="card-body">
<div class="section-title">১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য</div>
<div class="row g-3">
<div class="col-md-6">
    <label>নামের প্রথম অংশ (বাংলা)</label>
    <input type="text" name="name_bn_first" class="form-control" value="{{ old('name_bn_first') }}" placeholder="যেমন: মোঃ / আয়েশা">
</div>
<div class="col-md-6">
    <label>নামের শেষ অংশ (বাংলা)</label>
    <input type="text" name="name_bn_last" class="form-control" value="{{ old('name_bn_last') }}" placeholder="যেমন: হোসেন / আক্তার">
</div>
<div class="col-md-6">
    <label>নামের প্রথম অংশ (English)</label>
    <input type="text" name="name_en_first" class="form-control" value="{{ old('name_en_first') }}" placeholder="e.g. Mohammad / Ayesha">
</div>
<div class="col-md-6">
    <label>নামের শেষ অংশ (English)</label>
    <input type="text" name="name_en_last" class="form-control" value="{{ old('name_en_last') }}" placeholder="e.g. Hossain / Akter">
</div>

<div class="col-md-6 mb-3">
    <label>জন্ম তারিখ</label>
    <div class="d-flex gap-2">
        <!-- Day -->
        <select id="birth_day" class="form-select" onchange="update_date(this);">
            <option value=""> দিন </option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        
        <!-- Month -->
        <select id="birth_month" class="form-select" onchange="update_date(this);">
            <option value="">মাস </option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <!-- Year -->
        <select id="birth_year" class="form-select" onchange="update_date(this);">
            <option value="">বছর</option>
            @for ($i = date('Y'); $i >= date('Y') - 26; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <!-- Hidden input for Laravel -->
    <input type="hidden" name="birth_date" id="birth_date_hidden" value="{{ old('birth_date') }}">
</div>

<div class="col-md-6">
    <label>জন্ম নিবন্ধন নম্বর</label>
    <input type="text" name="birth_reg_no" class="form-control" value="{{ old('birth_reg_no') }}" placeholder="১৭ ডিজিটের জন্ম নিবন্ধন">
</div>

<div class="col-md-6">
    <label>লিঙ্গ</label>
    <select name="gender" class="form-select">
        <option value="">-- নির্বাচন করুন --</option>
        <option value="male" {{ old('gender')=='male'?'selected':'' }}>পুরুষ</option>
        <option value="female" {{ old('gender')=='female'?'selected':'' }}>মহিলা</option>
    </select>
</div>
<div class="col-md-6">
    <label>জাতীয়তা</label>
    <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}" placeholder="বাংলাদেশী">
</div>
<div class="col-md-6">
    <label>ব্লাড গ্রুপ</label>
    <select name="blood_group" class="form-control">
        <option value="">নির্বাচন করুন</option>
        @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>
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
            <option value="{{ $value }}" {{ old('religion') == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
<div class="col-md-6">
    <label>ছাত্র/ছাত্রীর ছবি</label>
    <input type="file" id="imageInput" name="student_photo" class="form-control" accept="image/*">
</div>
<div class="col-md-6">
    <img id="previewImage" alt="Preview Image">
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
    <input type="text" name="father_bn" class="form-control" value="{{ old('father_bn') }}">
</div>
<div class="col-md-6">
    <label>পিতার নাম (English)</label>
    <input type="text" name="father_en" class="form-control" value="{{ old('father_en') }}">
</div>
<div class="col-md-6">
    <label>পিতার NID নং</label>
    <input type="text" name="father_nid" class="form-control" value="{{ old('father_nid') }}">
</div>
<div class="col-md-6">
    <label>পিতার জন্ম নিবন্ধন নং</label>
    <input type="text" name="father_birth_reg" class="form-control" value="{{ old('father_birth_reg') }}">
</div>
<div class="col-md-6">
    <label>পিতার জন্ম তারিখ</label>
     <div class="d-flex gap-2">
        <!-- Day -->
        <select id="birth_day" class="form-select" onchange="update_date(this);">
            <option value=""> দিন </option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        
        <!-- Month -->
        <select id="birth_month" class="form-select" onchange="update_date(this);">
            <option value="">মাস </option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <!-- Year -->
        <select id="birth_year" class="form-select" onchange="update_date(this);">
            <option value="">বছর</option>
            @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <input type="hidden" name="father_birth_date" class="form-control" value="{{ old('father_birth_date') }}">
</div>
<hr>
<div class="col-md-6">
    <label>মাতার নাম (বাংলা)</label>
    <input type="text" name="mother_bn" class="form-control" value="{{ old('mother_bn') }}">
</div>
<div class="col-md-6">
    <label>মাতার নাম (English)</label>
    <input type="text" name="mother_en" class="form-control" value="{{ old('mother_en') }}">
</div>
<div class="col-md-6">
    <label>মাতার NID নং</label>
    <input type="text" name="mother_nid" class="form-control" value="{{ old('mother_nid') }}">
</div>
<div class="col-md-6">
    <label>মাতার জন্ম নিবন্ধন নং</label>
    <input type="text" name="mother_birth_reg" class="form-control" value="{{ old('mother_birth_reg') }}">
</div>
<div class="col-md-6">
    <label>মাতার জন্ম তারিখ</label>
     <div class="d-flex gap-2">
        <!-- Day -->
        <select id="birth_day" class="form-select" onchange="update_date(this);">
            <option value=""> দিন </option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        
        <!-- Month -->
        <select id="birth_month" class="form-select" onchange="update_date(this);">
            <option value="">মাস </option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <!-- Year -->
        <select id="birth_year" class="form-select" onchange="update_date(this);">
            <option value="">বছর</option>
            @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <!-- Hidden input for Laravel -->
    <input type="hidden" name="mother_birth_date" class="form-control" value="{{ old('mother_birth_date') }}">
</div>
<hr>
<div class="col-md-6">
    <label>অভিভাবকের নাম</label>
    <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name') }}">
</div>



<div class="col-md-6">
    <label>অভিভাবকের পেশা</label>
    <select name="guardian_occupation" class="form-control">
        <option value="">নির্বাচন করুন</option>

        <option value="কৃষক" {{ old('guardian_occupation') == 'কৃষক' ? 'selected' : '' }}>কৃষক</option>
        <option value="দিনমজুর" {{ old('guardian_occupation') == 'দিনমজুর' ? 'selected' : '' }}>দিনমজুর</option>
        <option value="ব্যবসায়ী" {{ old('guardian_occupation') == 'ব্যবসায়ী' ? 'selected' : '' }}>ব্যবসায়ী</option>
        <option value="প্রবাসী" {{ old('guardian_occupation') == 'প্রবাসী' ? 'selected' : '' }}>প্রবাসী</option>
        <option value="শিক্ষক/শিক্ষিকা" {{ old('guardian_occupation') == 'শিক্ষক/শিক্ষিকা' ? 'selected' : '' }}>শিক্ষক/শিক্ষিকা</option>
        <option value="ছাত্র/ছাত্রী" {{ old('guardian_occupation') == 'ছাত্র/ছাত্রী' ? 'selected' : '' }}>ছাত্র/ছাত্রী</option>
        <option value="বেসরকারি চাকরি" {{ old('guardian_occupation') == 'বেসরকারি চাকরি' ? 'selected' : '' }}>বেসরকারি চাকরি</option>
        <option value="সরকারি চাকরি" {{ old('guardian_occupation') == 'সরকারি চাকরি' ? 'selected' : '' }}>সরকারি চাকরি</option>
        <option value="গৃহিণী" {{ old('guardian_occupation') == 'গৃহিণী' ? 'selected' : '' }}>গৃহিণী</option>
        <option value="ড্রাইভার" {{ old('guardian_occupation') == 'ড্রাইভার' ? 'selected' : '' }}>ড্রাইভার</option>
        <option value="হাঁস-মুরগি/গবাদি খামারী" {{ old('guardian_occupation') == 'হাঁস-মুরগি/গবাদি খামারী' ? 'selected' : '' }}>হাঁস-মুরগি/গবাদি খামারী</option>
        <option value="মিস্ত্রি" {{ old('guardian_occupation') == 'মিস্ত্রি' ? 'selected' : '' }}>মিস্ত্রি</option>
        <option value="ইমাম/খতিব/মুয়াজ্জিন" {{ old('guardian_occupation') == 'ইমাম/খতিব/মুয়াজ্জিন' ? 'selected' : '' }}>ইমাম/খতিব/মুয়াজ্জিন</option>
        <option value="অন্যান্য" {{ old('guardian_occupation') == 'অন্যান্য' ? 'selected' : '' }}>অন্যান্য</option>

    </select>
</div>


<div class="col-md-6">
    <label>অভিভাবকের মোবাইল নম্বর</label>
    <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone') }}">
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
<div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="perm_village" class="form-control" value="{{ old('perm_village') }}"></div>
<div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="perm_post" class="form-control" value="{{ old('perm_post') }}"></div>
<div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="perm_union" class="form-control" value="{{ old('perm_union') }}"></div>
<div class="col-md-6"><label>উপজেলা</label><input type="text" name="perm_upazila" class="form-control" value="{{ old('perm_upazila') }}"></div>
<div class="col-md-6"><label>জেলা</label><input type="text" name="perm_district" class="form-control" value="{{ old('perm_district') }}"></div>
</div>
<h6 class="fw-bold text-primary">বর্তমান ঠিকানা</h6>
<div class="row g-3 mb-3">
<div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="curr_village" class="form-control" value="{{ old('curr_village') }}"></div>
<div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="curr_post" class="form-control" value="{{ old('curr_post') }}"></div>
<div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="curr_union" class="form-control" value="{{ old('curr_union') }}"></div>
<div class="col-md-6"><label>উপজেলা</label><input type="text" name="curr_upazila" class="form-control" value="{{ old('curr_upazila') }}"></div>
<div class="col-md-6"><label>জেলা</label><input type="text" name="curr_district" class="form-control" value="{{ old('curr_district') }}"></div>
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
<option value=""  selected> নির্বাচন করুন </option>

@php
    $classes = [
        0 => 'শিশু',
        1 => 'প্রথম',
        2 => 'দ্বিতীয়',
        3 => 'তৃতীয়',
        4 => 'চতুর্থ',
        5 => 'পঞ্চম',
        6 => 'ষষ্ঠ',
        7 => 'সপ্তম',
        8 => 'অষ্টম',
        9 => 'নবম',
    ];
@endphp

@for($i = 0; $i <= 9; $i++)
    <option value="{{ $i }}"  {{ old('admit_class') === $i ? 'selected' : '' }}    >
         {{ $classes[$i] }}
    </option>
@endfor

</select>
</div>
<div class="col-md-6">
<label>পূর্বে যে শ্রেণীতে ছিল</label>
<select name="previous_class" class="form-select">
<option value=" " selected='true' > নির্বাচন করুন </option>

@php
    $classes = [
        0 => 'শিশু',
        1 => 'প্রথম',
        2 => 'দ্বিতীয়',
        3 => 'তৃতীয়',
        4 => 'চতুর্থ',
        5 => 'পঞ্চম',
        6 => 'ষষ্ঠ',
        7 => 'সপ্তম',
        8 => 'অষ্টম',
        9 => 'নবম',
    ];
@endphp

@for($i = 0; $i <= 9; $i++)
    <option value="{{ $i }}" {{ old('previous_class') === $i ? 'selected' : '' }}>
        {{ $classes[$i] }}
    </option>
@endfor


</select>
</div>

<div class="col-md-6">
<label>পূর্বের বিদ্যালয়/মাদ্রাসার নাম</label>
<input type="text" name="previous_institute" class="form-control" value="{{ old('previous_institute') }}">
</div>
<div class="col-md-6">
<label>ছাড়পত্রের নাম্বার</label>
<input type="text" name="leave_certificate_no" class="form-control" value="{{ old('leave_certificate_no') }}">
</div>
<div class="col-md-6">
<label>ছাড়পত্রের তারিখ</label>
    <div class="d-flex gap-2">
        <!-- Day -->
        <select id="birth_day" class="form-select" onchange="update_date(this);">
            <option value=""> দিন </option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        
        <!-- Month -->
        <select id="birth_month" class="form-select" onchange="update_date(this);">
            <option value="">মাস </option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <!-- Year -->
        <select id="birth_year" class="form-select" onchange="update_date(this);">
            <option value="">বছর</option>
            @for ($i = date('Y'); $i >= date('Y') - 3; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

<input type="hidden" name="leave_certificate_date" class="form-control" value="{{ old('leave_certificate_date') }}">
</div>
</div>
</div>
</div>

<!-- ৫. অঙ্গীকার -->
<div class="card">
<div class="card-body">
<div class="section-title">৫। অঙ্গীকার</div>
<label>ছাত্র/ছাত্রীর অঙ্গীকার</label>
<div class="form-control mb-3" readonly>
এই মর্মে প্রত্যয়ন করছি যে, অত্র মাদ্রাসার সকল নিয়মাবলী মেনে চলবো। অত্র মাদ্রাসায় অধ্যয়নকালীন সময় যে কোন রাজনৈতিক দল বা উপদলের সাথে প্রকাশ্যে বা অপ্রকাশ্যভাবে জড়িত থাকবো না । চালচলন, পোষাক পরিচ্ছন্ন ও চুল-দাড়ি সুন্নত মোতাবেক রাখবো । কোন অবস্থাতেই মাদ্রসার ভাবমুর্তি নষ্ট হয় এমন কোন কাজে লিপ্ত থাকবো না । উপরোক্ত শর্তের মধ্যে যে কোন একটি ব্যাতিক্রম হলে মাদ্রাসার কর্তৃপক্ষের যে কোন শাস্তি আমি বিনা দ্বিধায় মেনে নিতে বাধ্য থাকিবো।
</div>
<label>অভিভাবকের অঙ্গীকার</label>
<div class="form-control" readonly>
* আমি অভিভাবক  হিসাবে অঙ্গীকার করিতেছি যে, আমার ছেলে/মেয়ে মাদ্রাসার যাবতীয় নিয়ম কানুন মেনে চলবে। অত্র মাদ্রাসার ছাড়পত্র ছাড়া অন্য কোন প্রতিষ্ঠানে ভর্তি করাবো না।
</div>
</div>
</div>

<!-- ৬. সংযুক্তি -->
<div class="card">
<div class="card-body">
<div class="section-title">৬। সংযুক্তি</div>
<label>ক. ছাত্র/ছাত্রীর জন্ম নিবন্ধন কপি</label><br>
<label>খ. পিতা-মাতার  NID কপি (উভয়ের) </label><br>
<label>গ. পূর্বের বিদ্যালয়ের ছাড়পত্র (যদি থাকে)</label><br>
<div>* সকল সংযুক্তি অবশ্যই প্রতিষ্ঠানে জমা দিতে হবে।</div>
</div>
</div>

</div>

<!-- Submit -->
<div class="text-center mt-4 mb-5">
    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">ফর্ম জমা দিন</button>
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

function update_date(evt) {


    const wrapper = evt.parentElement.parentElement;
    const selects = wrapper.getElementsByTagName('select');
var day, month, year;
    for (const key in selects) {
        if (!Object.hasOwn(selects, key)) continue;

        const element = selects[key];

        if (element.id === 'birth_day') {
             day = element.value;
        }
        if (element.id === 'birth_month') {
             month = element.value;
        }
        if (element.id === 'birth_year') {
             year = element.value;
        }

    
    }

     if (day && month && year) {
        wrapper.getElementsByTagName('input')[0].value =
            `${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
    } else {
        wrapper.getElementsByTagName('input')[0].value = '';
    }

    // console.log('Date update function called', wrapper.getElementsByTagName('input')[0].value);
    // console.log('Date update function called id is ', evt.id);
}




</script>

<script>
// function update_date(el) {

//     // পুরো wrapper ধরছি
//     const wrapper = el.closest('.col-md-6');
//  const day   = wrapper.querySelector('.birth-day')?.value;
//     console.log('Wrapper:', day);
//     return 0;

//     // const day   = wrapper.querySelector('.birth-day')?.value;
//     // const month = wrapper.querySelector('.birth-month')?.value;
//     // const year  = wrapper.querySelector('.birth-year')?.value;

//     const hiddenInput = wrapper.querySelector('.birth-date-hidden');

//     if (day && month && year) {
//         const formattedDate =
//             `${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

//         hiddenInput.value = formattedDate;
//     } else {
//         hiddenInput.value = '';
//     }

//     console.log('Birth Date:', hiddenInput.value);
// }
</script>

</body>
</html>
