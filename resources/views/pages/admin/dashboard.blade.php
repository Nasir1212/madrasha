 @extends('layouts.admin')
@section('content')
 <!-- STAT CARDS -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card p-3">
        <small class="text-muted">Total Students</small>
        <div class="h5">1,240</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card p-3">
        <small class="text-muted">Teachers</small>
        <div class="h5">58</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card p-3">
        <small class="text-muted">Departments</small>
        <div class="h5">12</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card p-3">
        <small class="text-muted">Pending Fees</small>
        <div class="h5">৳ 34,500</div>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card p-3">
    <h6 class="mb-3">Recent Admissions</h6>
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Department</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ST-0012</td>
            <td>Abul Hassan Amin</td>
            <td>Class 8</td>
            <td>General</td>
            <td>2025-01-20</td>
            <td><button class="btn btn-sm btn-outline-secondary">View</button></td>
          </tr>
          <tr>
            <td>ST-0015</td>
            <td>Fatima Akhtar</td>
            <td>Class 9</td>
            <td>Science</td>
            <td>2025-01-19</td>
            <td><button class="btn btn-sm btn-outline-secondary">View</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  @endsection