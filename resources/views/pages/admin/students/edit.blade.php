@extends('layouts.admin')
@section('content')
<style>
  .photo-preview {
    max-width: 150px;
    max-height: 150px;
    margin-top: 10px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #1c3faa;
  }
</style>

<div class="form-card">
  <h2 class="text-center text-primary fw-bold mb-4">Edit Student</h2>

  <form id="studentForm" method="POST" action="{{ route('admin.students.update', $student->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- PERSONAL INFO -->
    <div class="section-title">Personal Information</div>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">First Name (Bangla)</label>
        <input type="text" name="first_name_bn" class="form-control" value="{{ old('first_name_bn', $student->first_name_bn) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name (Bangla)</label>
        <input type="text" name="last_name_bn" class="form-control" value="{{ old('last_name_bn', $student->last_name_bn) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">First Name (English)</label>
        <input type="text" name="first_name_en" class="form-control" value="{{ old('first_name_en', $student->first_name_en) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name (English)</label>
        <input type="text" name="last_name_en" class="form-control" value="{{ old('last_name_en', $student->last_name_en) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Blood Type</label>
        <select name="blood_type" class="form-select">
          <option value="">Select Blood Type</option>
          @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $type)
            <option value="{{ $type }}" {{ old('blood_type', $student->blood_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select">
          <option value="">Select Gender</option>
          @foreach(['Male','Female'] as $gender)
            <option value="{{ $gender }}" {{ old('gender', $student->gender) == $gender ? 'selected' : '' }}>{{ $gender }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Religion</label>
        <select name="religion" class="form-select">
          <option value="">Select Religion</option>
          @foreach(['Islam','Hindu','Christian','Buddhist','Other'] as $religion)
            <option value="{{ $religion }}" {{ old('religion', $student->religion) == $religion ? 'selected' : '' }}>{{ $religion }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Birth Date</label>
        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Birth Registration No.</label>
        <input type="text" name="birth_reg_no" class="form-control" value="{{ old('birth_reg_no', $student->birth_reg_no) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Student Photo</label>
        <input type="file" name="photo" class="form-control" id="photoInput" accept="image/*">
        @if($student->photo)
          <img id="photoPreview" class="photo-preview" src="{{ asset('storage/'.$student->photo) }}" alt="Photo Preview">
        @else
          <img id="photoPreview" class="photo-preview" src="#" style="display:none;">
        @endif
      </div>
    </div>

    <!-- PARENTS INFO -->
    <div class="section-title">Parents Information</div>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Father Name (Bangla)</label>
        <input type="text" name="father_name_bn" class="form-control" value="{{ old('father_name_bn', $student->father_name_bn) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Mother Name (Bangla)</label>
        <input type="text" name="mother_name_bn" class="form-control" value="{{ old('mother_name_bn', $student->mother_name_bn) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Father Name (English)</label>
        <input type="text" name="father_name_en" class="form-control" value="{{ old('father_name_en', $student->father_name_en) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Mother Name (English)</label>
        <input type="text" name="mother_name_en" class="form-control" value="{{ old('mother_name_en', $student->mother_name_en) }}">
      </div>
      <div class="col-md-6">
        <label class="form-label">Parents Contact No.</label>
        <input type="text" name="parents_contact" class="form-control" value="{{ old('parents_contact', $student->parents_contact) }}">
      </div>
    </div>

    <!-- ADDRESS INFO -->
    <div class="section-title">Address Information</div>
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label">Full Address</label>
        <textarea name="full_address" class="form-control" rows="2">{{ old('full_address', $student->full_address) }}</textarea>
      </div>
      <div class="col-md-4">
        <label class="form-label">Zip Code</label>
        <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code', $student->zip_code) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Police Station</label>
        <input type="text" name="police_station" class="form-control" value="{{ old('police_station', $student->police_station) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Nationality</label>
        <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $student->nationality ?? 'Bangladeshi') }}">
      </div>
    </div>

    <!-- ACADEMIC INFO -->
    <div class="section-title">Academic Information</div>
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Class</label>
        <select name="class" class="form-select">
          <option value="">Select Class</option>
          @foreach(['Play','KG','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten'] as $class)
            <option value="{{ $class }}" {{ old('class', $student->currentAcademic->class ?? '') == $class ? 'selected' : '' }}>{{ $class }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Roll</label>
        <input type="number" name="roll" class="form-control" value="{{ old('roll', $student->currentAcademic->roll ?? '') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Session</label>
        <input type="text" name="session" class="form-control" value="{{ old('session', $student->currentAcademic->session ?? '') }}">
      </div>
    </div>

    <div class="mt-4 text-center">
      <button class="btn btn-primary px-5 py-2">Update</button>
    </div>
  </form>
</div>

<script>
  const photoInput = document.getElementById('photoInput');
  const photoPreview = document.getElementById('photoPreview');
  photoInput.addEventListener('change', function(){
    const file = this.files[0];
    if(file){
      const reader = new FileReader();
      reader.onload = function(e){
        photoPreview.setAttribute('src', e.target.result);
        photoPreview.style.display = 'block';
      }
      reader.readAsDataURL(file);
    } else {
      photoPreview.style.display = '{{ $student->photo ? "block" : "none" }}';
    }
  });
</script>
@endsection
