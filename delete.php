<?php
require_once __DIR__ . '/vendor/autoload.php';

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if ( $id == '' ) {
	logE('IDなし');
    header('Location: index.php');
    exit();
}

$pdo = connectDB();
removeNote($pdo, $id);

logI('Redirecting to: index.php');
header('Location: index.php');
