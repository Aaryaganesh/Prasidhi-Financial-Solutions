<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTP-08">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>login page</title>
    

</head>
<style>
    *{
    margin:0;
    padding:0;
    box-sizing: border-box;
}

*:focus{
    outline:none;
}



body{
    position: relative;
    width: 100%;
    min-height: 100vh;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    background-position: center;
    background-size: cover;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    background-image: url("http://localhost:8080/image1.jpeg");
    background-size: 1530px;
    background-repeat: no-repeat;

}
.heading{
    font-size: 20px;
    font-weight: 200;
    text-align: center;
    margin-bottom: 50px;
    color: black;
    padding: 10px 10px 5px 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.752);

}
.forms{
    width:300px;
    height: auto;
    color:blueviolet;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    background:white;
    border-radius: 10px;
    opacity: 0.7;
    transition: 0.5s;
    position:absolute;
    left:120px;
}
input
,.submit-btn{
    width:80%;
    height:35px;
    display: block;
    margin: 20px;
    border-radius: 5px;
    background:black;
    border:2px solid rgba(0, 0, 0, 0.752);
    color:rgb(255, 255, 255);
    padding: 15px;
    transition: 0.7s;
    

}
input::placeholder{
    color:solid black;
    font-family: serif;
}

.submit-btn{
    width:100px;
    height: 40px;
    cursor:pointer;
    padding: 0 5px;
    margin:30px auto;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.link{
    text-align: center;
    text-decoration: none;
    text-transform: capitalize;
    color:black;
    display:block;
    margin: 30px 0;
}
.link:hover{
    text-decoration: underline;
}
.forms:hover{
    opacity: 0.8;
    box-shadow: 7px 7px 5px rgba(0, 0, 0, 0.448);
}

.message{
    position: absolute;
    width: 400px;
    height: auto;
    color: black;
    bottom: 85%;
    left: 5%;
    font-size: 20px;
    text-decoration: solid;
    text-transform: capitalize;
    background-color: white;
    text-align: center;
    opacity: 0.7;
    border-radius: 5px;
}
form input[type="text"]{
 text-transform: lowercase;
}
</style>
<body>
    <div class="message">
        <?php
        if(isset($_SESSION['status']))
        {
            
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
        ?>
    </div>
  
    <div class="forms">
        <form action="login.php" method="post">
        <h1 class="heading">LOGIN</h1>
        <input type="email"  placeholder="email" autocomplete="off" class="email" name="email"required >
        <input type="password"  placeholder="password" autocomplete="off" class="password" name="password" required pattern="(?=.*\d)(?=.*[a-z).{8,}">
        <button class="submit-btn" type="submit">LOGIN</button>
        </form>
        <a class="link" href="register.html">don't have an account?.create one</a>
    </div>
    <script>
  const form = document.querySelector('form');
  const emailInput = document.querySelector('.email');
  const passwordInput = document.querySelector('.password');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const emailValue = emailInput.value;
    const passwordValue = passwordInput.value;

    // Email validation
    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(emailValue)) {
      alert('Please enter a valid email address');
      return false;
    }

    // Password validation
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[#@!$%*])[A-Za-z\d#@!$%*]{8,}$/;
    if (!passwordRegex.test(passwordValue)) {
      alert('Password should contain minimum 8 characters, at least one letter and one number');
      return false;
    }

    form.submit();
  });
</script>
<div id="message"></div>
	<!-- <script type="text/javascript">
		var urlParams = new URLSearchParams(window.location.search);
		 var status = urlParams.get('status');
		if (status == 'success') {
			document.getElementById('message').innerHTML = "";
		}
    </script> -->
</body>

</html>

