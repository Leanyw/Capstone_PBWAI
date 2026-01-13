<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Daily Journal</title>
  <link rel="icon" href="img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      background-color: #ebfdfa;
      font-family: "Courier New", monospace;
      color: #1e1e1e;
    }

    /* NAVBAR */
    .navbar {
      background-color: #d6ebe7 !important;
      border-bottom: 2px solid #333;
    }

    .navbar-brand {
      font-weight: bold;
      color: #1e1e1e !important;
    }

    .nav-link {
      font-weight: bold;
      color: #1e1e1e !important;
      transition: 0.2s ease;
    }

    .nav-link:hover {
      color: #497d74 !important;
      border-bottom: 2px solid #497d74;
    }

    /* THEME SWITCH BUTTONS */
    .theme-btn {
      border: 2px solid #333;
      background: #d6ebe7;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-left: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .theme-btn:hover {
      transform: scale(1.1);
      background: #bfe1db;
    }

    /* HERO */
    #hero {
      background-color: #cfeeea;
      border-bottom: 2px solid #333;
    }

    #hero img {
      border: 2px solid #333;
      border-radius: 10px;
      box-shadow: 4px 4px 0 #333;
    }

    #hero h1 {
      font-weight: bold;
    }

    /*PROFILE & SCHEDULE*/
    #profile,
    #schedule {
      min-height: 100vh;
      display: flex;
      align-items: center;
      background-color: #f8fffd;
      border-top: 2px solid #333;
      border-bottom: 2px solid #333;
    }

    /* ARTICLE */
    #article {
      background: #f8fffd;
      border-top: 2px solid #333;
      border-bottom: 2px solid #333;
    }

    .card {
      border: 2px solid #333 !important;
      border-radius: 8px;
      background: #ffffff;
      box-shadow: 3px 3px 0 #333;
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 5px 5px 0 #333;
    }

    .card img {
      border-bottom: 2px solid #333;
    }

    .card-footer {
      background-color: #e9f3f1;
      border-top: 2px solid #333;
      font-size: 0.9rem;
    }

    .profile-card {
      overflow: hidden;
    }

    .profile-card table {
      width: 100%;
    }

    .profile-card table td {
      word-break: break-word;
    }

    .profile-card th {
      width: 40%;
    }


    /* GALLERY */
    #gallery {
      background-color: #d6ebe7;
      border-top: 2px solid #333;
      border-bottom: 2px solid #333;
    }

    #gallery img {
      border: 2px solid #333;
      border-radius: 8px;
      box-shadow: 3px 3px 0 #333;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      filter: invert(1) brightness(0.3);
    }

    #gallery .carousel {
      border-radius: 10px;
      box-shadow: 4px 4px 0 #333;
    }

    @media (max-width: 768px) {
      #gallery img {
        height: 300px !important;
      }
    }

    body.dark-mode #gallery img {
      border-color: #f8f8f8;
    }

    /* CONTACT */
    #contact {
      background-color: #f8fffd;
      border-top: 2px solid #333;
      border-bottom: 2px solid #333;
      padding: 5rem 0;
    }

    form {
      border: 2px solid #333;
      border-radius: 10px;
      background: #ffffff;
      padding: 30px;
      box-shadow: 4px 4px 0 #333;
    }

    form input,
    form textarea {
      border: 2px solid #333;
      border-radius: 6px;
      font-family: inherit;
      background-color: #f8fffd;
    }

    form button {
      border: 2px solid #333;
      background: #d6ebe7;
      font-weight: bold;
      transition: 0.2s ease;
    }

    form button:hover {
      background: #bfe1db;
      transform: translateY(-2px);
    }

    .contact-info {
      background: #d6ebe7;
      border: 2px solid #333;
      border-radius: 10px;
      box-shadow: 3px 3px 0 #333;
      padding: 30px;
      height: 100%;
    }

    .contact-info h5 {
      font-weight: bold;
    }

    /* FOOTER */
    footer {
      background-color: #e9f3f1;
      border-top: 2px solid #333;
      font-weight: bold;
      color: #1e1e1e;
    }

    footer i {
      margin: 0 10px;
      transition: 0.2s ease;
    }

    footer i:hover {
      color: #497d74;
      transform: scale(1.2);
    }

    /* ===== DARK MODE ===== */
    body.dark-mode {
      background-color: #1e1e1e;
      color: #f8f8f8;
    }

    body.dark-mode .navbar {
      background-color: #2a2a2a !important;
      border-bottom: 2px solid #f8f8f8;
    }

    body.dark-mode .navbar-brand {
      color: #f8f8f8 !important;
    }

    body.dark-mode .nav-link {
      color: #f8f8f8 !important;
    }

    body.dark-mode .nav-link:hover {
      color: #bfe1db !important;
      border-bottom: 2px solid #bfe1db;
    }

    body.dark-mode #hero,
    body.dark-mode #gallery {
      background-color: #592e2e;
      border-color: #f8f8f8;
    }

    body.dark-mode #profile,
    body.dark-mode #schedule {
      background-color: #696969;
    }

    body.dark-mode #article,
    body.dark-mode #contact {
      background-color: #696969;
      border-top: 2px solid #f8f8f8;
    }

    body.dark-mode #article h1,
    body.dark-mode #profile h1,
    body.dark-mode #schedule h1,
    body.dark-mode #contact h1 {
      color: #1e1e1e !important;
    }

    body.dark-mode .card {
      background: #333;
      border-color: #f8f8f8 !important;
      color: #f8f8f8;
      box-shadow: 3px 3px 0 #333;
    }

    body.dark-mode .card img {
      border-bottom: 2px solid #f8f8f8;
    }

    body.dark-mode .card-footer {
      background-color: #1e1e1e;
      border-top: 2px solid #f8f8f8;
      color: #bfe1db;
    }

    body.dark-mode #profile .card,
    body.dark-mode #schedule .card {
      background: #333;
      color: #f8f8f8;
      border-color: #f8f8f8 !important;
      box-shadow: 3px 3px 0 #f8f8f8;
    }

    body.dark-mode form {
      background: #2f2f2f;
      border-color: #f8f8f8;
      box-shadow: 3px 3px 0 #f8f8f8;
      color: #f8f8f8;
    }

    body.dark-mode form input,
    body.dark-mode form textarea {
      background: #1e1e1e;
      border-color: #f8f8f8;
      color: #f8f8f8;
    }

    body.dark-mode form button {
      background: #444;
      border-color: #f8f8f8;
      color: #f8f8f8;
    }

    body.dark-mode form button:hover {
      background: #666;
    }

    body.dark-mode .contact-info {
      background: #333;
      border-color: #f8f8f8;
      box-shadow: 3px 3px 0 #f8f8f8;
      color: #f8f8f8;
    }

    body.dark-mode footer {
      background-color: #2a2a2a;
      color: #f8f8f8;
      border-top: 2px solid #f8f8f8;
    }

    body.dark-mode footer i:hover {
      color: #bfe1db;
    }

    body.dark-mode .theme-btn {
      background: #444;
      border-color: #f8f8f8;
      color: #f8f8f8;
    }

    body.dark-mode .theme-btn:hover {
      background: #666;
    }
  </style>
