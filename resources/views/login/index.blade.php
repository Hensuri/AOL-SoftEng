<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/logreg.css">
    <script src="script.js"></script> 
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    
</head>
<body>
    <div class="wrapper">
        <form action="/login" method="POST">
            @csrf
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" placeholder="Email" name="email" autofocus, value="{{ old ('email') }}">
                <ion-icon name="person-outline"></ion-icon>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password">
                <ion-icon name="lock-closed-outline"></ion-icon>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="/forgot-password">Forgot Password?</a>
            </div>
            <button type="submit" class="btnlogin">Login</button>
            <div class="register-link">
                <p>
                    Don't have an account? <a href="/register">Register now</a>
                </p>
            </div>
            <div>
                <a href="/" class="home">Home</a>
            </div>
        </form>
    </div>

</body>
</html>