(function() {

  function addEventListener() {
    document.getElementById("registerBtn").addEventListener("click", register);
  }

  function register() {
    // call php
    const username = document.getElementById("username").value;
    const name = document.getElementById("name").value;
    const firstname = document.getElementById("firstname").value;

    const parola = document.getElementById("password");
    const passhash = CryptoJS.MD5(parola.value).toString();

    $.ajax({
      type: "POST",
      url: 'http://localhost/register.php',
      dataType: 'json',
      data: {username, password: passhash, name, firstname},
      complete: function() {
        location.href = "http://localhost/login.html"
      }
    });
  }
  addEventListener();
})()
