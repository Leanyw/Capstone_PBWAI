<?php
include "koneksi.php";

$hlm = isset($_POST['hlm']) ? $_POST['hlm'] : 1;
$limit = 6;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM gallery ORDER BY id DESC LIMIT $limit_start,$limit";
$hasil = $conn->query($sql);
?>

<table class="table table-hover">
<thead class="table-dark">
<tr>
  <th>No</th>
  <th>Foto</th>
  <th>Username</th>
  <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php while($row = $hasil->fetch_assoc()) { ?>
<tr>
  <td><?= $no++ ?></td>
  <td><img src="img/<?= $row['gambar'] ?>" width="120"></td>
  <td><?= $row['username'] ?></td>
  <td>
    <a href="#" class="badge bg-success"
       data-bs-toggle="modal"
       data-bs-target="#edit<?= $row['id'] ?>">Edit</a>
    <a href="#" class="badge bg-danger"
       data-bs-toggle="modal"
       data-bs-target="#hapus<?= $row['id'] ?>">Hapus</a>
  </td>
</tr>

<!-- MODAL EDIT -->
<div class="modal fade" id="edit<?= $row['id'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5>Edit Foto</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

          <input type="file" name="gambar" class="form-control" required>
          <img src="img/<?= $row['gambar'] ?>" width="120" class="mt-2">
        </div>
        <div class="modal-footer">
          <input type="submit" name="update" value="Update" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal fade" id="hapus<?= $row['id'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5>Hapus Foto</h5>
        </div>
        <div class="modal-body">
          Yakin hapus foto ini?
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
        </div>
        <div class="modal-footer">
          <input type="submit" name="hapus" value="Hapus" class="btn btn-danger">
        </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>

</tbody>
</table>

<?php
$total = $conn->query("SELECT * FROM gallery")->num_rows;
$jumlah_page = ceil($total / $limit);
?>

<nav>
<ul class="pagination justify-content-end">
<?php for($i=1;$i<=$jumlah_page;$i++){ ?>
  <li class="page-item <?= ($hlm==$i)?'active':'' ?>">
    <a class="page-link halaman" id="<?= $i ?>" href="#"><?= $i ?></a>
  </li>
<?php } ?>
</ul>
</nav>
