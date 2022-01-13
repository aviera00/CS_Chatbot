<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = ""; //this is for errors thrown, will be dynamically filled in later
$name = $comment = ""; //variables we'll be using, will be filled in with user input

if ($_SERVER["REQUEST_METHOD"] == "POST") { //this is an example of a required field
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }  

  if (empty($_POST["comment"])) { //i'm using comment similar to how we use input_utterance
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]); //store data only after cleaning
  }

  //note: post method is used to collect form data

}

function test_input($data) { //tests the input, also cleans up input
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!-- this is the html for ur frontend/ui -->
<h2>Empathetic ChatBot</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


<?php
//everything here is similar to the demo but now im using comment instead of input utterance and it comes from above
$witRoot = "https://api.wit.ai/message?";
$witVersion = '20200804';

$witURL =  $witRoot. "v=". "&q=". urlencode($comment);
// link should be : "https://api.wit.ai/message?v=20200804&q="

$ch = curl_init();
$header = array();
$header[] = 'Authorization: Bearer 432K6GI5MIHLCGYWAK6H6XTJDAIPZYR6';

curl_setopt($ch, CURLOPT_URL, $witURL);
curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// adding certificate, if you cannot locate cacert.pem within your MAMP folder, download it from the Google Drive
// change the path of the certificate to where it is on your local machine
// remember the syntax for the path changes whether your on a mac or windows machine, the below line is windows syntax
$certificate = "C:\MAMP\bin\php\php7.4.1\cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $certificate);
curl_setopt($ch, CURLOPT_CAPATH, $certificate);

$server_output = curl_exec($ch); 

//if a curl error is thrown
if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}

curl_close ($ch);  

echo "<br>";
echo "Response:";
$server_decoded_rsp = json_decode($server_output)->entities->{"issues:issues"};

$response = "";

//echo count($server_decoded_rsp);

//if default ports are changed with MAMP preferences, need to specify port number when connecting sql
for ($i = 0; $i < count($server_decoded_rsp); $i++){
  $keyword = $server_decoded_rsp[$i]->value;
  $con_db = mysqli_connect("localhost:8889", "root", "root", "hw2_witAI"); 
    if (mysqli_connect_errno($con_db)) {
      echo "Failed to connect  to MYSql:" . mysqli_connect_error();
    }
    $sql_command = "SELECT answer FROM response WHERE keyword = '{$keyword}'";
    $result = mysqli_query($con_db, $sql_command);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
      $row = mysqli_fetch_array($result);
      $answer = $row[0];
      echo "<br>" . $answer;
    } else {
      echo "failed";
    }
    mysqli_close($con_db);
}


?>

</body>
</html>