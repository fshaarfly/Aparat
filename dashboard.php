<?php
session_start();


if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
  header('Location: index.php');
  exit;
}

if ($_SESSION['role'] != 0) {
  header("Location: dosen.php"); 
  exit();
}

if (isset($_POST['logout'])) {
  session_destroy();
  setcookie('remember_me', '', time() - 3600, "/", "", true, true);
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
 
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aparat | Dashboard</title>
    <link
      rel="icon"
      type="image/x-icon"
      href="img\iconpolibatam.png"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
      body {
        background-image: url("img/Background\ Vector.png");
        width: 100%;
        height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
      }
      body::-webkit-scrollbar {
      display: none;
}
    </style>
    
  </head>
  <body class="d-flex flex-column h-100">
      <!-- Navigation-->
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
      <li class="nav-item"><a class="nav-link" href="hubungikami.php">Hubungi Kami</a></li>
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
        <a class="nav-link" href="hubungikami.php">Hubungi Kami</a>
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

      <!-- Header-->
      <header class="py-5">
        <div class="container px-5 py-5 pt-sm-0" data-aos="fade-up">
          <div class="row gx-5 align-items-center">
            <!-- Kolom teks -->
            <div class="col-xxl-8 col-lg-6 text-center text-lg-start aos-init aos-animate" data-aos="fade-up">
              <h5 class="text-light">
                Selamat datang <strong><?php echo $_SESSION['username']; ?></strong> di,
              </h5>
              <h1 class="display-3 fw-bolder mb-3">
                <span class="text-light"
                  >Aplikasi Permintaan Surat Menyurat.</span
                >
              </h1>
              <h5 class="mb-4 text-light">
                Buat Surat Anda Dengan Cepat dan Mudah di Website
                Kami!
              </h5>
              <div
                class="d-grid gap-3 d-sm-flex justify-content-center justify-content-lg-start"
              >
                <a
                  class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-7 fw-semibold"
                  href="buatsurat.php"
                  >Mulai Buat Surat</a
                >
              </div>
            </div>
            <!-- Kolom gambar -->
            <div
              class="col-xxl-4 col-lg-6 d-flex justify-content-center mt-5 mt-lg-0 d-none d-lg-block"
            >
              <img
                class="img-fluid"
                src="img/writing.svg"
                alt="Ilustrasi menulis surat"
              />
            </div>
          </div>
        </div>
      </header>
      <section class="py-5 mt-0 mt-lg-6">
        <div class="container px-5 py-5 pt-sm-0" data-aos="fade-up">
          <div class="row gx-5 align-items-center">
            <div class="col-xxl-6 d-none d-lg-block">
                <img 
                style="max-width: 100%; height: 500px;" 
                src="img/pc.svg" alt="">
            </div>
            <div class="col-xxl-6">
                <p class="text-justify fw-normal fs-4" style="color: #003298;">Aplikasi Permintaan Surat Menyurat (APARAT) adalah situs web Polibatam yang menyediakan layanan terkait permintaan surat menyurat untuk mahasiswa yang dijalankan oleh pihak akademik Polibatam.</p>
            <p class="text-justify fw-normal fs-4" style="color: #003298;">Website ini mencakup <strong>Surat Keterangan Mahasiswa, Surat Pengajuan Kartu Mahasiswa, Transkrip Akademik Sementara, dan Lembar Kemajuan Akademik.</strong></p>
            </div>
        </div>
      </section>

      <footer class="text-white d-flex align-items-center" style="background-color: #003298;">
        <div class="container">
            <div class="row py-4 d-flex align-items-center text-md-start">
                <div class="col-xxl-2 d-flex justify-content-center align-items-center">
                    <a href="#"><img src="img\Logo Aparat.png" style="width: 100px;" alt=""></a>
                </div>
                <div class="col-xxl-4 text-center">
                    <p class="my-2 mt-4 text-light">Alamat: Jl. Ahmad Yani Batam Kota.</p>
                    <p class="my-2">Kota Batam, Kepulauan Riau, Indonesia.</p>
                </div>
                <div class="col-xxl-2 text-center">
                    <a href="#"><p class="my-2 mt-4" style="color: #fff;">Home</p></a>
                    <a href="buatsurat.php"><p class="my-2" style="color: #fff;">Buat Surat</p></a>
                </div>
                <div class="col-xxl-4 text-center">
                    <a href="riwayat.php"><p class="my-2 mt-4" style="color: #fff;">Riwayat</p></a>
                    <a href="hubungikami.php"><p class="my-2" style="color: #fff;">Hubungi Kami</p></a>
                </div>
            </div>
            <div class="col-xxl-12 text-center">
                <hr>
                <p>
                    Copyright &copy; Designed & Developed by HYPEBIZZ 2024
                  </p>
            </div>
        </div>

      </footer>
      


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <?php
    if (isset($logout_script)) {
        echo $logout_script;
    }
    ?>
  </body>
</html>
