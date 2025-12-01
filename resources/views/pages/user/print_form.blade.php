<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Admission Form</title>

<style>
    @font-face {
        font-family: 'SolaimanLipi';
        src: url('https://cdn.jsdelivr.net/gh/sh4hids/webfonts@main/solaimanlipi/SolaimanLipi.woff');
    }

    body {
        font-family: SolaimanLipi, sans-serif;
        background: #f2f2f2;
        padding: 20px;
    }

    /* Main form */
    .form-wrapper {
        width: 900px;
        margin: auto;
        background: #fff;
        padding: 25px 40px;
        border: 2px solid #000;
        position: relative;
        overflow: hidden;
    }

    /* Background Watermark */
    .watermark-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        opacity: 0.03;   /* হালকা দাগ */
        transform: translate(-50%, -50%);
        width: 600px;
        z-index: 0;
    }

   .qr-box {
    position: absolute;
    bottom: 11px;
    right: 16px;
    width: 85px;
    opacity: 0.5;
    z-index: 0;
}
.qr-box1 {
    position: absolute;
    top: 285px;
    right: 16px;
    width: 85px;
    opacity: 0.5;
    z-index: 0;
}

    .photo-box {
        float: right;
        width: 120px;
        height: 80px;
        border: 1px solid #000;
        text-align: center;
        padding-top: 55px;
        z-index: 5;
        position: relative;
    }

    .line {
        border-bottom: 1px dotted #000;
        display: inline-block;
        width: 450px;
    }

    .small {
        border-bottom: 1px dotted #000;
        display: inline-block;
        width: 180px;
    }

    .section-title {
        margin-top: 22px;
        font-weight: bold;
        border-bottom: 1px solid #000;
        padding-bottom: 4px;
    }

</style>
</head>

<body>

<div class="form-wrapper" id="formArea">

    <!-- Background Watermark Image -->
    <img  src="{{asset('assets/img/madrash_logo.png')}}" class="watermark-bg">

    <!-- QR Code -->
    <img id="" src=""  data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://maps.app.goo.gl/n6JTPFh3mR2ZJyab9" class="qr-box1 qr_src">
    <img id="" src=""  data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=https://maps.app.goo.gl/n6JTPFh3mR2ZJyab9" class="qr-box qr_src">
    <div style="display: flex;
    justify-content: space-between">
    <img  src="{{asset('assets/img/madrash_logo.png')}}" style="width: 100px; height: 100px;" class="">
    <div>
    <h2 style="text-align:center; margin-bottom:5px;">
        ফকির পাড়া বদর আউলিয়া সুন্নিয়া দাখিল মাদরাসা
    </h2>

    <p style="text-align:center; margin:0;">
        উত্তর খরনা, ফকির পাড়া, পটিয়া, চট্টগ্রাম | মোবাইল: ০১৮১৭-৯৩৫৩৯৭
    </p>
    <p style="text-align:center; margin:0;">
        প্রতিষ্ঠা : ২০০১ ইংরেজি | Code: 20736 | EIIN: 104764
    </p>
    </div>
    <div class="photo-box">ছবি</div>
