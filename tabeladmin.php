<?php 
require_once 'config/database.php';
require_once 'config/session_check.php';
redirectIfNotAdmin();

// Handle search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$table = isset($_GET['table']) ? $_GET['table'] : 's2';

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
    <title>Admin Panel - ITB STIKOM Bali</title>
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
                    <input type="text" name="search" placeholder="Cari Nama atau NIM" value="<?php echo htmlspecialchars($search); ?>">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">
                    <button type="submit" class="btn-search">
                        <img src="img/cari.png" alt="">
                    </button>
                </form>
            </div>
            
            <div class="table-selector" style="margin-top: 10px;">
                <label for="tableSelect">Pilih Tabel: </label>
                <select id="tableSelect" onchange="window.location.href='?table='+this.value">
                    <option value="s2" <?php echo $table == 's2' ? 'selected' : ''; ?>>Mahasiswa S2</option>
                    <option value="s1_d3" <?php echo $table == 's1_d3' ? 'selected' : ''; ?>>Mahasiswa S1/D3</option>
                    <option value="dual_degree" <?php echo $table == 'dual_degree' ? 'selected' : ''; ?>>Mahasiswa Dual Degree</option>
                </select>
                <img src="img/down.png" alt="">
            </div>
        </div>
        
        <div class="table-wrapper admin">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
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
                        <td><?php echo date('d/m/Y', strtotime($row['tanggal_lahir'])); ?></td>
                        <td><?php echo htmlspecialchars($row['jk']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                        <td class="aksi">
                            <button class="btn edit" onclick="editData(<?php echo $row['id']; ?>, '<?php echo $table; ?>')">
                                <img src="img/pencil.png" alt="">
                            </button>
                            <form action="hapus_data.php" method="POST" style="display:inline;"
                                onsubmit="return confirm('Apakah Anda Yakin Menghapus data ini?')">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="table" value="<?php echo $table; ?>">
                                <button type="submit" class="btn hapus">
                                    <img src="img/trash-bin.png" alt="">
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($data)): ?>
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Edit -->
<div id="modalEdit" class="modal-edit" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Data Mahasiswa</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form id="editForm" action="update_data.php" method="POST">
            <input type="hidden" name="id" id="edit_id">
            <input type="hidden" name="table" id="edit_table">
            
            <div class="field">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="edit_nama" required>
            </div>
            
            <div class="field">
                <label>Email</label>
                <input type="email" name="email" id="edit_email" required>
            </div>
            
            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="edit_tanggal" required>
            </div>
            
            <div class="field">
                <label>Jenis Kelamin</label>
                <select name="jk" id="edit_jk" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            
            <div class="field">
                <label>Program Studi</label>
                <select name="prodi" id="edit_prodi" required>
                    <!-- Options akan diisi oleh JavaScript berdasarkan tabel yang dipilih -->
                </select>
            </div>
            
            <div class="field">
                <label>No. HP</label>
                <input type="text" name="no_hp" id="edit_no_hp" required>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
// Data prodi untuk setiap tabel
const prodiOptions = {
    s2: [
        "S2 - Sistem Informasi",
        "S2 - Teknik Informatika",
        "S2 - Bisnis Digital"
    ],
    s1_d3: [
        "S1 - Sistem Informasi",
        "S1 - Sistem Komputer",
        "S1 - Teknologi Informasi",
        "D3 - Manajemen Informatika",
        "S1 - Bisnis Digital, S.Bis"
    ],
    dual_degree: [
        "Program Dual Degree Kelas International, B.IT., S.Kom",
        "DUAL DEGREE NASIONAL STT BANDUNG",
        "DUAL DEGREE INTERNASIONAL - DNUI"
    ]
};

function editData(id, table) {
    // Fetch data via AJAX
    fetch(`get_data.php?id=${id}&table=${table}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            
            // Set nilai input
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_table').value = table;
            document.getElementById('edit_nama').value = data.nama_lengkap;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_tanggal').value = data.tanggal_lahir;
            document.getElementById('edit_jk').value = data.jk;
            document.getElementById('edit_no_hp').value = data.no_hp;
            
            // Update dropdown prodi berdasarkan tabel
            updateProdiDropdown(table, data.prodi);
            
            document.getElementById('modalEdit').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data: ' + error.message);
        });
}

function updateProdiDropdown(table, selectedProdi) {
    const prodiSelect = document.getElementById('edit_prodi');
    
    // Kosongkan dropdown
    prodiSelect.innerHTML = '';
    
    // Ambil daftar prodi berdasarkan tabel
    const options = prodiOptions[table] || [];
    
    // Tambahkan option ke dropdown
    options.forEach(prodi => {
        const option = document.createElement('option');
        option.value = prodi;
        option.textContent = prodi;
        if (prodi === selectedProdi) {
            option.selected = true;
        }
        prodiSelect.appendChild(option);
    });
    
    // Jika tidak ada data prodi yang cocok, tampilkan pesan
    if (options.length === 0) {
        const option = document.createElement('option');
        option.value = "";
        option.textContent = "Tidak ada pilihan prodi";
        option.disabled = true;
        prodiSelect.appendChild(option);
    }
}

function closeModal() {
    document.getElementById('modalEdit').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('modalEdit');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<style>
.modal-edit {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ffc107;
}

.modal-header h2 {
    margin: 0;
    color: #022b4a;
}

.close {
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #666;
}

.close:hover {
    color: #ff0000;
}

.field {
    margin-bottom: 15px;
}

.field label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #333;
}

.field input, .field select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #eee;
}

.btn-cancel, .btn-simpan {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.btn-cancel {
    background-color: #ccc;
    color: #333;
}

.btn-simpan {
    background-color: #ffc107;
    color: #000;
}

.btn-cancel:hover {
    background-color: #bbb;
}

.btn-simpan:hover {
    background-color: #e0a800;
}

.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    position: relative;
}

.table-selector select {
    padding: 15px 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
    font-size: 15px;
    margin-left: 10px;
    appearance: none;
    padding-right: 40px;
}

.table-selector img {
    position: absolute;
    width: 12px;
    height: 12px;
    margin-left: 5px;
    margin-bottom: 4px;
    top: 31px;
    right: 18px;
}

.text-center {
    text-align: center;
}

.aksi {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.btn {
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn.edit {
    background-color: #00cbf8;
}

.btn.hapus {
    background-color: #ff6666;
}

.btn img {
    width: 20px;
    height: 20px;
}
</style>

</body>
</html>