</head>

<body>
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">My Daily Journal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#profile">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#schedule">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#article">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#journal">Journal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php" target="_blank">Login</a>
          </li>
        </ul>

        <div class="d-flex ms-3">
          <button class="theme-btn" id="darkBtn" title="Dark Mode">
            <i class="bi bi-moon"></i>
          </button>
          <button class="theme-btn" id="lightBtn" title="Light Mode">
            <i class="bi bi-brightness-high"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section id="hero" class="text-center p-5 text-sm-start">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 text-center">
          <img src="img/pfp.png" class="img-fluid" width="300" />
        </div>
        <div class="col-md-7">
          <h1 class="fw-bold display-5">
            Create Memories, Save Memories, Everyday
          </h1>
          <h4 class="lead display-6 mt-3">
            Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali.
          </h4>
          <h6>
            <span id="tanggal"></span>
            <span id="jam"></span>
          </h6>
        </div>
      </div>
    </div>
  </section>

  <!-- PROFILE -->
  <section id="profile" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-4">Profile</h1>
      <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
        <div class="col">
          <div class="card h-100 text-start overflow-hidden profile-card">
            <div class="card-body">
              <h5 class="fw-bold text-center mb-3">Nayla Aulia Wijaya</h5>
              <table class="table table-bordered mb-0 w-100">
                <tr>
                  <th>NIM</th>
                  <td>A11.2024.15906</td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td>Teknik Informatika</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>111202415906@mhs.dinus.ac.id</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 text-start overflow-hidden profile-card">
            <div class="card-body">
              <h5 class="fw-bold text-center mb-3">Muhammad Nafi</h5>
              <table class="table table-bordered mb-0 w-100">
                <tr>
                  <th>NIM</th>
                  <td>A11.2024.15852</td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td>Teknik Informatika</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>111202415852@mhs.dinus.ac.id</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 text-start overflow-hidden profile-card">
            <div class="card-body">
              <h5 class="fw-bold text-center mb-3">Diassafira Mullyan Daru</h5>
              <table class="table table-bordered mb-0 w-100">
                <tr>
                  <th>NIM</th>
                  <td>A11.2024.16069</td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td>Teknik Informatika</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>111202416069@mhs.dinus.ac.id</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 text-start overflow-hidden profile-card">
            <div class="card-body">
              <h5 class="fw-bold text-center mb-3">Ridlo Fanata Wicaksana</h5>
              <table class="table table-bordered mb-0 w-100">
                <tr>
                  <th>NIM</th>
                  <td>A11.2024.16059</td>
                </tr>
                <tr>
                  <th>Program Studi</th>
                  <td>Teknik Informatika</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>16059@mhs.dinus.ac.id</td>
                </tr>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>



  <!-- SCHEDULE -->
  <section id="schedule" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-4">Schedule</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Monday</h5>
              <p class="card-text">
                Logika Informatika (H.5.12)<br />09:30 - 12:00<br />
                Basis Data (H.5.10)<br />14:10 - 15:50<br />
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Tuesday</h5>
              <p class="card-text">
                RPL (H.5.10)<br />12:30 - 15:00<br />
                Sistem Operasi (H.3.2)<br />15:30 - 18:00<br />
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Wednesday</h5>
              <p class="card-text">
                Kriptografi (H.5.13)<br />09:30 - 12:00<br />
                Probasis Web (D.2.J)<br />12:30 - 14:10<br />
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Thursday</h5>
              <p class="card-text">
                Basis Data (D.2.K)<br />14:10 - 15:50<br />
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">Friday</h5>
              <p class="card-text">
                Probstat (H.3.2)<br />09:30 - 12:00<br />
                Data Mining (H.4.3)<br />12:30 - 15:00<br />
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ARTICLE -->
  <section id="article" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3">Article</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
          ?>
          <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"] ?></h5>
                <p class="card-text">
                  <?= $row["isi"] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"] ?>
                </small>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-4">Gallery</h1>

      <div class="border border-2 border-dark rounded shadow-lg overflow-hidden">
        <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">

          <div class="carousel-inner">
            <?php
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
            $hasil = $conn->query($sql);
            $active = "active";

            while ($row = $hasil->fetch_assoc()) {
              ?>
              <div class="carousel-item <?= $active ?>">
                <img src="img/<?= $row['gambar'] ?>" class="d-block w-100" style="height: 450px; object-fit: cover">
              </div>
              <?php
              $active = "";
            }
            ?>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>

        </div>
      </div>
    </div>
  </section>


  <!-- JOURNAL -->
  <section id="journal">
    <div class="container">
      <h1 class="fw-bold text-center mb-5 display-4">My Journal</h1>
      <div class="row g-4">
        <div class="col-md-12">
          <form method="post" action="">
            <div class="mb-3">
              <label for="name" class="form-label">Tittle</label>
              <input type="text" class="form-control" name="tittle" placeholder="Your name..." required />
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Date</label>
              <input type="datetime-local" class="form-control" name="date" required />
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea class="form-control" name="content" rows="4"
                placeholder="Write yout journal here..."></textarea>
            </div>
            <button type="submit" value="simpan_journal" name="simpan_journal" class="btn w-100">Send</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  </br>

  <!-- FOOTER -->
  <footer class="text-center p-5">
    <div>
      <i class="bi bi-instagram"></i>
      <i class="bi bi-twitter-x"></i>
      <i class="bi bi-whatsapp"></i>
    </div>
    <div>&copy; 2025</div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    window.setTimeout("tampilWaktu()", 1000);

    function tampilWaktu() {
      var waktu = new Date();
      var bulan = waktu.getMonth() + 1;

      setTimeout("tampilWaktu()", 1000);
      document.getElementById("tanggal").innerHTML =
        waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
      document.getElementById("jam").innerHTML =
        waktu.getHours() +
        ":" +
        waktu.getMinutes() +
        ":" +
        waktu.getSeconds();
    }

    const darkBtn = document.getElementById("darkBtn");
    const lightBtn = document.getElementById("lightBtn");

    darkBtn.addEventListener("click", () => {
      document.body.classList.add("dark-mode");
    });

    lightBtn.addEventListener("click", () => {
      document.body.classList.remove("dark-mode");
    });
  </script>
</body>

</html>
<?php
if (isset($_POST['simpan_journal'])) {
  $judul = $_POST['tittle'];
  $tanggal = $_POST['date'];
  $isi = $_POST['content'];

  if (empty($judul) || empty($tanggal) || empty($isi)) {
    echo "<script>alert('All fields are required!');</script>";
  } else {
    $sql = "INSERT INTO jurnal (judul, tanggal, isi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $judul, $tanggal, $isi);

    if ($stmt->execute()) {
      // ⛔ JANGAN reload
      echo "<script>location.replace('journal.php?status=success');</script>";
      exit;
    } else {
      echo "<script>location.replace('journal.php?status=error');</script>";
      exit;
    }
  }
}
?>