<?php
/**
 * Created by PhpStorm.
 * User: Ana-Maria
 * Date: 04.06.2018
 * Time: 1:00
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Login </title>
    <link rel="stylesheet" href="../../public/css/stylesheet.css" type="text/css">
</head>
<body style="background-image:url('../../public/Images/background.jpg')">
<div  id = "menu-button">
    <input type="button" class = "menu-btn" id = "login-button" value="Login" onClick="HideRegister()">
    <input type="button" class = "menu-btn" id = "SignUp-button" value="Sign Up" onClick = "HideLogin()">
</div>
<div class = "welcome"> Welcome to Agricultural Land Manager! </div>
<div class = "login" id = "loginID" method = "post" action="index/home.php">
    <input class ="login-data" type="text" id ="user" placeholder="email" >
    <input  class ="login-data" type="password" id ="password" placeholder="password" >
    <input  class="submit-btn" type="submit" id = "submit-login" value="Submit" onClick="Login()">
</div>
<div class ="register" id = "register-form" method = "post" action = "index/home.php">
    <form><input  class ="user-data" type="text" id="firstname" placeholder="FirstName" autofocus required />
        <input  class ="user-data" type="text" id="lastname" placeholder="LastName" required />
        <input  class ="user-data" type="email"  id="register-email" placeholder="E-mail" required />
        <input  class ="user-data" type="password" id="register-password" placeholder="Password" required />
        <input  class ="user-data" type="password" id="password2" placeholder="Retype password" onfocusout="RetypePasswd()" required />

        <input class="submit-btn" type="button" id="register-btn" value="Sign me up" onClick="SignUp()" />
        <p>
            Already a member? <a href="login.php">SignIn</a>
        </p>
    </form></div>
<script>

    function test()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AdwiserBST/public/home/PostTest", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            debugger;
            console.log(xmlhttp.response);
        }
        var tst = {nume:"normale"};

        xmlhttp.send("x=" + JSON.stringify(tst));
    }

    function SignUp(){
        var user= {
            FirstName : document.getElementById('firstname').value,
            LastName : document.getElementById('lastname').value,
            Email : document.getElementById('register-email').value,
            Password : document.getElementById('register-password').value,
            RetypedPassword : document.getElementById('password2').value
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AdwiserBST/public/account/RegisterUser", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            alert(xmlhttp.response);
        }
        xmlhttp.send("user=" + JSON.stringify(user));
    }

    function HideLogin(){
        document.getElementById("loginID").style.display = "none";
        document.getElementById("register-form").style.display="block";
    }
    function HideRegister(){
        document.getElementById("register-form").style.display = "none";
        document.getElementById("loginID").style.display="block";

    }
    function Login(){
        var user= {
            Email : document.getElementById('user').value,
            Password : document.getElementById('password').value,
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "http://localhost:82/AdwiserBST/public/account/Login", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.onload = function(){
            alert(xmlhttp.response);
        }
        xmlhttp.send("user=" + JSON.stringify(user));

    }
    function RetypePasswd(){
        var password = document.getElementById("register-password").value;
        if(password != '') {
            var password2 = document.getElementById("password2").value;
            if (password == password2) {
                alert("Parolele coincid! ^.^");
            } else {
                alert("Parolele nu coincid! :(");
            }
        }
    }
</script>
</body>
</html>

