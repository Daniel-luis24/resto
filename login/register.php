<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script
    src="https://kit.fontawesome.com/64d58efce2.js"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="app.css" />
  <title> Sign up </title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- login -->
        <form action="login.php" method="POST" class="sign-in-form">
          <h2 class="title">Login Admin</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="hidden" name="action" value="login">
            <input type="text" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" value="Login" class="btn solid" />
        </form>
        <!-- Register -->
        <form action="./../backend/register.php" method="POST" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>

            <input type="hidden" name="action" value="register">
            <input type="text" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" class="btn" value="Sign up" />
          <p class="social-text">Sosial media kami</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </form>

      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">


        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>
</body>

</html>