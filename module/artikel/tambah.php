<?php
$db = new Database();
$form = new Form("", "Simpan Artikel");

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi']
    ];
    $simpan = $db->insert('artikel', $data);
    if ($simpan) {
        echo "<div style='color:green'>Artikel berhasil disimpan!</div>";
    } else {
        echo "<div style='color:red'>Gagal menyimpan artikel.</div>";
    }
}
?>

<h2>Tambah Artikel</h2>
<?php
$form->addField("judul", "Judul Artikel");
$form->addField("isi", "Isi Artikel", "textarea");
$form->displayForm();
?>