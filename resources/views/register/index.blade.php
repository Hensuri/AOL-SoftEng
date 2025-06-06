<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet" href="css/Main.css">
  <link rel="stylesheet" href="css/logreg.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  

</head>
<body>
  <div class="wrapper">
    <form id="registerForm" action="/register" method="POST">
      @csrf
      <h1>Register</h1>
      <div class="input-box">
        <input type="text" id="username" placeholder="Username" name="username" value="{{ old('username') }}">
        <ion-icon name="person-outline"></ion-icon>
      </div>
      <div class="input-box">
        <input type="email" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
        <ion-icon name="mail-outline"></ion-icon>
      </div>
      <div class="input-box">
        <input type="password" id="password" placeholder="Password" name="password">
        <ion-icon name="lock-closed-outline"></ion-icon>
      </div>
      <div class="input-box">
        <input type="password" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
        <ion-icon name="lock-closed-outline"></ion-icon>
      </div>
      <button type="submit" class="btnregister">Register</button>
      <div class="register-link">
        <p>Already have an account? <a href="/login">Login now</a></p>
      </div>
       <div>
                <a href="/" class="home">Home</a>
        </div>
    </form>
  </div>
  </body>
</html>