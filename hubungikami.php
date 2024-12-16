<?php
session_start();


if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
  header('Location: index.php');
  exit;
}

if (isset($_POST['logout'])) {
  session_destroy();
  $logout_script = "
      <script>
      Swal.fire({
          title: 'Logout Berhasil',
          text: 'Anda akan diarahkan ke halaman login.',
          icon: 'success',
          confirmButtonText: 'OK',
          customClass: {
              confirmButton: 'my-confirm-button' 
          }
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = 'index.php';
          }
      });
      </script>
  ";


  
  if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/", "", true, true);
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aparat | Hubungi Kami</title>
    <link rel="icon" type="image/x-icon" href="/img/iconpolibatam.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    rel="icon"
    type="image/x-icon"
    href="img/iconpolibatam.png"
  />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <link href="css/styles.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
  </head>
<body>
<nav
class="navbar navbar-expand-lg navbar-light py-0 sticky-top mb-5"
style="background-color: #003298"
>
<div class="container px-lg-0 px-sm-5">
  <a class="navbar-brand" href="dashboard.php"
    ><img
      src="img\Logo Aparat.png"
      alt=""
      style="width: 100px"
      class="py-2"
  /></a>
  <!-- Hamburger Menu-->
  <button
    class="navbar-toggler border-0"
    type="button"
    id="sidebarToggle"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder gap-2">
      <li class="nav-item"><a class="nav-link" href="dashboard.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="buatsurat.php">Buat Surat</a></li>
      <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
      <li class="nav-item"><a class="nav-link border-bottom" href="hubungikami.php">Hubungi Kami</a></li>
    </ul>
  <div class="dropdown">
    <button
      class="btn dropdown-toggle d-flex align-items-center gap-1"
      type="button"
      id="dropdownMenuButton"
      data-bs-toggle="dropdown"
      aria-expanded="false"
      style="background-color: #003298; border: none"
    >
      <img
        src="img/profile.svg"
        style="width: 50px"
      />
      <div style="text-align: left">
        <small class="text-light"><?php echo $_SESSION['username']; ?></small>
        <small class="d-block text-light" style="font-size: 12px"
          >Mahasiswa</small
        >
      </div>
    </button>
    <ul
      class="dropdown-menu font-sm"
      aria-labelledby="dropdownMenuButton"
    >
      <li>
      <form action="dashboard.php" method="POST">
         <button class="dropdown-item" id="logout" name="logout"> <i class="fa-solid fa-right-from-bracket me-2" style="color: #003298;"></i>Log Out</button>
      </form>
      </li>
    </ul>
  </div>
</div>
</nav>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <button id="sidebarClose" class="btn-close p-2"></button>
      </div>
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder gap-2">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="buatsurat.php">Buat Surat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="riwayat.php">Riwayat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link bg-selected" href="hubungikami.php">Hubungi Kami</a>
      </li>
    </ul>
    <div class="dropdown">
      <button
        class="btn dropdown-toggle d-flex align-items-center gap-1"
        type="button"
        id="dropdownMenuButton"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        style="background-color: #003298; border: none"
      >
        <img
          src="img/profile.svg"
          style="width: 50px"
        />
        <div style="text-align: left">
          <small class="text-light"><?php echo $_SESSION['username']; ?></small>
          <small class="d-block text-light" style="font-size: 12px"
            >Mahasiswa</small
          >
        </div>
      </button>
      <ul
        class="dropdown-menu font-sm"
        aria-labelledby="dropdownMenuButton"
      >
        <li>
        <form action="dashboard.php" method="POST">
         <button class="dropdown-item" id="logout" name="logout"> <i class="fa-solid fa-right-from-bracket me-2" style="color: #003298;"></i>Log Out</button>
      </form>
        </li>
      </ul>
    </div>
  </div>

<header class="py-5" data-aos="fade-up">
  <div class="container px-lg-0 px-sm-5">
    <div class="text-center my-5">
      <h1 class="fw-semibold mt-2" style="color: #003298;">
        Hubungi Kami
      </h1>
      </div>
      <div class="col-xxl-12 col-sm-12 mt-xxl-5 mt-sm-0">
        <div class="collapsible p-5">
          <p class="fs-4 m-0" style="color: #003298;">
            Kharlos (4342411066) : +62 895-3620-70050 <br>
            Fasha (4342411071) : +62 831-6157-9431 <br>
            Radhi (4342411074) : +62 812-7561-7766 <br>
            Imah (4342411066) : +62 821-7462-3843 <br>
            Winda (4342411067) : +62 812-7751-5260 <br>
            Adit (4342411070) : +62 857-6625-8595 <br></p>
        </div>
      </div>
    </div>
  </div>
  </header>

  <footer class="mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <hr style="color: #003298;">
          <p class="px-5 px-lg-0" style="color: #003298;">
            &copy; 2024 Designed & Developed by HYPEBIZZ
          </p>
        </div>
      </div>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
