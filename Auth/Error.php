<?php

namespace Auth;

class Error extends \Exception {
	public function __construct(private string $message, private int $errNum = 0) {}

	public function getMessage() {
		return $this->message;
	}

	public function getErrnum() {
		return $this->errnum;
	}
}