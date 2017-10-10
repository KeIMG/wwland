<?php
require_once('../vendor/autoload.php');
require_once('../applepay_includes/apple_pay_conf.php');

use com\realexpayments\remote\sdk\domain\payment\AutoSettle;
use com\realexpayments\remote\sdk\domain\payment\AutoSettleFlag;
use com\realexpayments\remote\sdk\RealexException;
use com\realexpayments\remote\sdk\RealexServerException;
use com\realexpayments\remote\sdk\domain\payment\PaymentRequest;
use com\realexpayments\remote\sdk\domain\payment\PaymentResponse;
use com\realexpayments\remote\sdk\domain\payment\PaymentType;
use com\realexpayments\remote\sdk\RealexClient;

$token = $_POST['paymentToken'];
echo '{"token":"' . $token . '"}';
/*
$applePayRequest = (new PaymentRequest())
        ->addType(PaymentType::AUTH_MOBILE)
        ->addMerchantId(PRODUCTION_MERCHANTIDENTIFIER)
        ->addAccount("internet")
        ->addMobile("apple-pay")
        ->addToken($token)
        ->addAutoSettle((new AutoSettle())->addFlag(AutoSettleFlag::TRUE));

$httpConfiguration = new HttpConfiguration();
$httpConfiguration->setEndpoint("https://api.sandbox.realexpayments.com/epage-remote.cgi");
$client = new RealexClient("Shared Secret", $httpConfiguration);

try {
      $paymentResponse = $client->send($applePayRequest);
      $resultCode = $paymentResponse->getResult();
      return $paymentResponse->getMessage();
}
catch (RealexServerException $e) {
      return $e->getMessage();
}
catch (RealexException $e) {
      return $e->getMessage();
}
*/
?>