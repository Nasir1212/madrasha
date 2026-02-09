<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Madrasa ID Cards</title>
  <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<style>
  @media print {
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}

    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    body {
        margin: 0;
        padding: 0;
        background: white;
        font-family: Arial, sans-serif;
        font-family: 'SolaimanLipi', sans-serif;
    }

    /* 4 সেট প্রতি সারি */
    .cards-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 6mm;
        width: 100%;
        box-sizing: border-box;
        page-break-inside: avoid;
    }

    /* এক সেট = ফ্রন্ট + ব্যাক */
    .card-set {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .id-card,
    .back-part {
        width: 54mm;
        height: 85mm;
        border: 1px solid #000;
        border-radius: 6px;
        background-size: cover;
        background-repeat: no-repeat;
        padding: 5px;
        box-sizing: border-box;
        overflow: hidden;
        position: relative;
        
    }

    .id-card {
        background-image: url('{{ asset("1pstudent_id_card copy.jpg") }}');
        margin-bottom: 2px;
    }

    .back-part {
        background-image: url('{{ asset("2pstudent_id_card copy.jpg") }}');
        transform:rotate(180deg);
    }

    table {
        width: 100%;
        font-size: 8pt;
        line-height: 1;
        table-layout: fixed;
    }
    
    td:first-child {
        width: 40%;
        font-weight: bold;
        white-space: nowrap;
    }
    td:nth-child(2) {
        width: 6%;
    }

    /* প্রিন্ট */
    @media print {
        .page {
            page-break-after: always;
        }
    }

    .page{
        margin-bottom: 5rem
    }
   .std-img {
    width: 100%;
    height: 100%;
    /* transform: translate(44px, 10px); */
}

.std-img-wrapper {
    width: 108px;
    height: 114px;
    border: 1px solid #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f0f0f0;
    transform: translate(41px, 10px);
}
.no-photo {
    color: #666;
    font-size: 14px;
    font-weight: bold;
}
.uid_no {
    transform: translate(5px, 61px);
    z-index: 12000;
    color: white;
    font-weight: bold;
    font-size: 13px;
}
</style>
</head>

<body>
@php
    $bn_classes = [
        '0' => 'শিশু',
        '1' => 'প্রথম',
        '2' => 'দ্বিতীয়',
        '3' => 'তৃতীয়',
        '4' => 'চতুর্থ',
        '5' => 'পঞ্চম',
        '6' => 'ষষ্ঠ',
        '7' => 'সপ্তম',
        '8' => 'অষ্টম',
        '9' => 'নবম',
        '10' => 'দশম'
    ];

    // সংখ্যাকে বাংলায় রূপান্তর করার ফাংশন
    function enToBn($number) {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return str_replace($en, $bn, $number);
    }
@endphp
@php


    $chunkedStudents = $students->chunk(4);  // প্রতি পেজে ৪টি সেট
@endphp

@foreach($chunkedStudents as $chunk)
<div class="page">
    <div class="cards-container">

        @foreach($chunk as $student)
        <div class="card-set">
            <div class="uid_no" >
               ID: {{ $student->uid }}
            </div>
            <!-- 🔵 FRONT PART -->
            <div class="id-card">
                <div style="margin-top: 45mm;">
                  <table>
                   
    <tr><td>শিক্ষার্থীর নাম</td><td>:</td><td>{{ $student->name_bn_first }} {{ $student->name_bn_last }}</td></tr>
    <tr><td>পিতার নাম</td><td>:</td><td>{{ $student->father_bn }}</td></tr>
    <tr><td>মাতার নাম</td><td>:</td><td>{{ $student->mother_bn }}</td></tr>
    
    {{-- শ্রেণি বাংলায় --}}
    <tr><td>শ্রেণি</td><td>:</td><td>{{ $bn_classes[$student->currentAcademic->class] ?? 'N/A' }}</td></tr>
    
    {{-- রোল বাংলায় --}}
    <tr><td>রোল</td><td>:</td><td>{{ $student->currentAcademic->roll ? enToBn($student->currentAcademic->roll) : 'N/A' }}</td></tr>
    
    {{-- শিক্ষাবর্ষ বাংলায় --}}
    <tr><td>শিক্ষাবর্ষ</td><td>:</td><td>{{ $student->currentAcademic->session ? enToBn($student->currentAcademic->session) : 'N/A' }}</td></tr>
    
    {{-- মোবাইল নং বাংলায় --}}
    <tr><td>মোবাইল নং</td><td>:</td><td>
        
        {{-- {{ $student->guardian_phone ?? 'N/A' }} --}}

        @php
            // কমা দিয়ে নম্বরগুলোকে আলাদা করা হচ্ছে
            $phones = !empty($student->guardian_phone) ? explode(',', $student->guardian_phone) : [];
        @endphp

        @forelse($phones as $index => $phone)
            @if(!empty(trim($phone)))
                {{-- এখানে $index + 1 ব্যবহার করে ১মো, ২মো ইত্যাদি দেখানো হচ্ছে --}}
                {{ trim($phone) }}
                
                {{-- যদি এটি শেষ নম্বর না হয়, তবেই কেবল পরের লাইনে যাবে --}}
                @if(!$loop->last)
                    <br>
                @endif
            @endif
        @empty
            N/A
        @endforelse
    
    </td></tr>
</table>
                </div>
            </div>

            <!-- 🔵 BACK PART -->
            <div class="back-part">
                <div style="margin-top: 38mm;">
                    {{-- ব্যাক সাইড কনটেন্ট প্রয়োজন হলে এখানে দিন --}}
                   <div class="std-img-wrapper">
    <img src="https://img.fbasm.edu.bd/{{ $student->student_photo }}" 
         alt="ছবি" 
         class="std-img" 
         onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'no-photo\'>ছবি</span>';">
</div>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endforeach

</body>
</html>
