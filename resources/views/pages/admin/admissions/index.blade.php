 @extends('layouts.admin')
@section('content')

<div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('admin.admissions.index') }}" method="GET" class="row g-3">
            <div class="col-md-2">
                <input type="text" name="name" class="form-control" placeholder="নাম দিয়ে খুঁজুন" value="{{ request('name') }}">
            </div>
          
            <div class="col-md-3">
                <select name="class" class="form-select">
                    <option value="">শ্রেণি নির্বাচন করুন</option>
                    @php
                        $classes = [
                            '0' => 'শিশু',
                            '1' => 'প্রথম',
                            '2' => 'দ্বিতীয়',
                            '3' => 'তৃতীয়',
                            '4' => 'চতুর্থ',
                            '5' => 'পঞ্চম',
                            '6' => 'ষষ্ঠ',
                            '7' => 'সপ্তম',
                            '8' => 'অষ্টম',
                            '9' => 'নবম',
                            '10' => 'দশম',
                        ];
                    @endphp

                    @foreach($classes as $key => $name)
                        <option value="{{ $key }}" {{ request('class') == $key && request('class') !== null ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>                
            
            <div class="col-md-3">
                <input type="text" name="phone" class="form-control" placeholder="মোবাইল নম্বর" value="{{ request('phone') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="form_no" class="form-control" placeholder="ফর্ম নং" value="{{ request('form_no') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">🔍 সার্চ করুন</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-striped" border="1" width="100%" cellpadding="8">
<thead>
<tr class="table-primary">
    <th>#</th>
    <th>Form No</th>
    <th> Name </th>
    <th>Class </th>
    <th>Guardian</th>
    <th>Phone </th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($admissions as  $index => $a)
<tr class="table-primary">
    <td>{{ $admissions->firstItem() + $index }}</td>
    <td>{{ $a->form_no }}</td>
    <td>
        {{ $a->name_bn_first }} {{ $a->name_bn_last }} <br/>
        {{ $a->name_en_first }} {{ $a->name_en_last }} <br/>
    
    </td>
    <td>{{ $a->admit_class }}</td>
    <td>{{ $a->guardian_name }}</td>
    <td>{{ $a->guardian_phone }}</td>

    <td>
        @if($a->status=='1')
            ✅ Approved
        @elseif($a->status=='2')
            ❌ Rejected
          @elseif($a->status=='0')
            ⏳ Pending
        @endif
    </td>

    <td>
        <a href="{{ route('admin.admissions.edit',$a->id) }}" class="btn btn-primary" title="Edit" >✏ </a>

        <form action="{{ route('admin.admissions.delete',$a->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('ডিলিট করবেন?')" title="Delete" class="btn btn-danger">🗑</button>
        </form>

        @if($a->status=='0')
        <form action="{{ route('admin.admissions.approve',$a->id) }}" method="POST"  style="display:inline">
            @csrf
            <button title="Approve" class="btn btn-success">✔ </button>
        </form>
        @endif

       
        <a target="_blank" title="Print" class="btn btn-secondary" href="{{ route('admin.admissions.print_receive',['form_no'=>$a->form_no]) }}">
            🖨 
        </a>
   
    </td>
</tr>
@endforeach
</tbody>
</table>

{{ $admissions->links() }}

@endsection