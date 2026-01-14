<?php
include("koneksi.php");

$hlm = isset($_POST['hlm']) ? (int) $_POST['hlm'] : 1;
$limit = 5;
$limit_start = ($hlm - 1) * $limit;
$no = $limit_start + 1;

$sql = "SELECT * FROM jurnal ORDER BY tanggal DESC LIMIT $limit_start, $limit";
$hasil = $conn->query($sql);
?>

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Isi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hasil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= nl2br(htmlspecialchars($row['isi'])) ?></td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<?php
$sql_jml = $conn->query("SELECT COUNT(*) AS total FROM jurnal");
$total = $sql_jml->fetch_assoc()['total'];
$jml_hlm = ceil($total / $limit);
?>

<nav>
    <ul class="pagination justify-content-end">
        <?php for ($i = 1; $i <= $jml_hlm; $i++): ?>
            <li class="page-item <?= ($i == $hlm ? 'active' : '') ?>">
                <a class="page-link halaman" id="<?= $i ?>" href="#"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>