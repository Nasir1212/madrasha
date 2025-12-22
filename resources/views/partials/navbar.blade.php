<div class="topbar d-flex align-items-center justify-content-between no-print">
    <div class="d-flex align-items-center gap-2">
      <button id="menuBtn" class="btn btn-outline-primary btn-sm d-lg-none"><i class="bi bi-list"></i></button>
      <h5 class="mb-0">Dashboard</h5>
    </div>

    <div class="d-flex align-items-center gap-2 no-print">
      <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-bell"></i></button>
      <a class="btn btn-primary btn-sm" href="{{route('home')}}"><i class="bi bi-globe"></i></a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success" style="background: green;
    color: white;
    font-weight: bold;
    font-family: monospace;">
        {{ session('success') }}
    </div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif