<?php

namespace NET;

class Error extends \Exception {
	public function __construct(string $message, int $code = 0) {
		parent::__construct($message, $code);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}