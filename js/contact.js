let form = document.getElementById("contactForm");
      let successMsg = document.getElementById("successMsg");

      let data = JSON.parse(localStorage.getItem("users")) || [];

      form.addEventListener("submit", function (event) {
        event.preventDefault();

        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let message = document.getElementById("message").value;

        let rating = document.querySelector('input[name="rate"]:checked');

        if (rating == null) {
          alert("Veuillez sélectionner une note");
          return;
        }

        let user = {
          username: username,
          email: email,
          rating: rating.value,
          message: message,
        };

        data.push(user);

        localStorage.setItem("users", JSON.stringify(data));

        console.log(data);

        successMsg.innerHTML = "Message envoyé avec succès";

        form.reset();
      });