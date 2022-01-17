<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="log_style.css">
</head>

<body>
    <div class="Main">
        <h1>Enter Credentials</h1>
        <form method="post" action="login.php">
            <?php include('errors.php'); ?>

            <div class="Credentials">
                <input type="text" name="username" >
                <span></span>
                <label>Username</label>
            </div>  
            
            <div class="Credentials">
                <input type="password" name="password">
                <span></span>
                <label>Password</label>        
            </div>

            <div class="Forgot_Password">
                Forgot Password?
            </div>

            <div class="input-group">
  		        <button type="submit" class="btn" name="login_user">Login</button>
  	        </div>

            <div class="signup">
                Not registered?
                <a href="registration.php">Sign up</a>
            </div>

        </form>
    </div>
</body>
</html>