<?php
require_once __DIR__ . '/vendor/autoload.php';

// newページ
// input: $message, $note, $error
$message = '新規投稿';
$note = ['id'=>'', 'title'=>'', 'content'=>''];
$error = emptyError();
require_once 'views/new.tpl.php';
