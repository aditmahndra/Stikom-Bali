<?php
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $table = isset($_POST['table']) ? $_POST['table'] : null;
    $nama_lengkap = isset($_POST['nama_lengkap']) ? $_POST['nama_lengkap'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null;
    $jk = isset($_POST['jk']) ? $_POST['jk'] : null;
    $prodi = isset($_POST['prodi']) ? $_POST['prodi'] : null;
    $no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : null;
    
    // Validasi data
    if (!$id || !$table || !$nama_lengkap || !$email || !$tanggal_lahir || !$jk || !$prodi || !$no_hp) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: tabeladmin.php?table=$table");
        exit();
    }
    
    // Validasi nama tabel yang diizinkan (untuk keamanan)
    $allowed_tables = ['s2', 's1_d3', 'dual_degree'];
    if (!in_array($table, $allowed_tables)) {
        $_SESSION['error'] = "Tabel tidak valid!";
        header("Location: tabeladmin.php");
        exit();
    }
    
    // Validasi prodi sesuai dengan tabel
    $valid_prodi = false;
    switch($table) {
        case 's2':
            $valid_prodi = in_array($prodi, [
                "S2 - Sistem Informasi",
                "S2 - Teknik Informatika",
                "S2 - Bisnis Digital"
            ]);
            break;
        case 's1_d3':
            $valid_prodi = in_array($prodi, [
                "S1 - Sistem Informasi",
                "S1 - Sistem Komputer",
                "S1 - Teknologi Informasi",
                "D3 - Manajemen Informatika",
                "S1 - Bisnis Digital, S.Bis"
            ]);
            break;
        case 'dual_degree':
            $valid_prodi = in_array($prodi, [
                "Program Dual Degree Kelas International, B.IT., S.Kom",
                "DUAL DEGREE NASIONAL STT BANDUNG",
                "DUAL DEGREE INTERNASIONAL - DNUI"
            ]);
            break;
    }
    
    if (!$valid_prodi) {
        $_SESSION['error'] = "Program studi tidak valid untuk tabel ini!";
        header("Location: tabeladmin.php?table=$table");
        exit();
    }
    
    try {
        // Update data di tabel yang sesuai
        $stmt = $pdo->prepare("UPDATE pendaftaran_$table SET 
            nama_lengkap = ?, 
            email = ?, 
            tanggal_lahir = ?, 
            jk = ?, 
            prodi = ?, 
            no_hp = ? 
            WHERE id = ?");
        
        $result = $stmt->execute([$nama_lengkap, $email, $tanggal_lahir, $jk, $prodi, $no_hp, $id]);
        
        if ($result && $stmt->rowCount() > 0) {
            $_SESSION['success'] = "Data berhasil diupdate!";
        } else {
            $_SESSION['error'] = "Tidak ada perubahan data atau data tidak ditemukan!";
        }
        
        header("Location: tabeladmin.php?table=$table");
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['error'] = "Update data gagal: " . $e->getMessage();
        header("Location: tabeladmin.php?table=$table");
        exit();
    }
} else {
    // Jika bukan method POST
    header("Location: tabeladmin.php");
    exit();
}
?>