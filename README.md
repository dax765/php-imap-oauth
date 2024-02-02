This is PEARS NET and SASL2 packeges with support for googles OAUTH

```php
$accessToken = (new GoogleOAuth2($clientID, $clientSecret, $refreshToken))->fetchAccessToken();
$test = new NET\IMAP('imap.gmail.com', 993);
$test->setDebug(true);
$test->login($email, $accessToken, 'XOAUTH2');
echo 'Totla emails: ' . count($test->getMessagesList()) . "\n";
$test->disconnect();
```