<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>ভর্তি রসিদ</title>

<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

<style>
body{
    font-family: SolaimanLipi, sans-serif;
    background:#f2f2f2;
    padding:20px;
}
.receipt{
    width:700px;
    margin:auto;
    background:#fff;
    padding:25px;
    /* border:2px dashed #000; */
}
#receiptArea{
    width: 800px;   /* A5 Landscape friendly */
}
.flex{
    display: flex;
    justify-content: center;
}
.header{
    text-align:center;
}
.header img{
    width:80px;
}
hr{
    border:1px solid #000;
}
.info p{
    margin:6px 0;
    font-size:16px;
}
.qr{
    text-align:center;
    margin-top:15px;
}
.signature{
    margin-top:40px;
    display:flex;
    justify-content:space-between;
}
.small{
    font-size:14px;
}
</style>
</head>

<body>

<div class="receipt" id="receiptArea">

    <div class="header">
        <div class="head flex">
        <img style="width: 100px;height: 100px; margin-right: 10px;" src="{{ asset('assets/img/madrash_logo.png') }}">
        <div>
        <h2 style="margin: 0;">فَقِيْر فَارَا بَدَرْ اَوْلِيَاء سُنِّيْةُ  عَالِمْ مَدْرَسَة</h2>
        <h3 style="margin: 0;">ফকির পাড়া বদর আউলিয়া সুন্নিয়া আলিম মাদরাসা</h3>
        <h5 style="margin: 0;">FAKIR PARA BADAR AOULIA SUNNIA ALIM MADRASHA </h5>
        <p class="small">উত্তর খরনা, চক্রশালা, পটিয়া, চট্টগ্রাম</p>
        </div>
      

        </div>
        
        <hr>
        <h3>ভর্তি গ্রহণ রসিদ</h3>
    </div>
    <div style="display: flex;    justify-content: space-between">
    <div class="info">
        <p><b>ফরম নং:</b> {{ $admission->form_no }}</p>
        <p><b>ছাত্র/ছাত্রীর নাম:</b> {{ $admission->name_bn_first }} {{ $admission->name_bn_last }}</p>
        <p><b>শ্রেণী:</b> {{ $classNames[$admission->admit_class] ?? '' }}</p>
        <p><b>অভিভাবকের নাম:</b> {{ $admission->guardian_name }}</p>
        <p><b>মোবাইল:</b> {{ $admission->guardian_phone }}</p>
        <p><b>আবেদনের তারিখ:</b> {{ $admission->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="qr">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ route('print_form',['form_no'=>$admission->form_no]) }}">
        <p class="small">QR স্ক্যান করে ফরম যাচাই করুন</p>
    </div>
</div>
    <div class="signature">
        <div>
            ---------------------<br>
            অভিভাবকের স্বাক্ষর
        </div>

        <div>
            ---------------------<br>
            কর্তৃপক্ষ
        </div>
    </div>

</div>

<!-- PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
async function makeReceiptPDF(){
    const { jsPDF } = window.jspdf;
    const el = document.getElementById('receiptArea');

    const canvas = await html2canvas(el, {
        scale: 2,
        useCORS: true
    });

    const imgData = canvas.toDataURL('image/png');

    // ✅ A5 Landscape
    const pdf = new jsPDF({
        orientation: 'l',
        unit: 'mm',
        format: 'a5'
    });

    const pdfWidth  = pdf.internal.pageSize.getWidth();   // ≈ 210mm
    const pdfHeight = pdf.internal.pageSize.getHeight();  // ≈ 148mm

    // Maintain aspect ratio
    const imgWidth  = pdfWidth;
    const imgHeight = (canvas.height * imgWidth) / canvas.width;

    let y = 0;

    // Center vertically if height is smaller
    if (imgHeight < pdfHeight) {
        y = (pdfHeight - imgHeight) / 2;
    }

    pdf.addImage(imgData, 'PNG', 0, y, imgWidth, imgHeight);
    pdf.save("Receive_Copy_{{ $admission->form_no }}.pdf");
}

window.onload = function(){
    makeReceiptPDF();
    setTimeout(function () {
        window.close();
  console.log("This runs after 2 seconds");
}, 2000); // time in milliseconds
};

</script>

</body>
</html>
