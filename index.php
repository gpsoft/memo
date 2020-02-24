<?php
require_once __DIR__ . '/vendor/autoload.php';

$pdo = connectDB();
$sql = 'SELECT * FROM notes';//一覧表示したいので全部取得
logD($sql, 'SQL');
$stmt = $pdo->prepare($sql);
$stmt->execute();
$notes = [];//空の配列の準備　必要ある？
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $notes[] = $row;
}
//fetchは１行しか取得しない　引数で取得方法を指定（今回は連想配列）
logD(count($notes), 'Total');
$pdo = null;
$stmt = null;

// indexページ
// input: $message, $notes
$message = 'メモ一覧';
require_once 'views/index.tpl.php';
