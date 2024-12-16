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
    <title>Aparat | Buat Surat</title>
    <link
      rel="icon"
      type="image/x-icon"
      href="img/iconpolibatam.png"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        .dropdown-menu {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            
        }
        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
        }
        .dropdown-toggle::after {
            transition: transform 0.3s ease;
        }
        .collapsible{
            color: #003298;
            transition: ease 0.3s;
        }
        .collapsible:hover {
            background-color: #dedede;
        }
    </style>
  </head>
  <body class="d-flex flex-column h-100">
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
      <li class="nav-item"><a class="nav-link border-bottom" href="buatsurat.php">Buat Surat</a></li>
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
        <a class="nav-link bg-selected" href="buatsurat.php">Buat Surat</a>
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

      <header class="py-5" data-aos="fade-up">
        <div class="container px-lg-0 px-sm-5">
          <div class="text-center my-5">
            <h1 class="fw-semibold mt-2" style="color: #003298;">
              Jenis Surat
            </h1>
            <h6 class="mt-2" style="color: #003298;">Pilih dahulu <strong>Jenis Surat</strong> yang ingin kamu buat</h6>
          </div>
        </div>
        <div class="container mt-5">
            <div class="dropdown">
                <div class="col-xxl-12">
                    <div class="collapsible p-3 dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-info" style="font-size: 1rem; color: #003298;"></i>
                        <label class="px-2 fw-semibold">Baca Panduan</label>
                    </div>
                    <div class="dropdown-menu px-3 py-4 w-100" aria-labelledby="dropdownMenuButton">
                        <h3 class="fw-semibold mt-2 text-center" style="color: #003298;">
                            Panduan Pembuatan Surat
                          </h3>
                          <hr class="text-dark">
                        <ol class="my-2 mx-lg-5 mx-sm-2 fw-normal" style="color: #003298; font-size: 20px">
                            <li class="py-3">Pilih Jenis Surat yang Ingin Kamu Buat</li>
                            <li class="py-3">Masukkan Data Diri Pada Kolom Formulir</li>
                            <li class="py-3">Jika Sudah Tekan Tombol Buat Surat</li>
                            <li class="py-3">Anda Akan Diarahkan Ke Halaman Riwayat Untuk Melihat Detail Atau Download Surat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5 pt-sm-0">
            <div class="row gx-5 align-items-center">
                    <div class="col-xxl-6 col-sm-12 mt-xxl-5 mt-sm-0">
                        <a href="SKM.php">
                        <div class="collapsible p-4"s>
                        <h6 class="fw-bold">Surat Keterangan Mahasiswa (SKM)</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quibusdam rerum deserunt ducimus animi nobis suscipit eius ad sed repellendus.</p>
                        </div>
                        </a>
                    </div>
                    <div class="col-xxl-6 col-sm-12 mt-5">
                        <a href="PKM.php">
                        <div class="collapsible p-4"s>
                        <h6 class="fw-bold">Pengajuan Kartu Mahasiswa</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quibusdam rerum deserunt ducimus animi nobis suscipit eius ad sed repellendus.</p>
                        </div>
                        </a>
                    </div>
                    <div class="col-xxl-6 col-sm-12 mt-5">
                        <a href="TAS.php">
                        <div class="collapsible p-4"s>
                        <h6 class="fw-bold">Transkrip Akademik Sementara</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quibusdam rerum deserunt ducimus animi nobis suscipit eius ad sed repellendus.</p>
                        </div>
                        </a>
                    </div>
                    <div class="col-xxl-6 col-sm-12 mt-5">
                        <a href="LKA.php">
                        <div class="collapsible p-4"s>
                        <h6 class="fw-bold">Lembar Kemajuan Akademik (LKA)</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, quibusdam rerum deserunt ducimus animi nobis suscipit eius ad sed repellendus.</p>
                        </div>
                        </a>
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
