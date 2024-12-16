<?php
include 'database.php';
session_start();

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
  header('Location: dashboard.php');
  exit;
}

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  try {
    $sql = "INSERT INTO users (username, password) VALUES 
    ('$username', '$password')";
  
    if($db->query($sql)) {
      $berhasil_script = "
      <script>
      Swal.fire({
          title: 'Register Berhasil',
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
  } catch (mysqli_sql_exception) {
    $gagal_script = "
      <script>
      Swal.fire({
          title: 'Register Gagal',
          text: 'Username sudah terdaftar.',
          icon: 'error',
          confirmButtonText: 'OK',
          customClass: {
              confirmButton: 'my-confirm-button' 
          }
      });
      </script>
  ";
  }

$db->close();
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
    <title>Aparat | Register</title>
    <link rel="icon" type="image/x-icon" href="img/iconpolibatam.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="css/styles.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    />
    <style>
      button {
        font-weight: 700;
        width: 100%;
        font-size: 15px;
        padding: 15px;
        background-color: #003298;
        color: white;
        border: 1px solid #003298;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s;
      }

      button:hover {
        background-color: #ffffff;
        border: 1px solid #003298;
        color: #003298;
      }
    </style>
  </head>
  <body>
    <div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <div class="row corner box-area">
        <div class="col-lg-6 d-flex justify-content-center">
          <div class="row align-items-center mx-2 mx-sm-5 my-5">
          <div class="logo">
              <img src="img\Logo Aparat-blue.png" style="width: 50%" />
            </div>
            <h1 class="mt-n4">
              <a href="register.php" class="text-dark fw-bold">Sign In.</a>
            </h1>
            <form action="register.php" method="POST">
              <div class="form-group mb-2">
                <label class="text-dark fw-bold mb-2" for="username"
                  >Username <span class="required">*</span></label
                >
                <input
                  type="text"
                  id="username"
                  name="username"
                  placeholder="Masukkan username"
                  required=""
                  class="input-group"
                />
              </div>
              <div class="form-group">
                <label class="text-dark fw-bold mb-2" for="password"
                  >Password <span class="required">*</span></label
                >
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Masukkan password"
                  required=""
                  class="input-group mb-n2"
                />
                <span class="password-toggle-icon"
                  ><i
                    class="fas fa-eye-slash"
                    id="togglePassword"
                    style="color: #808080"
                  ></i
                ></span>
              </div>
              <div class="form-check mb-2">
                <input type="checkbox" id="remember" />
                <label class="text-dark" for="remember">Remember me</label>
              </div>
              <button
                class="mb-3"
                type="submit"
                name="register"
              >
                Sign In
              </button>
              <p class="text-dark text-center" style="font-size: 12px">
                Sudah Punya Akun?
                <a class="daftardisini" href="index.php"
                  >Login disini</a
                >
              </p>
            </form>
          </div>
        </div>

        <div class="col-lg-6 p-0 d-none d-lg-block">
          <img src="img/Login Page.png" class="img-fluid image" />
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      const passwordField = document.getElementById("password");
      const togglePassword = document.getElementById("togglePassword");

      togglePassword.addEventListener("click", function () {
        if (passwordField.type === "password") {
          passwordField.type = "text";
          togglePassword.classList.remove("fa-eye-slash");
          togglePassword.classList.add("fa-eye");
        } else {
          passwordField.type = "password";
          togglePassword.classList.remove("fa-eye");
          togglePassword.classList.add("fa-eye-slash");
        }
      });
    </script>

<?php
    if (isset($berhasil_script)) {
        echo $berhasil_script;
    }
    if (isset($gagal_script)) {
      echo $gagal_script;
  }
    ?>
  </body>
</html>
