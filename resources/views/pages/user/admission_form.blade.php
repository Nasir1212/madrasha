<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
.card-layout {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 25px;
}
@media (min-width: 768px) {
    .card-layout {
        grid-template-columns: repeat(1, 1fr);
    }
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

<h3 class="text-center mb-4">ভর্তি আবেদন</h3>

<form id="admissionForm" action="#" method="POST" autocomplete="off">

<div class="card-layout">

<!-- ১. ব্যক্তিগত তথ্য -->
<div class="card">
<div class="card-body">
<div class="section-title">১। ছাত্র/ছাত্রীর ব্যক্তিগত তথ্য</div>

<div class="row g-3">

<!-- বাংলা নাম -->
<div class="col-md-6">
    <label>নামের প্রথম অংশ (বাংলা)</label>
    <input type="text" name="name_bn_first" class="form-control" placeholder="যেমন: মোঃ / আয়েশা">
</div>

<div class="col-md-6">
    <label>নামের শেষ অংশ (বাংলা)</label>
    <input type="text" name="name_bn_last" class="form-control" placeholder="যেমন: হোসেন / আক্তার">
</div>

<!-- ইংরেজি নাম -->
<div class="col-md-6">
    <label>নামের প্রথম অংশ (English)</label>
    <input type="text" name="name_en_first" class="form-control" placeholder="e.g. Mohammad / Ayesha">
</div>

<div class="col-md-6">
    <label>নামের শেষ অংশ (English)</label>
    <input type="text" name="name_en_last" class="form-control" placeholder="e.g. Hossain / Akter">
</div>

<div class="col-md-6">
    <label>জন্ম তারিখ</label>
    <input type="date" name="birth_date" class="form-control">
</div>

<div class="col-md-6">
    <label>জন্ম নিবন্ধন নম্বর</label>
    <input type="text" name="birth_reg_no" class="form-control" placeholder="১৭ ডিজিটের জন্ম নিবন্ধন">
</div>

<div class="col-md-6">
    <label>লিঙ্গ</label>
    <select name="gender" class="form-select">
        <option value="">-- নির্বাচন করুন --</option>
        <option value="male">পুরুষ</option>
        <option value="female">মহিলা</option>
    </select>
</div>

<div class="col-md-6">
    <label>জাতীয়তা</label>
    <input type="text" name="nationality" class="form-control" placeholder="বাংলাদেশী">
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

<!-- ২. পিতা-মাতা -->
<div class="card">
<div class="card-body">
<div class="section-title">২। পিতা-মাতা ও অভিভাবকের তথ্য</div>

<div class="row g-3">

<div class="col-md-6">
    <label>পিতার নাম (বাংলা)</label>
    <input type="text" name="father_bn" class="form-control" placeholder="বাংলায় লিখুন">
</div>

<div class="col-md-6">
    <label>পিতার নাম (English)</label>
    <input type="text" name="father_en" class="form-control" placeholder="Write in English">
</div>

<div class="col-md-6">
    <label>পিতার NID নং</label>
    <input type="text" name="father_nid" class="form-control" placeholder="১০/১৭ ডিজিট">
</div>

<div class="col-md-6">
    <label>পিতার জন্ম নিবন্ধন নং</label>
    <input type="text" name="father_birth_reg" class="form-control" placeholder="জন্ম নিবন্ধন নম্বর">
</div>

<div class="col-md-6">
    <label>পিতার জন্ম তারিখ</label>
    <input type="date" name="father_birth_date" class="form-control">
</div>

<hr>

<div class="col-md-6">
    <label>মাতার নাম (বাংলা)</label>
    <input type="text" name="mother_bn" class="form-control" placeholder="বাংলায় লিখুন">
</div>

<div class="col-md-6">
    <label>মাতার নাম (English)</label>
    <input type="text" name="mother_en" class="form-control" placeholder="Write in English">
</div>

<div class="col-md-6">
    <label>মাতার NID নং</label>
    <input type="text" name="mother_nid" class="form-control" placeholder="১০/১৭ ডিজিট">
</div>

<div class="col-md-6">
    <label>মাতার জন্ম নিবন্ধন নং</label>
    <input type="text" name="mother_birth_reg" class="form-control" placeholder="জন্ম নিবন্ধন নম্বর">
</div>

<div class="col-md-6">
    <label>মাতার জন্ম তারিখ</label>
    <input type="date" name="mother_birth_date" class="form-control">
</div>

<hr>

<div class="col-md-6">
    <label>অভিভাবকের নাম</label>
    <input type="text" name="guardian_name" class="form-control" placeholder="অভিভাবকের পুরো নাম">
</div>

<div class="col-md-6">
    <label>অভিভাবকের মোবাইল নম্বর</label>
    <input type="text" name="guardian_phone" class="form-control" placeholder="০১XXXXXXXXX">
</div>

</div>
</div>
</div>

<!-- ঠিকানা -->
<div class="card">
<div class="card-body">

<div class="section-title">৩। ঠিকানা তথ্য</div>

<h6 class="fw-bold text-primary">স্থায়ী ঠিকানা</h6>
<div class="row g-3 mb-3">
    <div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="perm_village" class="form-control"></div>
    <div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="perm_post" class="form-control"></div>
    <div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="perm_union" class="form-control"></div>
    <div class="col-md-6"><label>উপজেলা</label><input type="text" name="perm_upazila" class="form-control"></div>
    <div class="col-md-6"><label>জেলা</label><input type="text" name="perm_district" class="form-control"></div>
</div>

<h6 class="fw-bold text-primary">বর্তমান ঠিকানা</h6>
<div class="row g-3 mb-3">
    <div class="col-md-6"><label>গ্রাম/ওয়ার্ড</label><input type="text" name="curr_village" class="form-control"></div>
    <div class="col-md-6"><label>পোস্ট অফিস</label><input type="text" name="curr_post" class="form-control"></div>
    <div class="col-md-6"><label>ইউনিয়ন</label><input type="text" name="curr_union" class="form-control"></div>
    <div class="col-md-6"><label>উপজেলা</label><input type="text" name="curr_upazila" class="form-control"></div>
    <div class="col-md-6"><label>জেলা</label><input type="text" name="curr_district" class="form-control"></div>
</div>

</div>
</div>

<!-- এডমিশন -->
<div class="card">
<div class="card-body">
<div class="section-title">৪। ভর্তি সংক্রান্ত তথ্য</div>

<div class="row g-3">

<div class="col-md-6">
    <label>কোন শ্রেণীতে ভর্তি হতে চান</label>
    <select name="admit_class" class="form-select">
        <option value="">-- নির্বাচন করুন --</option>
        <option value="0">শিশু</option>
        <option value="1">১ম</option>
        <option value="2">২য়</option>
        <option value="3">৩য়</option>
        <option value="4">৪র্থ</option>
        <option value="5">৫ম</option>
        <option value="6">৬ষ্ঠ</option>
        <option value="7">৭ম</option>
        <option value="8">৮ম</option>
        <option value="9">৯ম</option>
    </select>
</div>

<div class="col-md-6">
    <label>পূর্বে যে শ্রেণীতে ছিল</label>
    <select name="previous_class" class="form-select">
        <option value="">-- নির্বাচন করুন --</option>
        <option value="0">শিশু</option>
        <option value="1">১ম</option>
        <option value="2">২য়</option>
        <option value="3">৩য়</option>
        <option value="4">৪র্থ</option>
        <option value="5">৫ম</option>
        <option value="6">৬ষ্ঠ</option>
        <option value="7">৭ম</option>
        <option value="8">৮ম</option>
        <option value="9">৯ম</option>
    </select>
</div>

<div class="col-md-6">
    <label>পূর্বের বিদ্যালয়/মাদ্রাসার নাম</label>
    <input type="text" name="previous_institute" class="form-control" placeholder="প্রতিষ্ঠানের নাম লিখুন">
</div>

<div class="col-md-6">
    <label>ছাড়পত্রের নাম্বার</label>
    <input type="text" name="leave_certificate_no" class="form-control" placeholder="যদি থাকে">
</div>

<div class="col-md-6">
    <label>ছাড়পত্রের তারিখ</label>
    <input type="date" name="leave_certificate_date" class="form-control">
</div>

</div>
</div>
</div>

<!-- অঙ্গীকার -->
<div class="card">
<div class="card-body">
<div class="section-title">৫। অঙ্গীকার</div>

<label>ছাত্র/ছাত্রীর অঙ্গীকার</label>
<div class="form-control mb-3" readonly>
* আমি এই মর্মে প্রত্যয়ন করছি যে, অত্র মাদ্রাসার সকল নিয়মাবলী মেনে চলবো। অত্র মাদ্রাসায় অধ্যয়নকালীন সময় যে কোন রাজনৈতিক দল বা উপদলের সাথে প্রকাশ্যে বা অপ্রকাশ্যভাবে জড়িত থাকবো না । চালচলন, পোষাক পরিচ্ছন্ন ও চুল-দাড়ি সুন্নত মোতাবেক রাখবো । কোন অবস্থাতেই মাদ্রসার ভাবমুর্তি নষ্ট হয় এমন কোন কাজে লিপ্ত থাকবো না । উপরোক্ত শর্তের মধ্যে যে কোন একটি ব্যাতিক্রম হলে মাদ্রাসার কর্তৃপক্ষের যে কোন শাস্তি আমি বিনা দ্বিধায় মেনে নিতে বাধ্য থাকিবো।
</div>

<label>অভিভাবকের অঙ্গীকার</label>
<div class="form-control" readonly>
* আমি অঙ্গীকার করিতেছি যে, আমার ছেলে/মেয়ে মাদ্রাসার যাবতীয় নিয়ম কানুন মেনে চলবে। অত্র মাদ্রাসার ছাড়পত্র ছাড়া অন্য কোন মাদ্রাসা/বিদ্যালয়ে ভর্তি করাবো না।
</div>
</div>
</div>

<!-- সংযুক্তি -->
<div class="card">
<div class="card-body">
<div class="section-title">৬। সংযুক্তি</div>

<label>ক. ছাত্র/ছাত্রীর জন্ম নিবন্ধন কপি</label><br>
<label>খ. পিতা-মাতার জন্ম নিবন্ধন ও NID কপি</label><br>
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
</script>

</body>
</html>
