<?php
namespace MooPhp\Client;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class FileLogger implements Logger {

	protected $_logLevel = 0;
	protected $_logFile;

	public function __construct($logFile = null) {
		if (!isset($logFile)) {
			$this->_logFile = STDERR;
		} else {
			$this->_logFile = $logFile;
		}
	}

	public function setLogLevel($level) {
		$this->_logLevel = $level;
	}

	public function logDebug($entry) {
		if ($this->_logLevel >= self::LOG_LEVEL_DEBUG) {
			error_log($entry, $this->_logFile);
		}
	}

}
