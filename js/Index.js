// Function to handle sidebar opening
function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.querySelector('.overlay').style.display = 'block'; // Show overlay when sidebar is open
    document.querySelector('.frost-overlay').style.display = "block"; // Tampilkan lapisan embun
}

// Function to handle sidebar closing
function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.querySelector('.overlay').style.display = 'none'; // Hide overlay when sidebar is closed
    document.querySelector('.frost-overlay').style.display = "none"; // Sembunyikan lapisan embun
}

// Close sidebar when the user clicks outside it
document.getElementById('overlay').addEventListener('click', function() {
    closeNav(); // Close sidebar if overlay is clicked
});

// Image slider functions
const images = document.querySelectorAll('.image-slider img');
const dots = document.querySelectorAll('.slider-dot');
let currentImageIndex = 0;

function showImage(index) {
    images.forEach((img, i) => {
        img.style.display = i === index ? 'block' : 'none';
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    showImage(currentImageIndex);
}

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentImageIndex = index;
        showImage(currentImageIndex);
    });
});

setInterval(nextImage, 3000); // Change image every 3 seconds

// Display the first image on page load
showImage(currentImageIndex);

// Intersection Observer for animations
function handleIntersection(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('float-in');
            entry.target.classList.remove('float-out');
        } else {
            entry.target.classList.remove('float-in');
            entry.target.classList.add('float-out');
        }
    });
}

// Set up the Intersection Observer
const observer = new IntersectionObserver(handleIntersection, {
    threshold: 0.1 // Trigger when 10% of the section is visible
});

// Observe each h1 and p element
document.querySelectorAll('h1, p').forEach(element => {
    observer.observe(element);
});

    // Event listener untuk tombol Next
    document.querySelector('.btn').addEventListener('click', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Mencegah pengiriman form jika tidak valid
        } else {
            // Jika form valid, lanjut ke halaman berikutnya
            window.location.href = 'Order Page 2.html';
        }
    });

    // Event listener untuk tombol Cancel
    document.querySelector('.btn-cancel').addEventListener('click', function() {
        if (confirm('Are you sure you want to cancel?')) {
            window.location.href = 'index.html#section1';
        }
    });

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

function validatePostalCode(input) {
    // Menghapus karakter non-numerik
    input.value = input.value.replace(/[^0-9]/g, '');
    // Periksa apakah input valid
    validateForm();
}

function validateForm() {
    const form = document.getElementById('booking-form'); // Dapatkan formulir
    const nextBtn = document.getElementById('next-btn');

    // Loop melalui semua elemen input dalam formulir
    let isFormValid = true;
    for (let element of form.elements) {
        // Abaikan elemen yang tidak perlu divalidasi (misalnya tombol)
        if (element.tagName === 'BUTTON' || element.tagName === 'SELECT') continue;

        // Periksa apakah elemen kosong atau tidak valid berdasarkan tipe input
        if (element.value.trim() === '' || 
            (element.type === 'email' && !validateEmail(element.value))) {
            isFormValid = false;
            break; // Hentikan loop jika ada satu elemen yang tidak valid
        }
    }

    // Aktifkan/nonaktifkan tombol Next berdasarkan hasil validasi
    if (isFormValid) {
        nextBtn.disabled = false;
        nextBtn.classList.remove('disabled');
        nextBtn.classList.add('enabled');
    } else {
        nextBtn.disabled = true;
        nextBtn.classList.remove('enabled');
        nextBtn.classList.add('disabled');
    }
}

// Fungsi tambahan untuk validasi email (opsional)
function validateEmail(email) {
    // Gunakan ekspresi reguler untuk validasi email yang lebih ketat jika diperlukan
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
        e.preventDefault();
    }
});