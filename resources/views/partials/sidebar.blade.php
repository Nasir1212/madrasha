<!-- SIDEBAR -->
<aside id="sidebar" class="sidebar">
  <div class="mb-4 text-center">
    <div class="text-white fw-bold fs-5">Madrasha </div>
    <small style="opacity:.8">Management System ‍ Software</small>
  </div>

  <nav class="nav flex-column no-print">

    <a href="{{route('admin.dashboard')}}" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <div class="nav-item dropdown">

  <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown">
    <i class="bi bi-people me-2"></i>Students
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="{{route('admin.students.index')}}"><i class="bi bi-eye me-2"></i>View Students</a></li>
    <li><a class="dropdown-item" href="{{route('admin.students.create')}}"><i class="bi bi-plus-circle me-2"></i>Add Student</a></li>
    <li><a class="dropdown-item" href="{{ route('admin.students.print.cards') }}"><i class="bi bi-plus-circle me-2"></i>ID card</a></li>
  </ul>

</div>

    <div class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-person-vcard me-2"></i>Teachers
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View Teachers</a></li>
    <li><a class="dropdown-item" href="#"><i class="bi bi-plus-circle me-2"></i>Add Teacher</a></li>
  </ul>
</div>

<a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown">
    <i class="bi bi-person-plus-fill me-2"></i>Admissions
  </a>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="{{route('admin.admissions.index')}}"><i class="bi bi-eye me-2"></i> All Admissions </a></li>
    <li><a class="dropdown-item" href="{{route('admin.admissions.index')}}"><i class="bi bi-plus-circle me-2"></i> Pending Approvals  </a></li>
    <li><a class="dropdown-item" href="{{ route('admin.admissions.index') }}"><i class="bi bi-plus-circle me-2"></i> Approved Admissions </a></li>
    <li><a class="dropdown-item" href="{{ route('admin.admissions.index') }}"><i class="bi bi-plus-circle me-2"></i> Rejected Admissions </a></li>
  </ul>
  

    <a href="#" class="nav-link"><i class="bi bi-book me-2"></i>Class Routine</a>
    <a href="#" class="nav-link"><i class="bi bi-calendar-week me-2"></i>Exams</a>
    <a href="#" class="nav-link"><i class="bi bi-journal-text me-2"></i>Results</a>
    <a href="#" class="nav-link"><i class="bi bi-cash-coin me-2"></i>Fees</a>
    <a href="#" class="nav-link"><i class="bi bi-building me-2"></i>Departments</a>
    <a href="#" class="nav-link"><i class="bi bi-gear me-2"></i>Settings</a>
  </nav>
</aside>