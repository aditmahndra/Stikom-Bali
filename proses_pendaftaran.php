<?php
// Hapus session_start() di sini karena sudah ada di database.php
require_once 'config/database.php';
require_once 'config/session_check.php';

// Cek apakah user sudah login
redirectIfNotLoggedIn();

// Cek apakah ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data dari form
    $user_id = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $prodi = $_POST['prodi'];
    $no_hp = $_POST['nohp'];
    
    // Validasi data tidak boleh kosong
    if (empty($nama) || empty($email) || empty($tanggal_lahir) || empty($jk) || empty($prodi) || empty($no_hp)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    // Determine which table to insert into based on the referring page
    $referer = $_SERVER['HTTP_REFERER'];
    
    try {
        // Cek apakah user sudah mendaftar sebelumnya
        $checkStmt = null;
        if (strpos($referer, 'pendaftaran-s2.php') !== false) {
            $checkStmt = $pdo->prepare("SELECT id FROM pendaftaran_s2 WHERE user_id = ?");
            $checkStmt->execute([$user_id]);
            $existing = $checkStmt->fetch();
            
            if ($existing) {
                $_SESSION['error'] = "Anda sudah mendaftar untuk program S2!";
                header("Location: " . $referer);
                exit();
            }
            
            $stmt = $pdo->prepare("INSERT INTO pendaftaran_s2 (user_id, nama_lengkap, email, tanggal_lahir, jk, prodi, no_hp) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$user_id, $nama, $email, $tanggal_lahir, $jk, $prodi, $no_hp]);
            
            if ($result) {
                $_SESSION['success'] = "Pendaftaran S2 berhasil! NIM akan diberikan otomatis.";
            } else {
                $_SESSION['error'] = "Pendaftaran gagal!";
            }
        } 
        elseif (strpos($referer, 'pendaftaran-s1-d3.php') !== false) {
            $checkStmt = $pdo->prepare("SELECT id FROM pendaftaran_s1_d3 WHERE user_id = ?");
            $checkStmt->execute([$user_id]);
            $existing = $checkStmt->fetch();
            
            if ($existing) {
                $_SESSION['error'] = "Anda sudah mendaftar untuk program S1/D3!";
                header("Location: " . $referer);
                exit();
            }
            
            $stmt = $pdo->prepare("INSERT INTO pendaftaran_s1_d3 (user_id, nama_lengkap, email, tanggal_lahir, jk, prodi, no_hp) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$user_id, $nama, $email, $tanggal_lahir, $jk, $prodi, $no_hp]);
            
            if ($result) {
                $_SESSION['success'] = "Pendaftaran S1/D3 berhasil! NIM akan diberikan otomatis.";
            } else {
                $_SESSION['error'] = "Pendaftaran gagal!";
            }
        }
        elseif (strpos($referer, 'pendaftaran-dual-degree.php') !== false) {
            $checkStmt = $pdo->prepare("SELECT id FROM pendaftaran_dual_degree WHERE user_id = ?");
            $checkStmt->execute([$user_id]);
            $existing = $checkStmt->fetch();
            
            if ($existing) {
                $_SESSION['error'] = "Anda sudah mendaftar untuk program Dual Degree!";
                header("Location: " . $referer);
                exit();
            }
            
            $stmt = $pdo->prepare("INSERT INTO pendaftaran_dual_degree (user_id, nama_lengkap, email, tanggal_lahir, jk, prodi, no_hp) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$user_id, $nama, $email, $tanggal_lahir, $jk, $prodi, $no_hp]);
            
            if ($result) {
                $_SESSION['success'] = "Pendaftaran Dual Degree berhasil! NIM akan diberikan otomatis.";
            } else {
                $_SESSION['error'] = "Pendaftaran gagal!";
            }
        } else {
            $_SESSION['error'] = "Sumber pendaftaran tidak valid!";
        }
        
        // Redirect kembali ke halaman pendaftaran
        header("Location: " . $referer);
        exit();
        
    } catch(PDOException $e) {
        // Tangani error database
        $_SESSION['error'] = "Pendaftaran gagal: " . $e->getMessage();
        header("Location: " . $referer);
        exit();
    }
} else {
    // Jika bukan method POST
    header("Location: index.php");
    exit();
}
?>