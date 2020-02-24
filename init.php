<?php

// システム初期化、及び共通関数

require_once('config.php');
require_once('htmlsp.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

function _newLogger() {
	$logger = new Logger('notes');
	$logger->setTimezone(new DateTimeZone('Asia/Tokyo'));
	$handler = new StreamHandler(__DIR__ . '/log/debug.log', Logger::DEBUG);
	$handler->setFormatter(new LineFormatter(
		"%datetime%[%level_name%]%extra.file%(%extra.line%):%message% \n", 'Y-m-d H:i:s.v'
	));
	$logger->pushHandler($handler);
	return $logger;
}
function logD($msgOrArray, $caption=null) {
	$logger = _newLogger();
	$msg = is_array($msgOrArray) ? var_export($msgOrArray, true) : $msgOrArray;
	if ( !is_null($caption) ) $msg = $caption . '=' . $msg;
	$logger->debug($msg);
}
