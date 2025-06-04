<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="css/Main.css"/>
  <link rel="stylesheet" href="css/logreg.css"/>
  <script src="script.js"></script> 
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  
 
</head>
<body>
  <div class="wrapper">
    <form id="forgotForm" method="POST" action="/reset-password">
      @csrf
      <h1>Reset Password</h1>
      {{-- <p style="text-align:center; margin-bottom: 20px;">Enter your new password</p> --}}

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

      <div class="input-box">
        <input type="password" id="password" placeholder="Enter your new password" name="password">
        <ion-icon name="mail-outline"></ion-icon>
      </div>

      <div class="input-box">
        <input type="password" id="password" placeholder="Renter your new password" name="password_confirmation">
        <ion-icon name="mail-outline"></ion-icon>
      </div>

      <button type="submit" class="btnreset">Reset Password</button>

      <div class="register-link">
        <p>Remembered your password? <a href="/login">Login now</a></p>
      </div>
    </form>
  </div>

  </body>
</html>