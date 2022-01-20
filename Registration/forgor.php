<?php include('check.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="log_style.css">
</head>

<body>
    <div class="Main">
        <h1>Enter Username</h1>
        <form method="post" action="forgor.php">
            <?php include('errors.php'); ?>

            <div class="Credentials">
                <input type="text" name="username" >
                <span></span>
                <label>Username</label>
            </div>  
            

            <div class="input-group">
  		        <button type="submit" class="btn" name="reset_user">Reset</button>
  	        </div>

            <div class="goback">
                Already a user?
                <a href="login.php"> Login</a>
            </div>

        </form>
    </div>
</body>
</html>