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
use com\realexpayments\remote\sdk\http\HttpConfiguration;

$token = $_POST['paymentToken'];

$applePayRequest = (new PaymentRequest())
        ->addType(PaymentType::AUTH_MOBILE)
        ->addMerchantId("pwreventstest")
        ->addAccount("remote")
        ->addMobile("apple-pay")
        ->addToken($token)
        ->addAutoSettle((new AutoSettle())->addFlag(AutoSettleFlag::TRUE));

$httpConfiguration = new HttpConfiguration();
$httpConfiguration->setEndpoint("https://api.sandbox.realexpayments.com/epage-remote.cgi");
$client = new RealexClient("secret", $httpConfiguration);
$result = '{"status":"999","message":"initial value"}';
try {
      $paymentResponse = $client->send($applePayRequest);
      $resultCode = $paymentResponse->getResult();
      $result = $paymentResponse->getMessage();
      $result = '{"status":"' . $e->getResult() . '","message":"' . $e->getMessage() . '"}';
}
catch (RealexServerException $e) {
    $result = '{"status":"999","message":"' . $e->getMessage() . '"}';
}
catch (RealexException $e) {
      $result = '{"status":"999","message":"' . $e->getMessage() . '"}';
}
echo $result;

?>