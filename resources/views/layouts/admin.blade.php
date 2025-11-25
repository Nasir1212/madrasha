<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --sidebar-width: 250px;
    }
    body{background:#f4f6fa;min-height:100vh;}

    /* SIDEBAR */
    .sidebar{
      width:var(--sidebar-width);
      position:fixed;top:0;left:0;bottom:0;
      padding:1rem .75rem;
      background:#0a3a72;color:#fff;
      transition:transform .3s ease;z-index: 100;
    }
    .sidebar .nav-link{color:#e9eef7;font-size:0.92rem;margin-bottom:.3rem}
    .sidebar .nav-link.active{background:rgba(255,255,255,0.14);border-radius:8px;}

    /* SIDEBAR HIDDEN ON MOBILE */
    @media(max-width: 991px){
      .sidebar{transform:translateX(-100%);}  /* hide */
      .sidebar.show{transform:translateX(0);} /* show */
    }

    /* MAIN */
    .main{
      margin-left:var(--sidebar-width);
      padding:1.5rem;
      transition:all .3s ease;
    }
    @media(max-width: 991px){
      .main{margin-left:0;} /* no space on mobile */
    }

    .topbar{background:#fff;padding:.8rem 1rem;border-radius:10px;box-shadow:0 1px 2px rgba(0,0,0,0.05);margin-bottom:1rem;}
    .card{border-radius:12px}

    /* MOBILE OVERLAY */
    .overlay{
      position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4);
      display:none;z-index:5;
    }
    .overlay.show{display:block;}

    .sidebar .dropdown-menu {
    background: #fff;
    border-radius: 6px;
    padding: 6px 0;
}

.sidebar .dropdown-item {
    padding: 8px 15px;
    font-size: 14px;
}

.sidebar .dropdown-item:hover {
    background: #f1f5ff;
}


  .form-card {
      /* max-width: 900px; */
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .section-title {
      font-size: 20px;
      font-weight: 700;
      margin: 25px 0 15px;
      color: #1c3faa;
      border-left: 4px solid #1c3faa;
      padding-left: 10px;
    }
    .btn-primary {
      background: #1c3faa;
      border: none;
    }
  </style>
</head>

<body>

<!-- OVERLAY -->
<div id="overlay" class="overlay"></div>


@include('partials.sidebar')

<!-- MAIN CONTENT -->
<main class="main">
  @include('partials.navbar')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   @yield('content')

  @include('partials.footer')
</main>

<script>
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const menuBtn = document.getElementById('menuBtn');

  menuBtn.addEventListener('click', ()=>{
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
  });

  overlay.addEventListener('click', ()=>{
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>