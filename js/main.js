let btn = document.getElementById("bouton-theme");
let lightIcon = document.querySelector(".light-icon");
let darkIcon = document.querySelector(".dark-icon");

btn.onclick = function () {
  if (lightIcon.style.display !== "none") {
    lightIcon.style.display = "none";
    darkIcon.style.display = "block";
    document.documentElement.setAttribute('data-theme', 'dark');
  } else {
    lightIcon.style.display = "block";
    darkIcon.style.display = "none";
    document.documentElement.removeAttribute('data-theme'); 
  }
};



