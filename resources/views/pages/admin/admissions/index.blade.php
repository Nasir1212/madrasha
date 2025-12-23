 @extends('layouts.admin')
@section('content')
<table class="table table-bordered table-striped" border="1" width="100%" cellpadding="8">
<thead>
<tr class="table-primary">
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
@foreach($admissions as $a)
<tr class="table-primary">
    <td>{{ $a->form_no }}</td>
    <td>{{ $a->name_bn_first }} {{ $a->name_bn_last }}</td>
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