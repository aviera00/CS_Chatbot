<?php

$input_utterance= 'I failed my exam';

$witRoot = "https://api.wit.ai/message?";
$witVersion = '20200804';

echo "Post:" . "<br>" . "$input_utterance" . "<br>";

$witURL =  $witRoot. "v=". $witVersion . "&q=". urlencode($input_utterance);

$ch = curl_init();
$header = array();
$header[] = 'Authorization: Bearer 5QC63SNFDA2HBYGE6A3ARAQ3TAILWYJN';

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
echo "<br>";
echo "Responses:";
$server_decoded_rsp = json_decode($server_output)->entities->{"issues:issues"};
$response = "";
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
    	echo "<br>" . $answer;
  	} else {
    	echo "failed";
  	}
  	mysqli_close($con_db);
}


?>