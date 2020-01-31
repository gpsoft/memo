<?php
$pdo = new PDO('mysql:host=localhost; dbname=memo; charset=utf8','root','');
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
    