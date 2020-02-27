<?php
require_once __DIR__ . '/vendor/autoload.php';

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if ( $id == '' ) {
	logE('IDなし');
    header('Location: index.php');
    exit();
}

$pdo = connectDB();
$note = lookupNote($pdo, $id);
logD($note);
if ( $note === false ) {
	logE('ID不正');
    header('Location: index.php');
    exit();
}

// showページ
// input: $message, $note
$message = 'メモ詳細';
require_once 'views/show.tpl.php';
