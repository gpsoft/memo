<?php
$pdo = new PDO('mysql:host=localhost; dbname=memo; charset=utf8','root','');
$sql = 'SELECT * FROM notes';
$stmt = $pdo->prepare($sql);
$stmt->execute();


$pdo = null;
$stmt = null;
$message = '新規投稿';
    


require_once 'views/new.tpl.php';
