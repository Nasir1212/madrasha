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
        width: 830px;
        margin: auto;
        background: #fff;
        padding: 25px 40px;
        border: 2px solid #000;
        position: relative;
        overflow: hidden;
        min-height: 1400px;
    }

    .watermark-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        opacity: 0.05;
        transform: translate(-50%, -50%);
        width: 600px;
        z-index: 0;
    }

.qr-box {
    position: absolute;
    bottom: 38px;
    right: 40px;
    width: 52px;
    z-index: 0;
}
.qr-box1 {
    position: absolute;
    top: 176px;
    right: 40px;
    width: 85px;
    z-index: 0;
}
    .photo-box {
        float: right;
        width: 100px;
        height: 120px;
        border: 1px solid #000;
        text-align: center;
        z-index: 5;
        overflow:hidden;
        position: relative;
    }

    .photo-box img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .line {
        border-bottom: 2px dotted #000;
        display: inline-block;
   
    }

    .small {
        border-bottom: 2px dotted #000;
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
<div>
<div class="form-wrapper" id="formArea" >

    <img src="{{asset('assets/img/madrash_logo.png')}}" class="watermark-bg">

    <img data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ route('print_form',['form_no'=>$admission->form_no]) }}" class="qr-box1 qr_src">
    <img data-qr="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ route('print_form',['form_no'=>$admission->form_no]) }}" class="qr-box qr_src">

    <div style="display: flex; justify-content: space-between">
        <img src="{{asset('assets/img/madrash_logo.png')}}" style="width: 100px; height: 100px;">
        
        <div>
            <h2 style="text-align:center; margin-bottom:0px;">المَدْرَسَةُ فَقِيْر فَارَا بَدَرْ اَوْلِيَا سُنِّيْةُ الدَخِل</h2>
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
       আবেদনের তারিখ: <b> <span class="small">{{ date('d/m/Y') }} </b></span>
    </p>

    <div class="section-title">ছাত্র/ছাত্রীর তথ্য</div>
    <br/>  

    ১।  ছাত্র/ছাত্রীর নাম:  
    <span class="line" style="width: 44.7rem;"><b>{{ $admission->name_bn_first }} {{ $admission->name_bn_last }} ({{ $admission->name_en_first }} {{ $admission->name_en_last }})</b></span>
    <br><br>

    
    ২। জন্ম নিবন্ধন নং: <span class="line" style="width: 44.7rem;"> <b> {{ $admission->birth_reg_no }} </b> </span>
    <br><br>
    
    ৩। জন্ম তারিখ: <span class="small" style="width: 14.69rem;"> <b> {{ $admission->birth_date }} </b></span>
    ৪। লিঙ্গ : <span class="small" style="width: 11rem"> <b> @if($admission->gender == 'male') পুরুষ @else নারী @endif </b> </span>
   ৫। জাতীয়তা : <span class="small" style="width: 11rem"> <b> {{ $admission->nationality }} </b> </span>

       <br><br>

    ৬।  স্থায়ী ঠিকানা: <span class="line" style="width:45.79rem ">
 গ্রাম/ওয়ার্ড :  <b>{{ $admission->perm_village }}</b>
পোস্ট অফিস : <b>{{ $admission->perm_post }}</b>
ইউনিয়ন : <b>{{ $admission->perm_union }}</b>
উপজেলা : <b>{{ $admission->perm_upazila }}</b>
জেলা : <b>{{ $admission->perm_district }}</b>

</span>

<br><br>
    ৭। বর্তমান ঠিকানা: <span class="line"  style="width:44.79rem " >
        
      গ্রাম/ওয়ার্ড :  <b>{{ $admission->curr_village }}</b>
