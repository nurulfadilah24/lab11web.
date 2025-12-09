# Praktikum 11: PHP OOP Lanjutan - Modular Framework & Routing

## Tujuan Praktikum
- Memahami konsep dasar Framework Modular
- Memahami konsep dasar routing pada PHP
- Mampu membuat Framework sederhana menggunakan PHP OOP

## Struktur Project
```
lab11_php_oop/ 
├── .htaccess           (Konfigurasi URL Rewrite) 
├── config.php          (Konfigurasi Database) 
├── index.php           (Gerbang Utama / Routing) 
├── class/              (Tempat menyimpan Library) 
│   ├── Database.php 
│   └── Form.php 
├── module/             (Tempat modul-modul website) 
│   └── artikel/ 
│       ├── index.php   (Menampilkan data) 
│       ├── tambah.php  (Form tambah) 
│       └── ubah.php 
├── template/           (Bagian layout) 
├── header.php 
├── footer.php 
└── sidebar.php         
```

## Langkah Implementasi

### 1. Konfigurasi Database (`config.php`)
```
$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db_name' => 'lathian_oop'
];
```

### 2. Buat Router (`index.php`)
```
<?php
include "config.php";
include "class/Database.php";
include "class/Form.php";

session_start();

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/artikel/index';
$segments = explode('/', trim($path, '/'));

$mod = isset($segments[0]) ? $segments[0] : 'home';
$page = isset($segments[1]) ? $segments[1] : 'index';

$file = "module/{$mod}/{$page}.php";

include "template/header.php";

if (file_exists($file)) {
    include $file;
} else {
    echo '<div class="alert alert-danger">Modul tidak ditemukan: ' . $mod . '/' . $page . '</div>';
}

include "template/footer.php";
?>
```

### 3. URL Rewriting (`.htaccess`)
```
<IfModule mod_rewrite.c> 
    RewriteEngine On
    # Sesuaikan RewriteBase dengan nama folder project kamu di htdocs 
    RewriteBase /lab11_php_oop/ 

    # Jangan proses jika file/folder aslinya memang ada 
    RewriteCond %{REQUEST_FILENAME} !-d 
    RewriteCond %{REQUEST_FILENAME} !-f 
    
    # Arahkan semua request lain ke index.php 
    RewriteRule ^(.*)$ index.php/$1 [L] 
</IfModule> 
```

### 4. Buat Modul
#### A. Home Page (`module/artikel/index.php`)
```
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
```

#### B. Tambah Artikel (`module/artikel/tambah.php`)
```
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
```

### 5. Database Setup
```
CREATE DATABASE lathian_oop;
USE lathian_oop;
CREATE TABLE artikel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    isi TEXT
);
```
<img src="DATABASE SETUP.png" width="450">

### 6. Hasil
#### A. `index.php`
Before

<img src="HOME 1.png" width="450">

After

<img src="HOME 2.png" width="450">

#### B. Tambah Artikel (`tambah.php`)
1.
<img src="TAMBAH 1.png" width="450">

2.
<img src="TAMBAH 2.png" width="450">

3.
<img src="SUKSES.png" width="450">

## TESTING
http://localhost/lab11_php_oop/artikel/tambah

## Author
Nama: Nurul fadilah

NIM: 312410689

Kelas: TI.24.A.3