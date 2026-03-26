<?php 
// Hanya include sekali
require_once 'config/database.php';
require_once 'config/session_check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ITB STIKOM Bali</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<?php 
// Tampilkan pesan error atau success jika ada
if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
<?php endif; ?>

<section class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <img class="logo" src="img/logo.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="menu">
                        <div class="list">
                            <a href="index.php">Home</a>
                            <?php if(isLoggedIn()): ?>
                                <?php if(isAdmin()): ?>
                                    <a href="tabeladmin.php">Data Mahasiswa</a>
                                <?php else: ?>
                                    <a href="#" class="data-mahasiswa-link">Data Mahasiswa
                                        <img src="img/down.png" class="drop" alt="">
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="btn-header">
                            <?php if(isLoggedIn()): ?>
                                <div class="user-welcome">
                                    <span class="welcome-text">
                                        Hallo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>
                                    </span>
                                    <a href="logout.php">
                                        <button class="btn-logout-nav">Logout</button>
                                    </a>
                                </div>
                            <?php else: ?>
                                <a href="login.php">
                                    <button class="btn-login-nav">Login</button>
                                </a>
                                <a href="registrasi.php">
                                    <button class="btn-register-nav">Register</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(isLoggedIn() && isMahasiswa()): ?>
    <div class="modal-mahasiswa" id="modalMahasiswa">
        <a href="tabelpublic.php?table=s2">Tabel Data Mahasiswa S2</a>
        <a href="tabelpublic.php?table=dual_degree">Tabel Data Mahasiswa Dual Degree</a>
        <a href="tabelpublic.php?table=s1_d3">Tabel Data Mahasiswa D3, S1</a>
    </div>
    <?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>