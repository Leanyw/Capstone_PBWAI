<?php
//memulai session atau melanjutkan session yang sudah ada
session_start();

//menyertakan code dari file koneksi
include "koneksi.php";

//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  
  //menggunakan fungsi enkripsi md5 supaya sama dengan password  yang tersimpan di database
  $password = md5($_POST['pass']);

	//prepared statement
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

	//parameter binding 
  $stmt->bind_param("ss", $username, $password);//username string dan password string
  
  //database executes the statement
  $stmt->execute();
  
  //menampung hasil eksekusi
  $hasil = $stmt->get_result();
  
  //mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  //check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    //jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    //mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
	  //jika tidak ada (gagal), alihkan kembali ke halaman login
    header("location:login.php");
  }

	//menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Daily Journal</title>
    <link rel="icon" href="img/logo.png" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <style>
      body {
        background-color: #ebfdfa;
        font-family: "Courier New", monospace;
      }

      .login-card {
        border-radius: 25px;
        padding: 2rem;
      }

      .input-custom {
        border-radius: 15px !important;
        padding: 12px 15px;
      }

      .alert-custom {
        width: 260px;
        margin: 20px auto;
        border-radius: 20px;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <div class="container mt-5 pt-4">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">

          <div class="card shadow login-card border-0">
            <div class="text-center mb-3">
              <i class="bi bi-person-circle display-4"></i>
              <p class="mt-2 fs-5">My Daily Journal</p>
              <hr />
            </div>

            <form action="" method="post">
              <input
                type="text"
                name="user"
                class="form-control my-3 input-custom"
                placeholder="Username"
              />

              <input
                type="password"
                name="pass"
                class="form-control my-3 input-custom"
                placeholder="Password"
              />

              <div class="d-grid mt-3">
                <button class="btn btn-success rounded-4 py-2">Login</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <?php
      // username & password dummy
      $username = "admin";
      $password = "123456";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

          $inputUser = $_POST['user'];
          $inputPass = $_POST['pass'];

          if ($inputUser == $username AND $inputPass == $password) {
              echo '
                <div class="alert alert-success alert-custom shadow">
                  <b>user :</b> '.$inputUser.'<br>
                  <b>pass :</b> '.$inputPass.'<br>
                  Username dan Password Benar
                </div>';
          } else {
              echo '
                <div class="alert alert-danger alert-custom shadow">
                  <b>user :</b> '.$inputUser.'<br>
                  <b>pass :</b> '.$inputPass.'<br>
                  Username dan Password Salah
                </div>';
          }
      }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
}
?>