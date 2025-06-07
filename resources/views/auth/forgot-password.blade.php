<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="css/home.css"/>
  <link rel="stylesheet" href="css/logreg.css"/>
  <script src="script.js"></script> 
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  
 
</head>
<body>
  <div class="wrapper">
    <form id="forgotForm" method="POST" action="/forgot-password">
      @csrf
      <h1>Forgot Password</h1>
      <p style="text-align:center; margin-bottom: 20px;">Enter your email to reset your password</p>

      <div class="input-box">
        <input type="email" id="email" placeholder="Enter your email" name="email">
        <ion-icon name="mail-outline"></ion-icon>
      </div>

      <button type="submit" class="btnreset">Send Reset Link</button>

      <div class="register-link">
        <p>Remembered your password? <a href="/login">Login now</a></p>
      </div>
    </form>
  </div>

  </body>
</html>