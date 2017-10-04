<?php
$validation_url = $_POST['url'];
if( "https" == parse_url($validation_url, PHP_URL_SCHEME) && substr( parse_url($validation_url, PHP_URL_HOST), -10 )  == ".apple.com" ){
	require_once ('apple_pay_conf.php');
	
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
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	if( $result === false)
	{
		error_log("there");
		echo '{"curlError":"' . curl_error($ch) . '"}';
	}else
	{
		header("Content-Type: application/json;charset=utf-8");
		$json = json_encode($result);
		if ($json === false) {
			// Avoid echo of empty string (which is invalid JSON), and
			// JSONify the error message instead:
			$json = json_encode(array("jsonError", json_last_error_msg()));
			if ($json === false) {
				// This should not happen, but we go all the way now:
				$json = '{"jsonError": "unknown"}';
			}
			// Set HTTP response status code to: 500 - Internal Server Error
			http_response_code(500);
		}
		echo $json;
	}
	// close cURL resource, and free up system resources
	curl_close($ch);
}
?>