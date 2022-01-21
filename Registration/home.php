<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSE109 Chatbot</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    
    <div class="bar">
        <div class="LehighLogo">
            <a href="https://www1.lehigh.edu/"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/e/ef/LUwithShield-CMYK.svg/1200px-LUwithShield-CMYK.svg.png"></a>
        </div>

        <h1>CSE109 Chatbot Tutor</h1>

        <div class="HelloUser">
            <p>Hello <strong><?php echo $_SESSION['username']; ?></strong></p>
        </div>

        <div class="Logout">
            <a href="login.php">Logout</a>
        </div>
    </div>

    <div class="wrapper">
        <div class="title">Cantinflas</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type your question here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>

    <div class="bot">
        <img src="https://cdn2.iconfinder.com/data/icons/machine-learning-filled-color/300/134026380Untitled-3-512.png">
    </div>

    <div class="credits">
        <p1>All Rights Reserved. </p1>
        <br>
        <p2>Developed by Alonso Cornejo & Andrew Viera</p2>
    </div>

    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                console.log($("#data").val(''))
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
    
</body>
</html>