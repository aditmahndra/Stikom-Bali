<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (nama_lengkap, email, password, role) VALUES (?, ?, ?, 'mahasiswa')");
        $stmt->execute([$nama, $email, $hashed_password]);
        
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $_SESSION['error'] = "Email sudah terdaftar!";
        } else {
            $_SESSION['error'] = "Registrasi gagal: " . $e->getMessage();
        }
        header("Location: registrasi.php");
        exit();
    }
}
?>