<?php
include 'database.php';
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

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query database untuk mendapatkan data berdasarkan ID
  $query = "SELECT * FROM surat WHERE id = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Cek apakah data ditemukan
  if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
  } else {
      echo "Data tidak ditemukan.";
      exit;
  }
} else {
  echo "ID tidak ditemukan.";
  exit;
}

if (isset($_POST['delete'])) {
  if (isset($_POST['id']) && is_numeric($_POST['id'])) {
      $deleteId = intval($_POST['id']); // Konversi ke integer untuk keamanan
      $deleteQuery = "DELETE FROM surat WHERE id = ?";
      $stmt = $db->prepare($deleteQuery);

      if ($stmt) {
          $stmt->bind_param("i", $deleteId);
          if ($stmt->execute()) {
            $hapus_script = "
            <script>
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Kamu tidak akan dapat mengembalikannya!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#003289',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
          }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Data berhasil dihapus.',
                    confirmButtonColor: '#003289',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'riwayat.php';
                });
            }
        });
    </script>
        ";
          } 
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aparat | Riwayat</title>
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
      <li class="nav-item"><a class="nav-link border-bottom" href="riwayat.php">Riwayat</a></li>
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
        <a class="nav-link bg-selected" href="riwayat.php">Riwayat</a>
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
            <div class="head px-5">
                <div class="row">
                    <div class="col-auto">
                        <h6 class="text-dark"><?php echo $data['id']; ?></h6>
                    </div>
                    <div class="col-auto">
                        <h6 class="text-dark"><?php echo $data['nama']; ?></h6>
                    </div>
                </div>
            </div>

            <hr class="text-dark">
            <div class="row px-5 py-2">

              <div class="col-lg-6 col-sm-12 px-0 px-lg-5">
                <form action="">
                  <label class="form-label text-dark">Nama Lengkap<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: Gojo Satoru" required value="<?php echo $data['nama']; ?>">

                  <label class="form-label text-dark">Nim<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: 4342411071" required value="<?php echo $data['nim']; ?>">

                  <label class="form-label text-dark">Tahun Ajaran<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: 2024" required value="<?php echo $data['tahun_ajaran']; ?>">
              </div>

              <div class="col-lg-6 col-sm-12 px-0 px-lg-5">
                  <label class="form-label text-dark">Jurusan<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: Informatika" required value="<?php echo $data['jurusan']; ?>">

                  <label class="form-label text-dark">Prodi<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: TRPL" required value="<?php echo $data['prodi']; ?>">

                  <label class="form-label text-dark">Alasan Membuat Surat<span class="required">*</span></label>
                  <input type="text" class="form-control mb-3" placeholder="Contoh: Untuk Surat Keterangan Mahasiswa" required value="<?php echo $data['alasan']; ?>">
              </div>
              </form>
              <div class="col-6 px-0 px-lg-5 mt-2">
              <a href="riwayat.php" class="btn btn-gray">Kembali</a>
              </div>
              <div class="col-6 px-0 px-lg-5 mt-2 d-flex justify-content-end">
              <form method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                  <button type="submit" name="delete" class="me-3 btn btn-danger">Hapus Data</button>
              </form>
              <a href="riwayat.php" class="btn btn-success">Download PDF</a>
              </div>
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
      if (isset($logout_script)) {
      echo $logout_script;
  }
  if (isset($hapus_script)) {
    echo $hapus_script;
}
  ?>
  </body>
</html>
