const btn1 = document.getElementById("envoi");

function formulairevalidation() {
  const data = JSON.parse(localStorage.getItem("dataArray"));
  const usernameOrEmail = document.getElementById("email-input").value;
  const passwordInput = document.getElementById("password-input").value;
  const userinfo = document.getElementById("userinfo");
  const userpassword = document.getElementById("userpassword");
  const user = data.find(
    (u) => u.username === usernameOrEmail || u.email === usernameOrEmail,
  );
  if (!user) {
    userinfo.style.display = "block";
    document.getElementById("email-input").style.borderColor = "red";
  } else if (user.password !== passwordInput) {
    userpassword.style.display = "block";
    document.getElementById("password-input").style.borderColor = "red";
  }else{
    window.location.href = "../../html/index.html";
    console.log("hello")
  }
}
btn1.addEventListener("click", formulairevalidation);
