<?php
require_once __DIR__ . '/vendor/autoload.php';

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if ( $id == '' ) {
    header('Location: index.php');
    exit();
}

$pdo = connectDB();
$note = lookupNote($pdo, $id);
logD($note);
if ( $note === false ) {
    header('Location: index.php');
    exit();
}

// editページ
// input: $message, $note, $error
$message = 'Memo Update';
$error = emptyError();
require_once 'views/edit.tpl.php';
