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

$query = "SELECT * FROM surat WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']); // Mengambil data berdasarkan user_id yang ada di session
$stmt->execute();
$result = $stmt->get_result();

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link href="css/styles.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
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

          <div class="container-fluid d-flex justify-content-center align-items-center my-5" data-aos="fade-up">
            <div class="table-responsive collapsible py-4 px-5 w-100 mx-0 mx-sm-5">
                <table class="table w-100 table-hover table-striped table-bordered text-dark text-center align-middle" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tahun Ajaran</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
            // Iterasi melalui data yang diambil dari database dan masukkan ke dalam tabel
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['nim'] . "</td>";
                echo "<td>" . $row['prodi'] . "</td>";
                echo "<td>" . $row['tahun_ajaran'] . "</td>";
                echo "<td>" . $row['jenis_surat'] . "</td>";
                echo "<td>" . $row['tanggal_buat'] . "</td>";
                echo "<td><a href='detail.php?id=" . $row['id'] . "' class='btn btn-gray'>Detail</a></td>";
                echo "<td><button class='btn btn-success'>Download PDF</button></td>";
                echo "</tr>";
            }
            ?>
          </tbody>
                </table>
            </div>
        </div>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>
  </body>
</html>
