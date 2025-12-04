<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Admission Form</title>
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
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

    .form-wrapper {
        width: 900px;
        margin: auto;
        background: #fff;
        padding: 25px 40px;
        border: 2px solid #000;
        position: relative;
        overflow: hidden;
    }

    .watermark-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        opacity: 0.03;
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
        height: 140px;
        border: 1px solid #000;
        text-align: center;
        z-index: 5;
        overflow:hidden;
        position: relative;
    }

    .photo-box img{
        width: 120px;
        height: 140px;
        object-fit: cover;
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

    <img src="{{asset('assets/img/madrash_logo.png')}}" class="watermark-bg">

    <img data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ route('print_form',['form_no'=>$admission->form_no]) }}" class="qr-box1 qr_src">
    <img data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ route('print_form',['form_no'=>$admission->form_no]) }}" class="qr-box qr_src">

    <div style="display: flex; justify-content: space-between">
        <img src="{{asset('assets/img/madrash_logo.png')}}" style="width: 100px; height: 100px;">
        
        <div>
            <h2 style="text-align:center; margin-bottom:0px;">المَدْرَسَةُ فَقِيْر فَارَا بَدَارْ اَوْلِيَا سُنِّيْةُ الدَخِيْل</h2>
            <h2 style="text-align: center; margin-bottom: 5px;margin-top: 0px;">ফকির পাড়া বদর আউলিয়া সুন্নিয়া দাখিল মাদরাসা</h2>

            <p style="text-align:center; margin:0;">
                উত্তর খরনা, ফকির পাড়া, পটিয়া, চট্টগ্রাম | মোবাইল: ০১৮১৭-৯৩৫৩৯৭
            </p>
            <p style="text-align:center; margin:0;">
                প্রতিষ্ঠা : ২০০১ ইংরেজি | Code: 20736 | EIIN: 104764
            </p>
        </div>

        <div class="photo-box">
            @if($admission->student_photo)
                <img src="{{ asset($admission->student_photo) }}">
            @else
                ছবি
            @endif
        </div>
    </div>

    <h3 style="text-align:center; margin-top:18px; text-decoration:underline;">
        ভর্তি আবেদন ফরম
    </h3>

    <p>
        ফরম নং: <span class="small"><b>{{ $admission->form_no }}</b></span>  
        &nbsp; &nbsp; 
        তারিখ: <span class="small">{{ date('d/m/Y') }}</span>
    </p>

    <div class="section-title">ছাত্র/ছাত্রীর তথ্য</div>

    ১) ছাত্র/ছাত্রীর নাম:  
    <span class="line"><b>{{ $admission->name_bn_first }} {{ $admission->name_bn_last }} ({{ $admission->name_en_first }} {{ $admission->name_en_last }})</b></span>
    <br><br>

    ২) পিতার নাম: <span class="line">{{ $admission->father_bn }} ({{ $admission->father_en }})</span><br><br>
    ৩) মাতার নাম: <span class="line">{{ $admission->mother_bn }} ({{ $admission->mother_en }})</span><br><br>

    ৪) জন্ম তারিখ: <span class="small">{{ $admission->birth_date }}</span>  
       &nbsp;&nbsp; জন্ম নিবন্ধন নং: <span class="small">{{ $admission->birth_reg_no }}</span><br><br>

    ৫) বর্তমান ঠিকানা: <span class="line" style="width:80% !important; ">
 গ্রাম/ওয়ার্ড :  <b>{{ $admission->perm_village }}</b>
পোস্ট অফিস : <b>{{ $admission->perm_post }}</b>
ইউনিয়ন : <b>{{ $admission->perm_union }}</b>
উপজেলা : <b>{{ $admission->perm_upazila }}</b>
জেলা : <b>{{ $admission->perm_district }}</b>

</span>

<br><br>
    ৬) স্থায়ী ঠিকানা: <span class="line"  style="width:80% !important; " >
        
      গ্রাম/ওয়ার্ড :  <b>{{ $admission->curr_village }}</b>
