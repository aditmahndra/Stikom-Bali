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