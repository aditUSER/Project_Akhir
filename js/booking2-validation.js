function validatePhoneNumber(input) {
    // Menghapus karakter non-numerik
    input.value = input.value.replace(/[^0-9]/g, '');
}

function validatePhoneNumber(input) {
    // Menghapus karakter non-numerik
    input.value = input.value.replace(/[^0-9]/g, '');
    // Periksa apakah input valid
    validateForm();
}

// Event listener untuk tombol Cancel
document.querySelector('.btn-cancel').addEventListener('click', function() {
    if (confirm('Are you sure you want to cancel?')) {
        window.location.href = 'index.html#section-1';
    }
});

function validatePostalCode(input) {
    // Menghapus karakter non-numerik
    input.value = input.value.replace(/[^0-9]/g, '');
    // Periksa apakah input valid
    validateForm();
}

// Fungsi tambahan untuk validasi email (opsional)
function validateEmail(email) {
    // Gunakan ekspresi reguler untuk validasi email yang lebih ketat jika diperlukan
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

document.getElementById('submit-btn').addEventListener('click', function(event) {
    var form = document.getElementById('booking2-form');
    
    // Cek validasi form
    if (form.checkValidity()) {
        form.submit();  // Jika form valid, kirim form
    } else {
        alert('Pastikan semua input telah diisi dengan benar.');
        event.preventDefault();  // Cegah pengiriman form jika ada yang tidak valid
    }
});

document.getElementById('btn-cancel').addEventListener('click', function() {
    window.location.href = 'cancel_page.php';  // Redirect ke halaman cancel jika tombol cancel ditekan
});
