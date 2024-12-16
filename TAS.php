<?php
include 'database.php';
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
  header('Location: index.php');
  exit;
}

if (!isset($_SESSION['user_id'])) {
  echo "Error: user_id tidak ditemukan di sesi!";
  exit;
}

if (isset($_POST['buatsurat'])) {
  // Pastikan user_id diambil dari sesi
  $user_id = $_SESSION['user_id'];  // Ambil user_id dari sesi

  // Query menggunakan prepared statement
  $stmt = mysqli_prepare($db, "INSERT INTO surat (user_id, nama, nim, tahun_ajaran, jurusan, prodi, alasan, jenis_surat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  $jenis_surat = "TAS";

  // Bind parameter ke prepared statement
  mysqli_stmt_bind_param($stmt, "isssssss", $user_id, $_POST['nama'], $_POST['nim'], $_POST['tahun_ajaran'], $_POST['jurusan'], $_POST['prodi'], $_POST['alasan'], $jenis_surat);

  // Eksekusi query
  if (mysqli_stmt_execute($stmt)) {
    $berhasil_script = "
    <script>
    Swal.fire({
        title: 'Berhasil Membuat Surat',
        text: 'Anda akan diarahkan ke halaman riwayat.',
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#003289'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'riwayat.php';
        }
    });
    </script>
";
  } else {
      echo "Gagal menyimpan data: " . mysqli_error($db);
  }

  // Tutup statement
  mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aparat | Buat Surat</title>
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
  <style>
    .buttnn{
      background-color: #003298;
      color: white;
      border-radius: 0.375rem;
      border: 1px solid #ced4da;
      padding: 0.5rem 0.75rem;
      font-size: 13px;
      transition: 0.3s ease;
      border: #003298 2px solid;
    }
    .buttnn:hover{
      background-color: #fff;
      color: #003298;

    }
  </style>
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

      <div class="col-xxl-12 d-flex justify-content-center align-items-center my-5" data-aos="fade-up">
        <div class="container mx-0 mx-sm-5 p-0">
          <div class="collapsible py-4">
            <h5 class="text-dark text-center">Transkrip Akademik Sementara</h5>
            <hr class="text-dark">
            <div class="row px-5 py-2">

              <div class="col-lg-6 col-sm-12 px-0 px-lg-5">
                <form method="POST">
                  <label class="form-label text-dark">Nama Lengkap<span class="required">*</span></label>
                  <input type="text" name="nama" class="form-control mb-3" placeholder="Contoh: Gojo Satoru" required>

                  <label class="form-label text-dark">Nim<span class="required">*</span></label>
                  <input type="text" name="nim" class="form-control mb-3" placeholder="Contoh: 4342411071" required>

                  <label class="form-label text-dark">Tahun Ajaran<span class="required">*</span></label>
                  <input type="text" name="tahun_ajaran" class="form-control mb-3" placeholder="Contoh: 2024" required>
              </div>

              <div class="col-lg-6 col-sm-12 px-0 px-lg-5">
                  <label class="form-label text-dark">Jurusan<span class="required">*</span></label>
                  <input type="text" name="jurusan" class="form-control mb-3" placeholder="Contoh: Informatika" required>

                  <label class="form-label text-dark">Prodi<span class="required">*</span></label>
                  <input type="text" name="prodi" class="form-control mb-3" placeholder="Contoh: TRPL" required>

                  <label class="form-label text-dark">Alasan Membuat Surat<span class="required">*</span></label>
                  <input type="text" name="alasan" class="form-control mb-3" placeholder="Contoh: Untuk Surat Keterangan Mahasiswa" required>
              </div>
              <div class="col-12 px-0 px-lg-5 mt-2">
                <button type="submit" name="buatsurat" class="buttnn w-100">Buat Surat</button>
              </div>
            </form>
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
      <?php
      if (isset($berhasil_script)) {
        echo $berhasil_script;
    }
    ?>
  </body>
</html>
