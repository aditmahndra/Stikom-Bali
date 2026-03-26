<?php
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotAdmin();

if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    
    // Validasi nama tabel yang diizinkan (untuk keamanan)
    $allowed_tables = ['s2', 's1_d3', 'dual_degree'];
    if (!in_array($table, $allowed_tables)) {
        http_response_code(400);
        echo json_encode(['error' => 'Tabel tidak valid']);
        exit();
    }
    
    try {
        // Ambil data dari tabel yang sesuai
        $stmt = $pdo->prepare("SELECT * FROM pendaftaran_$table WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            // Pastikan data prodi tidak kosong
            if (empty($data['prodi'])) {
                $data['prodi'] = '';
            }
            
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }
        
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter tidak lengkap']);
}
?>