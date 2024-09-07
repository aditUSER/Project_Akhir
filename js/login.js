function validateForm() {
    var isValid = true;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");

    usernameError.textContent = "";
    passwordError.textContent = "";

    if (username === "") {
        usernameError.textContent = "Username tidak boleh kosong";
        isValid = false;
    }

    if (password === "") {
        passwordError.textContent = "Password tidak boleh kosong";
        isValid = false;
    }

    if (isValid) {
        var loginButton = document.getElementById("loginButton");
        loginButton.classList.add("loading");
        loginButton.textContent = "Logging in...";
    }

    return isValid;
}

function showNotification() {
    var notification = document.getElementById('notification');
    notification.classList.add('show');
    setTimeout(function() {
        notification.classList.remove('show');
    }, 3000);
}
