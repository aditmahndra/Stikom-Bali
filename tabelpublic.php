<?php 
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotLoggedIn();

$table = isset($_GET['table']) ? $_GET['table'] : 's2';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mengambil SEMUA data, bukan hanya milik user yang login
$query = "";
switch($table) {
    case 's2':
        $query = "SELECT * FROM pendaftaran_s2";
        break;
    case 's1_d3':
        $query = "SELECT * FROM pendaftaran_s1_d3";
        break;
    case 'dual_degree':
        $query = "SELECT * FROM pendaftaran_dual_degree";
        break;
    default:
        $query = "SELECT * FROM pendaftaran_s2";
}

// Tambahkan pencarian jika ada
if (!empty($search)) {
    $query .= " WHERE nama_lengkap LIKE :search OR nim LIKE :search";
}

$stmt = $pdo->prepare($query);
if (!empty($search)) {
    $searchTerm = "%$search%";
    $stmt->bindParam(':search', $searchTerm);
}
$stmt->execute();
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - ITB STIKOM Bali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require_once 'header.php'; ?>

<section class="data-table">
    <div class="table-container">
        <div class="mac-header">
            <span class="dot red"></span>
            <span class="dot yellow"></span>
            <span class="dot green"></span>
        </div>
        
        <div class="table-controls" style="margin-bottom: 20px;">
            <div class="search-box">
                <form method="GET" style="display: flex; gap: 10px;">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">
                    <input type="text" name="search" placeholder="Cari Nama atau NIM" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn-search">
                        <img src="img/cari.png" alt="">
                    </button>
                </form>
            </div>
            
            <div class="table-selector" style="margin-top: 10px;">
                <label for="tableSelect">Pilih Program Studi: </label>
                <select id="tableSelect" onchange="window.location.href='?table='+this.value">
                    <option value="s2" <?php echo $table == 's2' ? 'selected' : ''; ?>>Mahasiswa S2</option>
                    <option value="s1_d3" <?php echo $table == 's1_d3' ? 'selected' : ''; ?>>Mahasiswa S1/D3</option>
                    <option value="dual_degree" <?php echo $table == 'dual_degree' ? 'selected' : ''; ?>>Mahasiswa Dual Degree</option>
                </select>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table class="table table-bordered">
                <thead>
                    <table>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($data as $row): 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                        <td><?php echo htmlspecialchars($row['nim']); ?></td>
                        <td><?php echo htmlspecialchars($row['prodi']); ?></td>
                        <td><?php echo htmlspecialchars($row['angkatan']); ?></td>
                        <td><?php echo htmlspecialchars($row['jk']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($data)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data mahasiswa</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Tambahkan informasi jumlah data -->
        <div style="margin-top: 20px; text-align: right; color: #666;">
            Total Mahasiswa: <?php echo count($data); ?> orang
        </div>
    </div>
</section>

<style>
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.table-selector select {
    padding: 8px 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f7c100;
    color: #000;
    font-weight: 600;
}

table tr:hover {
    background-color: #f5f5f5;
}

.text-center {
    text-align: center;
}
</style>

</body>
</html>