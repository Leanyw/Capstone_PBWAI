<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Article
    </button>
    <div class="row">
        <div class="table-responsive" id="article_data"></div>

        <!-- Awal Modal Tambah-->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Article</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" required>
                            </div>
                            <div class="mb-3">
                            <label for="floatingTextarea2">Isi</label>
                            <textarea class="form-control" id="isi" placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
                            </div>
                            <!-- 🔥 FIELD SUMMARY (BARU) -->
                            <div class="mb-3">
                                <label class="form-label">Ringkasan Artikel (AI)</label>
                                <textarea class="form-control" name="summary" id="summary" rows="3"
                                    placeholder="Klik Generate Summary atau isi manual"></textarea>

                                <button type="button" class="btn btn-outline-primary btn-sm mt-2"
                                    onclick="generateSummary()">
                                    ✨ Generate Summary
                                </button>

                                <small class="text-muted d-block mt-1">
                                    Ringkasan dibuat oleh AI dan dapat mengandung ketidaktepatan.
                                </small>
                            </div>
                            <!-- 🔥 END SUMMARY -->

                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah-->
    </div>
</div>

<script>
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "article_data.php",
            method : "POST",
            data : {
					            hlm: hlm
				           },
            success : function(data){
                    $('#article_data').html(data);
            }
        })
    }

    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    }); 
});

function generateSummary() {
    const isi = document.getElementById('isi').value;

    if (isi.length < 30) {
        alert("Isi artikel minimal 30 karakter");
        return;
    }

    fetch("ai/summarize.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "text=" + encodeURIComponent(isi)
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("summary").value = data.summary;
    })
    .catch(() => {
        alert("Gagal menghubungi AI");
    });
}

function generateSummaryEdit(id) {
    const isi = document.getElementById('isi_' + id).value;
    if (isi.length < 30) {
        alert("Isi artikel minimal 30 karakter");
        return;
    }
    fetch("ai/summarize.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "text=" + encodeURIComponent(isi)
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('summary_' + id).value = data.summary;
    })
    .catch(() => {
        alert("Gagal menghubungi AI");
    });
}

// AJAX pagination (sudah ada)
$(document).ready(function(){
    load_data();
    function load_data(hlm){
        $.ajax({
            url : "article_data.php",
            method : "POST",
            data : { hlm: hlm },
            success : function(data){
                $('#article_data').html(data);
            }
        })
    }
    $(document).on('click', '.halaman', function(){
        var hlm = $(this).attr("id");
        load_data(hlm);
    }); 
});

</script>

<?php
include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $summary = $_POST['summary'] ?? '';
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    
    // Upload gambar
    if (!empty($_FILES['gambar']['name'])) {
        $upload = upload_foto($_FILES["gambar"]);
        if (!$upload['status']) {
            echo "<script>alert('" . $upload['message'] . "'); location.reload();</script>";
            die;
        }
        $gambar = $upload['message'];
    } else {
        $gambar = $_POST['gambar_lama'] ?? '';
    }
    
    // INSERT atau UPDATE
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Hapus gambar lama jika upload baru
        if (!empty($_FILES['gambar']['name']) && !empty($_POST['gambar_lama'])) {
            unlink("img/" . $_POST['gambar_lama']);
        }
        
        $sql = "UPDATE article SET judul=?, isi=?, summary=?, gambar=?, tanggal=?, username=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $judul, $isi, $summary, $gambar, $tanggal, $username, $id);
    } else {
        $sql = "INSERT INTO article (judul, isi, summary, gambar, tanggal, username) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $judul, $isi, $summary, $gambar, $tanggal, $username);
    }
    
    if ($stmt->execute()) {
       // BENAR (Redirect ke URL bersih tanpa POST data)
echo "<script>
    alert('Berhasil simpan data');
    window.location.href='admin.php?page=article';
</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
    }
    
    $stmt->close();
    $conn->close();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        // Hapus file gambar dari folder img jika ada
        if (file_exists("img/" . $gambar)) {
            unlink("img/" . $gambar);
        }
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Yakin ingin menghapus data?');
            alert('Hapus data berhasil');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>