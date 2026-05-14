const userVerification = document.getElementById("user-verification");
const emailVerification = document.getElementById("email-verification");
const passwordVerification = document.getElementById("password-verification");

const username = document.getElementById("username-input");
const email = document.getElementById("email-input");
const password = document.getElementById("password-input");

const pattern_username =
  /^(?=.{6,14}$)(?=[A-Z])(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).*$/;
const pattern_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const pattern_password =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,14}$/;


const dataArray = [];
function getData() {
    if (pattern_username.test(username.value) === true && pattern_email.test(email.value) === true && pattern_password.test(password.value) === true) {
        const dataObject = {
            username: username.value,
            email: email.value,
            password: password.value
        };
        dataArray.push(dataObject);
        localStorage.setItem("dataArray", JSON.stringify(dataArray));
        window.location.href = "../../html/index.html"
    }
 else{
    alert("Veuillez remplir tous les champs correctement");
 }
}


  function verifyUsername() {
  if (pattern_username.test(username.value) === true) {
    userVerification.style.display = "none";
    username.style.borderColor = "green";
  } else if (username.value === "") {
    userVerification.style.display = "none";
    username.style.borderColor = "var(--color-input-border)";
  } else {
    username.style.borderColor = "red";
  }
}
function verifyEmail() {
  if (pattern_email.test(email.value)=== true) {
    emailVerification.style.display = "none";
    email.style.borderColor = "green";
  } else if (email.value === "") {
    emailVerification.style.display = "none";
    email.style.borderColor = "var(--color-input-border)";
  } else {
    email.style.borderColor = "red";
  }
}
function verifyPassword() {
  if (pattern_password.test(password.value) === true) {
    passwordVerification.style.display = "none";
    password.style.borderColor = "green";
  } else if (password.value === "") {
    passwordVerification.style.display = "none";
    password.style.borderColor = "var(--color-input-border)";
  } else {
    password.style.borderColor = "red";
  }
  }

function focusUsername() {
  userVerification.style.display = "block";
}
function focusEmail() {
  emailVerification.style.display = "block";
}
function focusPassword() {
  passwordVerification.style.display = "block";
}

function blurUsername() {
  userVerification.style.display = "none";
  passwordVerification.style.borderColor = "#b8c0d8";
}
function blurEmail() {
  emailVerification.style.display = "none";
  passwordVerification.style.borderColor = "#b8c0d8";
}
function blurPassword() {
  passwordVerification.style.display = "none";
  passwordVerification.style.borderColor = "#b8c0d8";
}

username.addEventListener("input", verifyUsername);
email.addEventListener("input", verifyEmail);
password.addEventListener("input", verifyPassword);

username.addEventListener("focus", focusUsername);
email.addEventListener("focus", focusEmail);
password.addEventListener("focus", focusPassword);

username.addEventListener("blur", blurUsername);
email.addEventListener("blur", blurEmail);
password.addEventListener("blur", blurPassword);


