<?php
require_once ('config.php');
$sql = 'SELECT * FROM notes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$notes = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $notes[] = $row;
}

$pdo = null;
$stmt = null;
$message = 'メモ一覧';
    


require_once 'views/index.tpl.php';
    