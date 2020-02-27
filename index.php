<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = connectDB();
$notes = findAllNotes($pdo);
logD(count($notes), 'Total');

// indexページ
// input: $message, $notes
$message = 'メモ一覧';
require_once 'views/index.tpl.php';
