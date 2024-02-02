<?php

/*
 * Thid can be used in PHPMailer
 * add implements PHPMailer\PHPMailer\OAuthTokenProvider and set $userEmail
 */

class GoogleOAuth2 {

	private string | bool $_accessToken = '';

	public function __construct(private string $clientID,
										 private string $clientSecret,
										 private string $refreshToken,
										 private string $userEmail = '') {}

	public function fetchAccessToken(): string {
		$postData = http_build_query(['grant_type'    => 'refresh_token',
												'refresh_token' => $this->refreshToken,
												'client_id'     => $this->clientID,
												'client_secret' => $this->clientSecret]);

		$options = ['http' => ['protocol_version' => 1.1,
									  'method'           => 'POST',
									  'header'           => ['Content-Type: application/x-www-form-urlencoded',
																	 'Cache-Control: no-store'],
									  'content'          => $postData]];

		$result = file_get_contents('https://oauth2.googleapis.com/token', false, stream_context_create($options));

		$accessToken = json_decode($result, true);

		$this->_accessToken = $accessToken['access_token'];

		return $this->_accessToken;
	}

	public function getOauth64(): string
	{
		$this->fetchAccessToken();

		return (base64_encode("user={$this->userEmail}\1auth=Bearer {$this->_accessToken}\1\1"));
	}

	public function generatePermissionURL(string $redirectURL = "http://localhost",
													  string $accountsURL = "https://accounts.google.com/o/oauth2/auth",
													  string $scope = "https://mail.google.com"): string
	{
		$getParams = http_build_query(['client_id'     => $this->clientID,
												 'redirect_uri'  => $redirectURL,
												 'scope'         => $scope,
												 'response_type' => 'code',
												 'access_type'   => 'offline',
												 'prompt'        => 'consent']);

		return ("{$accountsURL}?{$getParams}");
	}

	public function getRefreshToken(string $authorizationCode, string $redirectURL = "http://localhost"): string {
		$postData = http_build_query(['grant_type'    => 'authorization_code',
												'redirect_uri'  => $redirectURL,
												'code'          => $authorizationCode,
												'client_id'     => $this->clientID,
												'client_secret' => $this->clientSecret]);

		$options = ['http' => ['protocol_version' => 1.1,
									  'method'           => 'POST',
									  'header'           => ['Content-Type: application/x-www-form-urlencoded',
																	 'Cache-Control: no-store'],
									  'content'          => $postData]];

		$result = file_get_contents('https://oauth2.googleapis.com/token', false, stream_context_create($options));

		return ($result);
	}

}