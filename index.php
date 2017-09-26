<?php 
    echo "Hello"
?>
<!-- 
Abstract:
An example page that displays an Apple Pay button and triggers a payment request if clicked
-->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="apple-touch-icon" sizes="120x120" href="images/touch-icon-120.png">
		<link rel="apple-touch-icon" sizes="152x152" href="images/touch-icon-152.png">
		<link rel="apple-touch-icon" sizes="167x167" href="images/touch-icon-167.png">
		<link rel="apple-touch-icon" sizes="180x180" href="images/touch-icon-180.png">
		<script src="js/index.js"></script>
		<script src="js/support.js"></script>
		<title>Apple Pay</title>
	</head>

	<body>
    <?php 
    require_once('applepay_includes/apple_pay_conf.php');
    ?>
		<div class="apple-pay">
			<h2> Buy with Apple&nbsp;Pay </h2>
			<p>
				This is a very simple example site that demonstrates Apple&nbsp;Pay on the web.
			</p>
			<p>
				Compatible browsers will display an Apple&nbsp;Pay button below.
			</p>
			<div class="apple-pay-button" onclick="applePayButtonClicked()">

			</div>
		</div>
	</body>
</html>
