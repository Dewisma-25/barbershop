<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
@vite(['resources/css/app.css','resources/js/app.js'])

<style>

body{
    background:#e5e5e5;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:sans-serif;
}

.login-box{
    background:#2b2b2b;
    width:420px;
    padding:40px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.login-title{
    color:white;
    font-size:28px;
    font-weight:bold;
    margin-bottom:30px;
}

.input-box{
    width:100%;
    padding:14px;
    border-radius:20px;
    border:none;
    margin-bottom:18px;
    background:#e5e5e5;
}

.register-text{
    color:#d1d1d1;
    font-size:14px;
}

.register-text a{
    color:white;
    text-decoration:underline;
}

.login-btn{
    margin-top:20px;
    background:white;
    padding:10px 35px;
    border-radius:20px;
    border:none;
    font-weight:bold;
    cursor:pointer;
}

</style>

</head>
<body>

<div class="login-box">

    <div class="login-title">
        Login Account
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input 
        type="text"
        name="email"
        placeholder="username / @gmail.com"
        class="input-box"
        required
        >

        <input 
        type="password"
        name="password"
        placeholder="password"
        class="input-box"
        required
        >

        <div class="register-text">
            Don't have an account yet?
            <a href="{{ route('register') }}">Register</a>
        </div>

        <button class="login-btn">
            Login
        </button>

    </form>

</div>

</body>
</html>