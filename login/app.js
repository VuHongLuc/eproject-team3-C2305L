const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});


function togglePasswordField() {
  const passwordField = document.getElementById('password');
  const togglePassword = document.getElementById('togglePassword');

  const fieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
  passwordField.setAttribute('type', fieldType);

 
  if (fieldType === 'password') {
    togglePassword.classList.remove('fa-eye-slash');
  } else {
    togglePassword.classList.add('fa-eye-slash');
  }
}





