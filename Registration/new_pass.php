<?php include('reset.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Create New Password</title>
  <link rel="stylesheet" href="reg_style.css">
</head>

<body>
    <div class="Main">
        <h1>Enter New password</h1>
        <form method="post" action="new_pass.php">
            <?php include('errors.php'); ?>

            <div class="Credentials">
                <input type="password" name="password_1">
                <span></span>
                <label>Password</label>        
            </div>

            <div class="Credentials">
                <input type="password" name="password_2">
                <span></span>
                <label>Confirm Password</label>        
            </div>

            <div class="submit_info">
                <button type="submit" class="btn" name="change_pass">Reset</button>
            </div>

            <p>
  		        Already a member? <a href="login.php">Sign in</a>
  	        </p>

        </form>
    </div>
</body>
</html>
