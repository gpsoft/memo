<?php

// システム初期化、及び共通関数

require_once('config.php');
require_once('htmlsp.php');
require_once('note.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

function _newLogger() {
	$logger = new Logger('notes');
	$logger->setTimezone(new DateTimeZone('Asia/Tokyo'));
	$handler = new StreamHandler(__DIR__ . '/log/debug.log', Logger::DEBUG);
	$handler->setFormatter(new LineFormatter(
		"%datetime%[%level_name%]%extra.file%(%extra.line%):%message% \n", 'H:i:s.v', true
	));
	$logger->pushHandler($handler);
	$logger->pushProcessor(function($rec){
		$depth = 5;	// depends on Monolog impl
		$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $depth);
		$rec['extra']['file'] = basename($bt[$depth-1]['file']);
		$rec['extra']['line'] = $bt[$depth-1]['line'];
		$rec['level_name'] = substr($rec['level_name'], 0, 1);
		return $rec;
	});
	return $logger;
}
function logD($msgOrArray, $caption=null) {
	$logger = _newLogger();
	$msg = is_string($msgOrArray) ? $msgOrArray : var_export($msgOrArray, true);
	if ( !is_null($caption) ) $msg = $caption . '=' . $msg;
	$logger->debug($msg);
}
