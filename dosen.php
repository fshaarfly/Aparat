<?php
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
  header('Location: index.php');
  exit;
}
if ($_SESSION['role'] != 1) {
  header("Location: dashboard.php");
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
    <title>Website Surat Poilibatam</title>
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
        class="navbar navbar-expand-lg navbar-light py-0 sticky-top"
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
          <h6 class="text-light fw-bold m-0">VALIDASI</h6>
          <!-- Hamburger Menu-->
          <button
            class="navbar-toggler border-0"
            type="button"
            id="sidebarToggle"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
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
                  >Dosen</small
                >
              </div>
            </button>
            <ul
              class="dropdown-menu font-sm"
              aria-labelledby="dropdownMenuButton"
            >
              <li>
              <form action="dosen.php" method="POST">
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
                    >Dosen</small
                  >
                </div>
              </button>
              <ul
                class="dropdown-menu font-sm"
                aria-labelledby="dropdownMenuButton"
              >
                <li>
                <form action="dosen.php" method="POST">
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
                            <th>Tanggal</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>102</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>103</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>104</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Fasha Ar-Rafly</td>
                            <td>4342411071</td>
                            <td>TRPL</td>
                            <td>2024</td>
                            <td>10-10-2024</td>
                            <td>
                                <button class="btn btn-gray">Detail</button>
                            </td>
                            <td>
                                <button class="btn btn-success">Download PDF</button>
                            </td>
                        </tr>
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
<?php
    if (isset($logout_script)) {
        echo $logout_script;
    }
    ?>
  </body>
</html>