পোস্ট অফিস : <b>{{ $admission->curr_post }}</b>
ইউনিয়ন : <b>{{ $admission->curr_union }}</b>
উপজেলা : <b>{{ $admission->curr_upazila }}</b>
জেলা : <b>{{ $admission->curr_district }}</b>
        
    </span><br>

    <div class="section-title"> পিতা-মাতার ও অভিভাবক  তথ্য </div>
    <br/>
    ১। পিতার নাম: <span class="small" style="width: 24.61rem"> <b> {{ $admission->father_bn }} ({{ $admission->father_en }}) </b>
    </span> NID নং: <span class="small" style="width: 18rem"> <b> {{ $admission->father_nid }} </b> </span> 
       <br><br>

   জন্মনিবন্ধন নং: <span class="small" style="width: 24.61rem"> <b> {{ $admission->father_birth_reg }} </b> </span>   
   জন্ম তারিখ : <span class="small" style="width: 16.74rem"> <b> {{ $admission->father_birth_date }} </b> </span>
  
    <br><br>
    ২। মাতার নাম: <span class="small" style="width: 24.61rem"> <b>  {{ $admission->mother_bn }} ({{ $admission->mother_en }}) </b> </span>
    </span> NID নং: <span class="small" style="width: 18rem"> <b>  {{ $admission->mother_nid }} </b> </span> 
    <br><br>
    জন্মনিবন্ধন নং: <span class="small" style="width: 24.61rem"> <b>  {{ $admission->mother_birth_reg }} </b> </span> 
   
    জন্ম তারিখ : <span class="small" style="width: 16.74rem"> <b>  {{ $admission->mother_birth_date }}  </b> </span>
    <br>
    <br>


    ৩। অভিভাবকের নাম: <span class="small" style="width: 22.3rem"> <b>  {{ $admission->guardian_name }} </b></span>
  
    মোবাইল: <span class="small" style="width:17.74rem"> <b> {{ $admission->guardian_phone }} </b> </span><br>

    <div class="section-title"> ভর্তি সংক্রান্ত তথ্য </div>
    <br/>

    পূর্বের বিদ্যালয়/মাদ্রাসার নাম : <span class="line" style="width:40.90rem"> <b> {{ $admission->previous_institute }} </b> </span><br><br>    
    @php
    $classNames = [
        0 => 'শিশু শ্রেণী',
        1 => 'প্রথম শ্রেণী',
        2 => 'দ্বিতীয় শ্রেণী',
        3 => 'তৃতীয় শ্রেণী',
        4 => 'চতুর্থ শ্রেণী',
        5 => 'পঞ্চম শ্রেণী',
        6 => 'ষষ্ঠ শ্রেণী',
        7 => 'সপ্তম শ্রেণী',
        8 => 'অষ্টম শ্রেণী',
        9 => 'নবম শ্রেণী',
        10 => 'দশম শ্রেণী',
    ];
@endphp


    যে শ্রেণীতে ভর্তি হতে চাই : <span class="small" style="width: 17rem"> <b>  {{ $classNames[$admission->admit_class] ?? 'N/A' }} </b>  </span>  
    পূর্বে যে শ্রেণীতে ছিল : <span class="small"  style="width: 16.80rem"> <b>  {{ $classNames[$admission->previous_class] }} </b> </span>  
    <br/> <br/>
    ছাড়পত্রের নাম্বার : <span class="small" style="width: 20.3rem"> <b>  {{ $admission->leave_certificate_no }} </b>  </span>
    ছাড়পত্রের তারিখ : <span class="small" style="width: 17.90rem"> <b>  {{ $admission->leave_certificate_date }} </b> </span><br>

    <div class="section-title"> অঙ্গীকার নামা  </div>
    <h4 style="margin: 0; margin-top:5px">
      ছাত্র/ছাত্রীর অঙ্গীকারনামা
    </h4>

    <p style="text-align: justify;margin:0px;margin-bottom:5px;">

    * আমি <b>  {{ $admission->name_bn_first }} {{ $admission->name_bn_last }} </b> পিতা <b> {{ $admission->father_bn }} </b> এই মর্মে প্রত্যয়ন করছি যে, অত্র মাদ্রাসার সকল নিয়মাবলী মেনে চলবো। অত্র মাদ্রাসায় অধ্যয়নকালীন সময় যে কোন রাজনৈতিক দল বা উপদলের সাথে প্রকাশ্যে বা অপ্রকাশ্যভাবে জড়িত থাকবো না । চালচলন, পোষাক পরিচ্ছন্ন ও চুল-দাড়ি সুন্নত মোতাবেক রাখবো । কোন অবস্থাতেই মাদ্রসার ভাবমুর্তি নষ্ট হয় এমন কোন কাজে লিপ্ত থাকবো না । উপরোক্ত শর্তের মধ্যে যে কোন একটি ব্যাতিক্রম হলে মাদ্রাসার কর্তৃপক্ষের যে কোন শাস্তি আমি বিনা দ্বিধায় মেনে নিতে বাধ্য থাকিবো।
    </p>
