<?php

$val= base64_encode ('<API key>:<Secret>');// Replace API Key and Secret with your own by creating account in their API.
$lon=$_POST['lon'];
$lat=$_POST['lat'];
$ch = curl_init();
$headr = array();
$headr[] = 'Authorization: Basic {'.$val.'}';
$headr[] = 'Content-Type: application/x-www-form-urlencoded';
$data='grant_type=client_credentials';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_URL, "https://api.pitneybowes.com/oauth/token");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$token="empty";
$result=json_decode($response,true);
foreach($result as $key=>$value)
	if($key=="access_token")
		$token=$value;
curl_close($ch);
$ch1 = curl_init();
$header = array();
$header[] = 'Authorization: Bearer '.$token.'';
curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch1, CURLOPT_URL, "https://api.pitneybowes.com/location-intelligence/geoenhance/v1/address/bylocation?latitude=".$lat."&longitude=".$lon);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
$finalData = curl_exec($ch1);
curl_close($ch1);

echo $finalData;

?>

