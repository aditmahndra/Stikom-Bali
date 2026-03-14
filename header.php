<section class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <img class="logo" src="img/logo.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="menu">
                        <div class="list">
                            <a href="#">Home</a>
                            <a href="#">Data Mahasiswa
                                <img src="img/down.png" class="drop" alt="">
                            </a>
                        </div>
                        <div class="btn">
                            <button class="btn-login-nav">Login</button>
                            <button class="btn-register-nav">Register</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-mahasiswa" id="modalMahasiswa">
    <a href="#">Tabel Data Mahasiswa S2</a>
    <a href="#">Tabel Data Mahasiswa Dual Degree</a>
    <a href="#">Tabel Data Mahasiswa D3, S1</a>
</div>

<script>

    const btn = document.querySelectorAll('.list a')[1];
    const modal = document.getElementById('modalMahasiswa');

    btn.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation(); // supaya klik tombol tidak dianggap klik luar

        if (modal.style.display === "flex") {
            modal.style.display = "none";
        } else {
            modal.style.display = "flex";
        }
    });

    // supaya klik di dalam modal tidak menutupnya
    modal.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    // klik di luar modal
    document.addEventListener("click", function () {
        modal.style.display = "none";
    });

</script>