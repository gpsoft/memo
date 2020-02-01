<?php

$message = '作成が完了しました！';
if(isset($_REQUEST['submit'])){
    $id =$_REQUEST['id'];
    $title = $_REQUEST['title'];
    $content = $_REQUEST['content'];
}

$pdo = new PDO('mysql:host=localhost; dbname=memo; charset=utf8','root','');
$sql = 'INSERT INTO notes (title, content) VALUES (:title, :content)' ;
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
$stmt->execute();
$id = $pdo->lastInsertId();


$sql = 'SELECT * FROM notes ';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$notes = $stmt->fetchAll();


$pdo = null;
$stmt = null;

//require_once('views/create.tpl.php');
header('Location: show.php?id='.$id);