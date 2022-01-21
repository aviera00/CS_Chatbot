<?php

// connecting to database
$conn = mysqli_connect("localhost", "root", "root", "hw2_witAI") or die("Database Error");

// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);
stripcslashes($getMesg);

debug_to_console($getMesg);
debug_to_console(gettype($getMesg));

//Index Code
//$input_utterance= 'I like finance';

$witRoot = "https://api.wit.ai/message?";
$witVersion = '20200804';

$witURL =  $witRoot. "v=". $witVersion . "&q=". urlencode($getMesg);

$ch = curl_init();
$header = array();
$header[] = 'Authorization: Bearer MF6I76FL2MAG2QFBOJ7O4K3UKGZBZW2D';

curl_setopt($ch, CURLOPT_URL, $witURL);
curl_setopt($ch, CURLOPT_HTTPHEADER,$header); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$certificate = "C:\MAMP\htdocs\demo\CS_Chatbot\cacert.pem";
curl_setopt($ch, CURLOPT_CAINFO, $certificate);
curl_setopt($ch, CURLOPT_CAPATH, $certificate);

//if a curl error is thrown
if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}

$server_output = curl_exec($ch); 


curl_close ($ch);
$server_decoded_rsp = json_decode($server_output)->entities->{"issues:issues"};
$response = "";
$answer='';
for ($i = 0; $i < count($server_decoded_rsp); $i++){
    $keyword = $server_decoded_rsp[$i]->value;
	$con_db = mysqli_connect("localhost", "root", "root", "hw2_witAI"); 
  	/*if (mysqli_connect_errno($con_db)) {
    	echo "Failed to connect  to MYSql:" . mysqli_connect_error();
  	}*/
    
  	$sql_command = "SELECT answer FROM response WHERE keyword = '{$keyword}'";
  	$result = mysqli_query($con_db, $sql_command);
  	$num_rows = mysqli_num_rows($result);
  	if ($num_rows > 0) {
    	$row = mysqli_fetch_array($result);
    	$answer = $row[0];
  	} else {
    	echo "failed";
  	}
  	mysqli_close($con_db);
}

//end of index code
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



//checking user query to database query
$check_data = "SELECT answer FROM response WHERE keyword = '{$keyword}'";

$run_query = mysqli_query($conn, $check_data) or die("Error");

// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($run_query) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($run_query);
    //storing replay to a varible which we'll send to ajax
    $replay = $fetch_data['answer'];
    echo $answer;
}else{
    echo "Sorry can't be able to understand you!";
}

?>