<span style="float: right">
  ছাত্র/ছাত্রীর স্বাক্ষর: <span class="small"></span><br><br>
</span>
  <br>

<h4 style="margin: 0; margin-top:5px"> অভিভাবকের অঙ্গীকারনামা</h4>

    <p style="text-align: justify;margin:0px;margin-bottom:5px;">
    * আমি <b>  {{ $admission->guardian_name }} </b> অঙ্গীকার করিতেছি যে, আমার ছেলে/মেয়ে মাদ্রাসার যাবতীয় নিয়ম কানুন মেনে চলবে। অত্র মাদ্রাসার ছাড়পত্র ছাড়া অন্য কোন প্রতিষ্ঠানে ভর্তি করাবো না।
    </p>
   
<span style="float: right">
  অভিভাবকের স্বাক্ষর: <span class="small"></span><br><br>
</span>


<div class="section-title"> সংযুক্তি </div>

<span style="margin: 0;">১। ছাত্র/ছাত্রীর ২ কপি ছবি ও জন্মনিবন্ধনের ফটোকপি </span>
<span style="margin: 0;"> ২। পিতা-মাতার এন. আই. ডি ও জন্মনিবন্ধনের ফটোকপি </span>
<span style="margin: 0;">  ৩। ছাড়পত্রের কপি (প্রযোজ্য ক্ষেত্রে )  </span>

    <div class="section-title">অফিস কর্তৃক পূরণীয়</div>
<br/>

    অত্র ছাত্র/ছাত্রীকে  <span class="small" style="width: 9rem"></span>  
    শ্রেণীতে <span class="small"  style="width: 10rem" ></span> 
    টাকায়  <span class="small"  style="width: 10rem" ></span>
    রশিদ নাম্বারে  ভার্তি করা হল ।  <br> <br>
    শ্রেনীতে তার রোল নং  <span class="small" style="width: 5rem"></span>  ।
   
    <br>

    কর্তৃপক্ষের স্বাক্ষর: <span class="small"></span>

</div>
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
        
        // ১. ফর্ম এলিমেন্ট ধরা
        const element = document.getElementById('formArea');
        
        // ২. ক্লোন তৈরি করা (মোবাইল ভিউ সমস্যা সমাধানের জন্য)
        const clone = element.cloneNode(true);
        
        // ৩. ক্লোনটির স্টাইল সেট করা (ফিক্সড ৯০০ পিক্সেল)
        clone.style.width = '830px';
        clone.style.position = 'absolute';
        clone.style.left = '-9999px';
        clone.style.top = '0';
        
        document.body.appendChild(clone);

        try {
            // ৪. ক্যানভাস তৈরি
            const canvas = await html2canvas(clone, {
                scale: 2, // হাই কোয়ালিটি
                useCORS: true, 
                width: 900, 
                windowWidth: 1024,
                x: 0,
                y: 0
            });

            const imgData = canvas.toDataURL('image/png');
            
            // ৫. লিগ্যাল সাইজ পেপার সেটআপ (Legal = 'legal' অথবা [216, 356])
            const pdf = new jsPDF('p', 'mm', 'legal'); 

            const pdfWidth = pdf.internal.pageSize.getWidth(); // ২১৮ মি.মি. (লিগ্যাল)
            const pdfHeight = pdf.internal.pageSize.getHeight(); // ৩৫৬ মি.মি. (লিগ্যাল)
            
            // ইমেজের হাইট এবং উইডথ এর অনুপাত বের করা
            const imgProps = pdf.getImageProperties(imgData);
            const contentHeight = (imgProps.height * pdfWidth) / imgProps.width;

            // পিডিএফে ছবি যোগ করা
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, contentHeight);

            // ৬. সেভ করা
            pdf.save("Admission_Form_Legal_{{ $admission->form_no }}.pdf");

        } catch (error) {
            console.error("PDF Error:", error);
            alert("পিডিএফ জেনারেট করতে সমস্যা হয়েছে।");
        } finally {
            // ক্লোন রিমুভ করা
            document.body.removeChild(clone);
        }
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
