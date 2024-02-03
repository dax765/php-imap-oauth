<?php

require_once './autoload.php';

$clientID     = "somethingsomething.apps.googleusercontent.com"; // New client ID and secret on https://console.cloud.google.com/
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


?>