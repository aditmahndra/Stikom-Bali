// Dropdown menu untuk mahasiswa
const btn = document.querySelectorAll('.list a')[1];
const modal = document.getElementById('modalMahasiswa');

if (btn && modal) {
    btn.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();

        if (modal.style.display === "flex") {
            modal.style.display = "none";
        } else {
            modal.style.display = "flex";
        }
    });

    modal.addEventListener("click", function (e) {
        e.stopPropagation();
    });

    document.addEventListener("click", function () {
        modal.style.display = "none";
    });
}

// Show error/success messages
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    const error = urlParams.get('error');
    
    if (success) {
        alert(success);
    }
    if (error) {
        alert(error);
    }
});