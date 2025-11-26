<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Madrasa ID Cards</title>

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
        margin-bottom: 4mm;
    }

    .back-part {
        background-image: url('{{ asset("2pstudent_id_card copy.jpg") }}');
    }

    table {
        width: 100%;
        font-size: 7pt;
        line-height: 1.25;
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
</style>
</head>

<body>

@php
    $chunkedStudents = $students->chunk(4);  // প্রতি পেজে ৪টি সেট
@endphp

@foreach($chunkedStudents as $chunk)
<div class="page">
    <div class="cards-container">

        @foreach($chunk as $student)
        <div class="card-set">

            <!-- 🔵 FRONT PART -->
            <div class="id-card">
                <div style="margin-top: 45mm;">
                    <table>
                        <tr><td>শিক্ষার্থীর নাম</td><td>:</td><td>{{ $student->first_name_bn }} {{ $student->last_name_bn }}</td></tr>
                        <tr><td>পিতার নাম</td><td>:</td><td>{{ $student->father_name_bn }}</td></tr>
                        <tr><td>মাতার নাম</td><td>:</td><td>{{ $student->mother_name_bn }}</td></tr>
                        <tr><td>শ্রেণি</td><td>:</td><td>{{ $student->currentAcademic->class ?? 'N/A' }}</td></tr>
                        <tr><td>রোল</td><td>:</td><td>{{ $student->currentAcademic->roll ?? 'N/A' }}</td></tr>
                        <tr><td>শিক্ষাবর্ষ</td><td>:</td><td>{{ $student->currentAcademic->session ?? 'N/A' }}</td></tr>
                        <tr><td>মোবাইল নং</td><td>:</td><td>{{ $student->parents_contact ?? 'N/A' }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- 🔵 BACK PART -->
            <div class="back-part">
                <div style="margin-top: 38mm;">
                    {{-- ব্যাক সাইড কনটেন্ট প্রয়োজন হলে এখানে দিন --}}
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endforeach

</body>
</html>
