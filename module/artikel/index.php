<?php
$db = new Database();
$data = $db->query("SELECT * FROM artikel");
?>

<h2>Daftar Artikel</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Isi</th>
    </tr>
    <?php while ($row = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['judul'] ?></td>
        <td><?= $row['isi'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>