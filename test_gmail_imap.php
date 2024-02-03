<?php

require_once './autoload.php';

$clientID     = "somethingsomething.apps.googleusercontent.com";
$clientSecret = "AAAA-AAAA-AAAA-AAAA-AAA";
$refreshToken = '1//dGhpcyBpcyBqdXN0IHRlc3QgZm9yIHJlZnJlc2ggdG9rZW4gYW5kIG5vdGhpbmcgbW9yZQ';

$email = 'testmail@gmail.com';

$accessToken = (new GoogleOAuth2($clientID, $clientSecret, $refreshToken))->fetchAccessToken();
$test = new NET\IMAP('imap.gmail.com', 993);
$test->setDebug(true);
$test->login($email, $accessToken, 'XOAUTH2');
echo 'Total emails: ' . count($test->getMessagesList()) . "\n";
$test->disconnect();

?>