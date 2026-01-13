<div class="container">

<button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
  <i class="bi bi-plus-lg"></i> Tambah Foto
</button>

<div id="gallery_data"></div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Foto</h5>
        </div>
        <div class="modal-body">
          <input type="file" name="gambar" class="form-control" required>
        </div>
        <div class="modal-footer">
          <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

</div>

<script>
$(document).ready(function(){
  load_data(1);

  function load_data(hlm){
    $.ajax({
      url: "gallery_data.php",
      method: "POST",
      data: { hlm: hlm },
      success: function(data){
        $('#gallery_data').html(data);
      }
    });
  }

  $(document).on('click','.halaman',function(){
    var hlm = $(this).attr("id");
    load_data(hlm);
  });
});
</script>

<?php
include "upload_foto.php";

/* SIMPAN */
if(isset($_POST['simpan'])){
  $username = $_SESSION['username'];
  $upload = upload_foto($_FILES['gambar']);

  if(!$upload['status']){
    echo "<script>alert('".$upload['message']."')</script>";
    die;
  }

  $stmt = $conn->prepare(
    "INSERT INTO gallery (gambar,username) VALUES (?,?)"
  );
  $stmt->bind_param("ss",$upload['message'],$username);
  $stmt->execute();
}

/* UPDATE */
if(isset($_POST['update'])){
  unlink("img/".$_POST['gambar_lama']);

  $upload = upload_foto($_FILES['gambar']);
  $stmt = $conn->prepare(
    "UPDATE gallery SET gambar=? WHERE id=?"
  );
  $stmt->bind_param("si",$upload['message'],$_POST['id']);
  $stmt->execute();
}

/* HAPUS */
if(isset($_POST['hapus'])){
  unlink("img/".$_POST['gambar']);
  $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
  $stmt->bind_param("i",$_POST['id']);
  $stmt->execute();
}
?>