পোস্ট অফিস : <b>{{ $admission->curr_post }}</b>
ইউনিয়ন : <b>{{ $admission->curr_union }}</b>
উপজেলা : <b>{{ $admission->curr_upazila }}</b>
জেলা : <b>{{ $admission->curr_district }}</b>
        
    </span><br><br>

    <div class="section-title">যোগাযোগের ঠিকানা</div>

    অভিভাবকের নাম: <span class="line">{{ $admission->guardian_name }}</span><br><br>
    পেশা: <span class="small">{{ $admission->guardian_job }}</span>  
    মোবাইল: <span class="small">{{ $admission->guardian_phone }}</span><br><br>

    <div class="section-title"> ভর্তি সংক্রান্ত তথ্য </div>

    পূর্বতন বিদ্যালয়/মাদরাসার নাম: <span class="line">{{ $admission->previous_school }}</span><br><br>    
    শ্রেণি: <span class="small">{{ $admission->previous_class }}</span>  
    রোল নং: <span class="small">{{ $admission->previous_roll }}</span><br><br>
    প্রাপ্ত ফলাফল: <span class="small">{{ $admission->previous_result }}</span><br><br>

    <div class="section-title">শর্তাবলি</div>

    <p>
        আমি এই মর্মে অঙ্গীকার করছি যে, আমি মাদরাসার সকল নিয়মকানুন মেনে চলবো...
    </p>

    ছাত্র/ছাত্রীর স্বাক্ষর: <span class="small"></span><br><br>

    <p>
        আমি অঙ্গীকার করছি যে, আমার ছেলে/মেয়ে মাদরাসার নির্দেশনা অনুযায়ী চলবে...
    </p>

    অভিভাবকের নাম: <span class="line"></span><br><br>
    অভিভাবকের স্বাক্ষর: <span class="small"></span><br><br>

    <div class="section-title">অফিস কর্তৃক পূরণীয়</div>

    শ্রেণি: <span class="small"></span>  
    টাকার রশিদ নং: <span class="small"></span><br><br>
    ভর্তি করা হলো / হলো না: <span class="line"></span><br><br>

    কর্তৃপক্ষের স্বাক্ষর: <span class="small"></span>

</div>

<!-- JS PDF + Canvas --> <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

 <script>
  // সমস্ত QR ইমেজ যাদের class="qr-box" 

  let qrElements = document.querySelectorAll('.qr_src');
qrElements.forEach(function(qrElement) {
    let qrUrl = qrElement.getAttribute('data-qr');
    let qrImg = new Image();
    qrImg.crossOrigin = "Anonymous";
    qrImg.src = qrUrl;
    qrImg.onload = function() {
        let canvasQR = document.createElement('canvas');
        canvasQR.width = qrImg.width;
        canvasQR.height = qrImg.height;
        let ctx = canvasQR.getContext('2d');
        ctx.drawImage(qrImg, 0, 0);
        qrElement.src = canvasQR.toDataURL('image/png');
    };
});



     async function makePDF() {
         const { jsPDF } = window.jspdf; 
         let form = document.querySelector('#formArea');
          let canvas = await html2canvas(form, { scale: 2 }); let img = canvas.toDataURL('image/png');
          // Legal size (216mm × 356mm) 
          let pdf = new jsPDF('p', 'mm', [216, 356]);
           let width = pdf.internal.pageSize.getWidth();
            let height = (canvas.height * width) / canvas.width; pdf.addImage(img, 'PNG', 0, 0, width, height); pdf.save("admission-form-legal.pdf"); 
        
        } 
            window.onload = function() { 
                 makePDF(); 
                // স্বয়ংক্রিয়ভাবে পিডিএফ তৈরি করতে চাইলে এই লাইনটি আনকমেন্ট করুন // 
                window.close(); 
            
            }; 


                </script> 
                {{-- <button onclick="makePDF()" style="margin:20px auto; display:block; padding:10px 20px;"> Download PDF </button> --}} 
</body> 

</html>