</div>
    <h3 style="text-align:center; margin-top:18px; text-decoration:underline;">
        ভর্তি আবেদন ফরম
    </h3>

    <p>
        রোল নং: <span class="small"></span> &nbsp; &nbsp; তারিখ: <span class="small"></span>
    </p>

    <div class="section-title">ছাত্র/ছাত্রীর তথ্য</div>

    ১) ছাত্র/ছাত্রীর নাম: <span class="line"> <b> নাছির উদ্দিন (Nasir Uddin) </b></span><br><br>
    ২) পিতার নাম: <span class="line">মৃত মকবুল হোসেন (Late Mokbul Hossen)</span><br><br>
    ৩) মাতার নাম: <span class="line"></span><br><br>
    ৪) জন্ম তারিখ: <span class="small"></span> &nbsp;&nbsp; জন্ম নিবন্ধন নং: <span class="small"></span><br><br>
    ৫) বর্তমান ঠিকানা: <span class="line"></span><br><br>
    ৬) স্থায়ী ঠিকানা: <span class="line"></span><br><br>

    <div class="section-title">যোগাযোগের ঠিকানা</div>

    অভিভাবকের নাম: <span class="line"></span><br><br>
    পেশা: <span class="small"></span> &nbsp; মোবাইল: <span class="small"></span><br><br>

    <div class="section-title">শিক্ষাগত যোগ্যতা</div>

    পূর্বতন বিদ্যালয়/মাদরাসার নাম: <span class="line"></span><br><br>    
    শ্রেণি: <span class="small"></span> &nbsp; রোল নং: <span class="small"></span><br><br>
    প্রাপ্ত ফলাফল (জিপিএ/মার্কস): <span class="small"></span><br><br>

    <div class="section-title">শর্তাবলি</div>

    <p>
        আমি এই মর্মে অঙ্গীকার করছি যে, আমি মাদরাসার সকল নিয়মকানুন মেনে চলবো... (সংক্ষেপ)
    </p>

    ছাত্র/ছাত্রীর স্বাক্ষর: <span class="small"></span><br><br>

    <p>
        আমি অঙ্গীকার করছি যে, আমার ছেলে/মেয়ে মাদরাসার নির্দেশনা অনুযায়ী চলবে... (সংক্ষেপ)
    </p>

    অভিভাবকের নাম: <span class="line"></span><br><br>
    অভিভাবকের স্বাক্ষর: <span class="small"></span><br><br>

    <div class="section-title">অফিস কর্তৃক পূরণীয়</div>

    শ্রেণি: <span class="small"></span> &nbsp; টাকার রশিদ নং: <span class="small"></span><br><br>
    ভর্তি করা হলো / হলো না: <span class="line"></span><br><br>

    কর্তৃপক্ষের স্বাক্ষর: <span class="small"></span>

</div>

<!-- JS PDF + Canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
   
   // সমস্ত QR ইমেজ যাদের class="qr-box"
let qrElements = document.querySelectorAll('.qr_src');

qrElements.forEach(function(qrElement) {
    // প্রতিটি element থেকে URL নেওয়া (data-attribute থেকে)
    let qrUrl = qrElement.getAttribute('data-qr');

    let qrImg = new Image();
    qrImg.crossOrigin = "Anonymous"; // CORS সমস্যার জন্য
    qrImg.src = qrUrl;

    qrImg.onload = function() {
        // Data URL তৈরি করা
        let canvasQR = document.createElement('canvas');
        canvasQR.width = qrImg.width;
        canvasQR.height = qrImg.height;
        let ctx = canvasQR.getContext('2d');
        ctx.drawImage(qrImg, 0, 0);
        let qrDataURL = canvasQR.toDataURL('image/png');

        // QR ইমেজকে element এ assign করা
        qrElement.src = qrDataURL;
    };
});

async function makePDF() {
    const { jsPDF } = window.jspdf;

    let form = document.querySelector('#formArea');

    let canvas = await html2canvas(form, { scale: 2 });
    let img = canvas.toDataURL('image/png');

    // Legal size (216mm × 356mm)
    let pdf = new jsPDF('p', 'mm', [216, 356]);

    let width  = pdf.internal.pageSize.getWidth();
    let height = (canvas.height * width) / canvas.width;

    pdf.addImage(img, 'PNG', 0, 0, width, height);
    pdf.save("admission-form-legal.pdf");
}
window.onload = function() {
     makePDF();  // স্বয়ংক্রিয়ভাবে পিডিএফ তৈরি করতে চাইলে এই লাইনটি আনকমেন্ট করুন
   window.close();
};
</script>


{{-- <button onclick="makePDF()" style="margin:20px auto; display:block; padding:10px 20px;">
    Download PDF
</button> --}}

</body>
</html>
