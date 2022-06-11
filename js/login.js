$(document).ready(function(){
    (function() {

    function addEventListener() {
      document.getElementById("loginBtn").addEventListener("click", login);
    }

    function login() {
      // call php
      const nume = document.getElementById("username").value;
      const parola = document.getElementById("password");
      const passhash = CryptoJS.MD5(parola.value).toString();

      $.ajax({
        type: "POST",
        url: 'http://localhost/login.php',
        dataType: 'json',
        data: {username: nume, password: passhash},
        complete: function (response) {
          const responseArr = response.responseText.split("_")
          const userRole = responseArr[0];
          const nume = responseArr[1];
          const prenume = responseArr[2];

          localStorage.setItem("loggedInUser", JSON.stringify({
            nume,
            prenume
          }))
          if(userRole == 'client') {
            location.href = "butoane.html";
        	} else if(userRole == 'antrenor') {
            location.href = "admin.html";
        	}
        },
      });
    }
    addEventListener();
  })()
});
