const passwordInput = document.querySelector('#user-password');
const passwordIcon = document.querySelector('.toggle-show-password');

passwordIcon.addEventListener('click', function (e) {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});