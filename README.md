This is PEAR NET and SASL2 packeges with support for googles OAUTH

```php
$accessToken = (new GoogleOAuth2($clientID, $clientSecret, $refreshToken))->fetchAccessToken();
$test = new NET\IMAP('imap.gmail.com', 993);
$test->setDebug(true);
$test->login($email, $accessToken, 'XOAUTH2');
echo 'Total emails: ' . count($test->getMessagesList()) . "\n";
$test->disconnect();
```

To generate refresh token

```php
// New client ID and secret on https://console.cloud.google.com/

$clientID     = "somethingsomething.apps.googleusercontent.com"; 
$clientSecret = "AAAA-AAAA-AAAA-AAAA-AAA";
$redirectURL  = "http://localhost";
$accountsURL  = "https://accounts.google.com/o/oauth2/auth";
$scope        = "https://mail.google.com";

$goauth = new GoogleOAuth2($clientID, $clientSecret, '');

$permissionURL = $goauth->generatePermissionURL($redirectURL, $accountsURL, $scope);

echo "Permission URL: {$permissionURL}\nEnter validation code: ";

$authorizationCode = fgets(STDIN);

$response = $goauth->getRefreshToken(trim($authorizationCode), $redirectURL);

echo "{$response}\n"; // response will contain refresh token

```
