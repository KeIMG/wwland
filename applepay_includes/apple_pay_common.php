<?php
$validation_url = $_POST['url'];
error_log("line 3");
error_log($validation_url);
if( "https" == parse_url($validation_url, PHP_URL_SCHEME) && substr( parse_url($validation_url, PHP_URL_HOST), -10 )  == ".apple.com" ){
	require_once ('../applepay_includes/apple_pay_conf.php');
	
	// create a new cURL resource
	$ch = curl_init();
	$data = '{"merchantIdentifier":"'.PRODUCTION_MERCHANTIDENTIFIER.'", "domainName":"'.PRODUCTION_DOMAINNAME.'", "displayName":"'.PRODUCTION_DISPLAYNAME.'"}';
	curl_setopt($ch, CURLOPT_URL, $validation_url);
	curl_setopt($ch, CURLOPT_SSLCERT, PRODUCTION_CERTIFICATE_PATH);
	curl_setopt($ch, CURLOPT_SSLKEY, PRODUCTION_CERTIFICATE_KEY);
	curl_setopt($ch, CURLOPT_SSLKEYPASSWD, PRODUCTION_CERTIFICATE_KEY_PASS);
	//curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
	//curl_setopt($ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
	//curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'rsa_aes_128_gcm_sha_256,ecdhe_rsa_aes_128_gcm_sha_256');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = curl_exec($ch);
	if( $result === false)
	{
		error_log("there");
		echo '{\"curlError\":\"' . curl_error($ch) . '\"}';
	}else
	{
		$json = json_decode($result,true);
		error_log("here");
		error_log($json);
		print_r($json);

	}
	// close cURL resource, and free up system resources
	curl_close($ch);
	
}
?>