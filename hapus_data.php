<?php
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $table = $_POST['table'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM pendaftaran_$table WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['success'] = "Data berhasil dihapus!";
        header("Location: tabeladmin.php?table=$table");
        exit();
    } catch(PDOException $e) {
        $_SESSION['error'] = "Hapus data gagal: " . $e->getMessage();
        header("Location: tabeladmin.php?table=$table");
        exit();
    }
}
?>