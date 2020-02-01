<?php
require_once ('config.php');
$sql = 'SELECT * FROM notes';
$stmt = $pdo->prepare($sql);
$stmt->execute();


$pdo = null;
$stmt = null;
$message = '新規投稿';
    


require_once 'views/new.tpl.php';
