<?php

// システム初期化、及び共通関数

require_once('config.php');
require_once('htmlsp.php');
require_once('note.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

function _newLogger() {
	$logger = new Logger('notes');
	$logger->setTimezone(new DateTimeZone('Asia/Tokyo'));
	$handler = new RotatingFileHandler(__DIR__.'/log/access.log', 3, LOGLEVEL);
	$handler->setFormatter(new LineFormatter(
		"%datetime%[%level_name%] %message% \n", 'H:i:s'));
	$logger->pushHandler($handler);
	if ( DEBUG ) {
		$handler = new StreamHandler(__DIR__.'/log/debug.log', Logger::DEBUG);
		$handler->setFormatter(new LineFormatter(
			"%datetime%[%level_name%]%extra.file%(%extra.line%):%message% \n",
			'H:i:s.v', true));
		$logger->pushHandler($handler);
	}
	$logger->pushProcessor(function($rec){
		if ( DEBUG ) {
			$depth = 5;	// depends on Monolog impl
			$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $depth);
			$rec['extra']['file'] = basename($bt[$depth-1]['file']);
			$rec['extra']['line'] = $bt[$depth-1]['line'];
		}
		$rec['level_name'] = substr($rec['level_name'], 0, 1);
		return $rec;
	});
	return $logger;
}
function logE($msg) {
	$logger = _newLogger();
	$msg .= ' - ' . $_SERVER['REQUEST_URI'];
	$logger->error($msg);
}
function logI($msg) {
	$logger = _newLogger();
	$logger->info($msg);
}
function logD($msgOrArray, $caption=null) {
	$logger = _newLogger();
	$msg = is_string($msgOrArray) ? $msgOrArray : var_export($msgOrArray, true);
	if ( !is_null($caption) ) $msg = $caption . '=' . $msg;
	$logger->debug($msg);
}

function connectDB() {
	return new PDO(DSN, DBUSER, DBPASS, [
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES=>false,
		PDO::MYSQL_ATTR_INIT_COMMAND =>"SET time_zone='Asia/Tokyo'",
	]);
}
