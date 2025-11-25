<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Madrasa ID Cards</title>
<style>
  @page {
    size: A4 landscape;
    margin: 10mm;
  }

  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: #e5e7eb;
  }

  .cards-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 cards per row */
    grid-gap: 10mm 5mm; /* row gap, column gap */
    padding: 5mm;
    box-sizing: border-box;
  }

  .id-card {
    width: 54mm;
    height: 85mm;
    background: #fff;
    border: 1px solid #000;
    border-radius: 6px;
    padding: 5px;
    box-sizing: border-box;
    position: relative;
    overflow: hidden;
  }

  .header {
    text-align: center;
    font-size: 8pt;
    font-weight: bold;
    line-height: 1.2;
  }

  .header .en {
    font-size: 6pt;
  }

  .logo {
    text-align: center;
    margin:  0;
  }
  .logo img {
    width: 28mm;
    height: auto;
  }

  .section-title {
    background: #d1d5db;
    display: inline-block;
    padding: 1px 4px;
    border-radius: 3px;
    font-size: 7pt;
    font-weight: bold;
    margin-bottom: 4px;
  }

  table {
    width: 100%;
    font-size: 7pt;
    table-layout: fixed;
    word-wrap: break-word;
  }

  td:first-child {
    width: 40%;
    font-weight: bold;
  }

  .signature {
    position: absolute;
    bottom: 8px;
    right: 4px;
    text-align: center;
    font-size: 6pt;
  }

  @media print {
    body {
      margin: 0;
      padding: 0;
    }
    .cards-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 10mm 5mm;
    }
    .id-card {
      page-break-inside: avoid;
    }
  }
</style>
</head>
<body>
<div class="cards-container">
@foreach($students as $student)
<div class="id-card">

  <div class="header">
    ফকির পাড়া বদর আউলিয়া সুন্নিয়া দাখিল মাদরাসা<br>
    <span class="en">FAKIR PARA BADAR AOULIA SUNNIYA DAKHIL MADRASASAH</span><br>
    উত্তর খরনা, চক্রশালা, পটিয়া, চট্টগ্রাম
  </div>

  <div class="logo">
     <img src="{{ asset('logo_pad1.png') }}" alt="Madrasa Logo">
    {{-- @if($student->photo)
        <img src="{{ asset('storage/'.$student->photo) }}" alt="Student Photo">
    @else
        <img src="{{ asset('logo_pad1.png') }}" alt="Madrasa Logo">
    @endif --}}
  </div>

  <div class="section-title">পরিচয় পত্র</div>

  <table>
    <tr>
      <td>শিক্ষার্থীর নাম</td>
      <td style="width: 0">:</td>
      <td>{{ $student->first_name_bn }} {{ $student->last_name_bn }}</td>
    </tr>
    <tr>
      <td>পিতার নাম</td>
      <td>:</td>
      <td>{{ $student->father_name_bn }}</td>
    </tr>
    <tr>
      <td>মাতার নাম</td>
      <td>:</td>
      <td>{{ $student->mother_name_bn }}</td>
    </tr>
    <tr>
      <td>শ্রেণি</td>
      <td>:</td>
      <td>{{ $student->currentAcademic->class ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td>রোল</td>
      <td>:</td>
      <td>{{ $student->currentAcademic->roll ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td>শিক্ষাবর্ষ</td>
      <td>:</td>
      <td>{{ $student->currentAcademic->session ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td>মোবাইল নং</td>
      <td>:</td>
      <td>{{ $student->parents_contact ?? 'N/A' }}</td>
    </tr>
  </table>

  <div class="signature">
    <img style="width: 10px;height: 10px;" src="https://th.bing.com/th/id/OIP.OtN82izagfgVDKc3Vxzn7QHaE8?w=251&h=180&c=7&r=0&o=7&dpr=1.5&pid=1.7&rm=3" alt="Signature"><br>
    সুপারের স্বাক্ষর
  </div>

</div>
@endforeach
</div>
</body>
</html>
