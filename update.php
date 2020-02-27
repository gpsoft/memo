<?php
require_once __DIR__ . '/vendor/autoload.php';

if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
	logE('不正メソッド');
    header('Location: index.php');
    exit;
}

$note = makeNoteFromRequest();
$error = validateNote($note);

if ( $note['id'] == '' || hasError($error) ) {
    logD($note, 'note');
    logD($error, 'error');
    require_once 'views/edit.tpl.php';
    exit();
}

$pdo = connectDB();
$note = saveNote($pdo, $note);
logD($note, 'update a note');

logI('Redirecting to: show.php?id='.$note['id']);
header('Location: show.php?id='.$note['id']);

