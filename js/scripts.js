// Fungsi untuk validasi form
function validateForm() {
    var isValid = true;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");

    // Reset pesan error
    usernameError.textContent = "";
    passwordError.textContent = "";

    // Validasi username
    if (username === "") {
        usernameError.textContent = "Username tidak boleh kosong";
        isValid = false;
    }

    // Validasi password
    if (password === "") {
        passwordError.textContent = "Password tidak boleh kosong";
        isValid = false;
    }

    if (isValid) {
        // Menampilkan efek loading pada tombol login
        var loginButton = document.getElementById("loginButton");
        loginButton.classList.add("loading");
        loginButton.textContent = "Logging in...";
    }

    return isValid;
}

// Fungsi untuk menampilkan notifikasi
function showNotification() {
    var notification = document.getElementById('notification');
    notification.classList.add('show');
    setTimeout(function() {
        notification.classList.remove('show');
    }, 3000); // Animasi muncul selama 3 detik
}
