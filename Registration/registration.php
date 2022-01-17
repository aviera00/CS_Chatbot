<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="reg_style.css">
</head>

<body>
    <div class="Main">
        <h1>Enter Information</h1>
        <form method="post" action="registration.php">
            <?php include('errors.php'); ?>

            <div class="Credentials">
                <input type="text" name="name" value="<?php echo $name; ?>">    
                <span></span>
                <label>Name</label>
            </div>  
            
            <div class="Credentials">
                <input type="text" name="username" value="<?php echo $username; ?>">    
                <span></span>
                <label>Username</label>        
            </div>

            <div class="Credentials">
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span></span>
                <label>Email</label>        
            </div>

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
                <button type="submit" class="btn" name="reg_user">Register</button>
            </div>

            <p>
  		        Already a member? <a href="login.php">Sign in</a>
  	        </p>

        </form>
    </div>
</body>
</html>


