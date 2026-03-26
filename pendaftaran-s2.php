<?php 
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pendaftaran Mahasiswa - ITB STIKOM Bali</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-register">

<?php include 'header.php'; ?>

<section class="login-section">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-12 form-container">

<div class="form-box">

<!-- JUDUL -->
<div class="form-title">

<h1>
Form Pendaftaran Online S2
</h1>

<h2>
Calon Mahasiswa Baru T.A 2026/2027
</h2>

<div class="form-line"></div>

</div>

<form action="proses_pendaftaran.php" method="POST">

<div class="row">

<!-- NAMA -->
<div class="col-md-6 mb-4">
<label class="form-label">Nama Lengkap</label>
<input type="text" name="nama" class="form-control form-input"
placeholder="Masukkan Nama Lengkap" required>
</div>

<!-- EMAIL -->
<div class="col-md-6 mb-4">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control form-input"
placeholder="Masukkan Email Anda" required>
</div>

<!-- TANGGAL LAHIR -->
<div class="col-md-6 mb-4">
<label class="form-label">Tanggal Lahir</label>
<input type="date" name="tanggal_lahir"
class="form-control form-input" required>
</div>

<!-- JENIS KELAMIN -->
<div class="col-md-6 mb-4">
<label class="form-label">Jenis Kelamin</label>
<select name="jk" class="form-control form-input" required>
<option value="" disabled selected>Pilih Jenis Kelamin</option>
<option value="Laki-laki">Laki-laki</option>
<option value="Perempuan">Perempuan</option>
</select>
</div>

<!-- PRODI -->
<div class="col-md-6 mb-4">
<label class="form-label">Prodi</label>
<select name="prodi" class="form-control form-input" required>
<option value="" disabled selected>Pilih Prodi</option>
<option value="S2 - Sistem Informasi">S2 - Sistem Informasi</option>
<option value="S2 - Teknik Informatika">S2 - Teknik Informatika</option>
<option value="S2 - Bisnis Digital">S2 - Bisnis Digital</option>
</select>
</div>

<!-- NO HP -->
<div class="col-md-6 mb-4">
<label class="form-label">No.Ponsel</label>
<input type="text" name="nohp" class="form-control form-input"
placeholder="Masukkan No.Ponsel" required>
</div>

</div>

<div class="text-center mt-4">

<button type="submit" class="btn-submit">
Daftar Sekarang
</button>

</div>

</form>

</div>

</div>

</div>

</div>

</section>

</body>
</html>