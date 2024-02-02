This is PEARS NET and SASL2 packeges with support for googles OAUTH

<code>
	$test = new NET\IMAP('imap.gmail.com', 993);
	$test->setDebug(true);
	$test->login($email, $accessToken, 'XOAUTH2');
</code>