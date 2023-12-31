<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="login.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="loginData.php" method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
          <input type="submit" name="login" value="Login" class="btn solid" />
          <p class="social-text">- Or sign in with -</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </form>
        


        <form action="signUpdata.php" method="post" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" id="username" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-calendar"></i>
            <input type="date" id="dob" name="dob" required>
          </div>
          <div class="input-field">
            <i class="fas fa-phone-alt"></i>
            <input type="tel" id="phone" name="phone" placeholder="Phone" required />
          </div>
          <div class="input-field">
            <i class="fas fa-map-marker-alt"></i>
            <input type="text" id="address" name="address" placeholder="Address" required />
          </div>
          <input type="hidden" id="roleUser" name="roleUser" value="0">

          <input type="submit" class="btn" value="Sign up" />
          <p class="social-text">-Or Sign up with- </p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
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
          <h3>Don't have an account ?</h3>
          <p>
            Join us today! Create your account to unlock a world of possibilities
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/1.webp" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>All ready OceanGate user? Sign in</h3>
          <p>
            Already a member? Welcome back! Log in with your existing credentials and continue your journey.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/2.jpg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="app.js"></script>

</body>

</html>

