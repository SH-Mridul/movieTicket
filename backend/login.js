document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const adminPanel = document.getElementById('adminPanel');
    const showRegister = document.getElementById('showRegister');
    const showLogin = document.getElementById('showLogin');
    const logoutButton = document.getElementById('logoutButton');

    // Check if user is logged in
    if (localStorage.getItem('loggedIn')) {
        showAdminPanel();
    }

    // Show registration form
    showRegister.addEventListener('click', function() {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
    });

    // Show login form
    showLogin.addEventListener('click', function() {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    });

    // Handle registration
    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('registerUsername').value;
        const password = document.getElementById('registerPassword').value;

        // Store user credentials
        localStorage.setItem('username', username);
        localStorage.setItem('password', password);
        alert('Registration successful! You can now login.');
        showLogin.click(); // Switch to login form
    });

    // Handle login
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('loginUsername').value;
        const password = document.getElementById('loginPassword').value;

        // Validate credentials
        if (username === localStorage.getItem('username') && password === localStorage.getItem('password')) {
            localStorage.setItem('loggedIn', true);
            window.location.href = 'index.html'; // Redirect to admin panel
        } else {
            alert('Invalid username or password!');
        }
    });

    // Handle logout
    logoutButton.addEventListener('click', function() {
        localStorage.removeItem('loggedIn');
        window.location.href = 'login.html'; // Redirect to login
    });

    // Show admin panel
    function showAdminPanel() {
        loginForm.classList.add('hidden');
        registerForm.classList.add('hidden');
        adminPanel.classList.remove('hidden');
    }
});
