<?php include 'header.php' ?>

<section class="data-table">

    <div class="table-container">
        <div class="mac-header">
            <span class="dot red"></span>
            <span class="dot yellow"></span>
            <span class="dot green"></span>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Cari Nama atau NIM">
            <button class="btn-search">
                <img src="img/cari.png" alt="">
            </button>
        </div>
        <div class="table-wrapper admin">
            <table>
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
                    <tr>
                        <td>1</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>Jayak</td>
                        <td>08123456789345678</td>


                        <td class="aksi">
                            <button class="btn edit">
                                <img src="img/pencil.png" alt="">
                            </button>

                            <form action="hapus.php" method="POST" style="display:inline;"
                                onsubmit="return confirm('Apakah Anda Yakin Menghapus data ini?')">

                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                <button type="submit" class="btn hapus">
                                    <img src="img/trash-bin.png" alt="">
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Edit Data -->
<!-- <div class="modal" id="modalEdit">
    <div class="modal-overlay"></div>

    <div class="modal-box">
        <div class="mac-header">
            <span class="dot red close">
                <span class="x">X</span>
            </span>
            <span class="dot yellow close"></span>
            <span class="dot green close"></span>
        </div>

        <h1>Edit Data</h1>
        <p class="desc">Perbarui data pendaftaran</p>

        <form id="formEdit" action="update.php" method="POST" class="form1">
            <input type="hidden" name="id" id="edit_id">

            <div class="field">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" id="edit_nama">
            </div>

            <div class="field">
                <label>Tempat Lahir</label>
                <input type="text" name="tempatLahir" id="edit_tempat">
            </div>

            <div class="field">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggalLahir" id="edit_tgl">
            </div>

            <div class="field">
                <label>Jenis Kelamin</label>
                <select name="jenisKelamin" id="edit_kelamin">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="field">
                <label>Alamat</label>
                <input type="text" name="alamat" id="edit_alamat">
            </div>

            <div class="field">
                <label>Asal</label>
                <input type="text" name="asal" id="edit_asal">
            </div>

            <div class="field">
                <label>Jurusan</label>
                <select name="jurusan" id="edit_jurusan">
                    <option value="RPL">RPL</option>
                    <option value="DKV">DKV</option>
                    <option value="TKJ">TKJ</option>
                    <option value="BD">BD</option>
                    <option value="ANI">ANI</option>
                </select>
            </div>

            <div class="field">
                <label>No HP</label>
                <input type="text" name="no_hp" id="edit_nohp">
            </div>

            <div class="footer">
                <button type="submit" class="btn simpan">Update</button>
            </div>
        </form>
    </div>
</div> -->