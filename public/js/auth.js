// UI Elements
const signInBtn = document.getElementById('btn-signin'),
      registerBtn = document.getElementById('btn-register'),
      loginForm = document.getElementById('login-form'),
      registerForm = document.getElementById('register-form'),
      emailLogin = document.querySelector('#emailLogin'),
      passLogin = document.querySelector('#passwordLogin'),
      nameRegis = document.querySelector('#nameRegis');
      emailRegis = document.querySelector('#emailRegis'),
      passRegis = document.querySelector('#passwordRegis'),
      passRegisCf = document.querySelector('#passRegis2');

toastr.options = {
  'progressBar': true,
  'positionClass': 'toast-bottom-left',
  'timeOut': 3000
};

// Event Listeners
signInBtn.onclick = logIn;

// Functions
function logIn() {
  if (emailLogin.value === '' || passLogin.value === '') {
    // check if there are missing inputs
    toastr.error('Please fill in all fields');
  } else {
    // submit the form
    loginForm.submit();
  }
}