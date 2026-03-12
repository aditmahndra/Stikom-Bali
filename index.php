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

    <?php include 'header.php'; ?>


    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-box">
                        <img src="img/banner.jpg">
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            <h1>
                                Pelajari <span>Skill & Pengetahuan</span><br>
                                Tentang <span>IT & Entrepreneur</span> Sekarang
                            </h1>
                            <p>
                                Belajar dari Para Akademisi & Praktisi yang berpengalaman di bidangnya dan dapatkan
                                skill keterampilan yang dibutuhkan di Dunia Industri untuk membangun karir masa depan.
                            </p>
                            <button class="btn-daftar">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
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

</html>